<div class="container mt-4 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                
                <!-- Header Chat -->
                <div class="card-header bg-white d-flex align-items-center py-3">
                    <a href="<?= BASEURL; ?>/user/dashboard" class="btn btn-sm btn-light me-3"><i class="fas fa-arrow-left"></i></a>
                    <h5 class="mb-0 fw-bold text-primary">Ruang Obrolan</h5>
                </div>

                <!-- Area Chat Messages -->
                <div class="card-body bg-light" id="chatArea" style="height: 500px; overflow-y: auto;">
                    <!-- Pesan akan dirender di sini oleh JavaScript -->
                    <div class="text-center text-muted small mt-4" id="loadingText">Memuat pesan...</div>
                </div>

                <!-- Form Kirim Pesan -->
                <div class="card-footer bg-white py-3">
                    <form id="chatForm">
                        <input type="hidden" id="room_id" value="<?= $data['room_id']; ?>">
                        <div class="input-group">
                            <input type="text" id="messageInput" class="form-control rounded-pill px-4" placeholder="Ketik pesan..." required autocomplete="off">
                            <button class="btn btn-primary rounded-circle ms-2" type="submit" style="width: 45px; height: 45px;">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const roomId = document.getElementById('room_id').value;
    const currentUserId = <?= $data['current_user_id']; ?>;
    const chatArea = document.getElementById('chatArea');
    const chatForm = document.getElementById('chatForm');
    const messageInput = document.getElementById('messageInput');
    const loadingText = document.getElementById('loadingText');
    
    let lastMessageId = 0; // Menyimpan ID pesan terakhir agar tidak memuat ulang semua pesan

    // Fungsi mengambil pesan dari Server
    function fetchMessages() {
        fetch(`<?= BASEURL; ?>/chat/get_messages/${roomId}?last_id=${lastMessageId}`)
            .then(response => response.json())
            .then(res => {
                if(res.status === 'success' && res.data.length > 0) {
                    if (loadingText) loadingText.remove(); // Hapus tulisan loading

                    res.data.forEach(msg => {
                        renderMessage(msg);
                        lastMessageId = msg.id; // Update ID terakhir
                    });

                    // Scroll ke paling bawah setiap ada pesan baru
                    chatArea.scrollTop = chatArea.scrollHeight;
                }
            })
            .catch(err => console.error(err));
    }

    // Fungsi merender elemen HTML pesan
    function renderMessage(msg) {
        const isMe = (msg.sender_id == currentUserId);
        
        // Struktur HTML Bubble Chat
        const div = document.createElement('div');
        div.className = `d-flex mb-3 ${isMe ? 'justify-content-end' : 'justify-content-start'}`;
        
        const safeName = (msg.sender_name || '').toString().replace(/[&<>"']/g, c => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[c]));
        const safeMsg = (msg.message || '').toString().replace(/[&<>"']/g, c => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[c]));
        const safeAvatar = (msg.sender_avatar || 'default.png').toString().replace(/[&<>"']/g, c => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[c]));

        let avatarHTML = isMe ? '' : `<img src="<?= BASEURL; ?>/assets/uploads/avatars/${safeAvatar}" class="rounded-circle me-2" style="width: 35px; height: 35px; object-fit: cover;">`;
        let bubbleClass = isMe ? 'bg-primary text-white' : 'bg-white border text-dark';
        
        // Format waktu HH:MM
        const timeStr = new Date(msg.created_at).toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
        
        div.innerHTML = `
            ${avatarHTML}
            <div style="max-width: 70%;">
                ${!isMe ? `<small class="text-muted d-block ms-1 mb-1" style="font-size: 11px;">${safeName}</small>` : ''}
                <div class="p-3 shadow-sm ${bubbleClass}" style="border-radius: 15px; ${isMe ? 'border-bottom-right-radius: 0;' : 'border-top-left-radius: 0;'}">
                    ${safeMsg}
                </div>
                <small class="text-muted d-block mt-1 ${isMe ? 'text-end me-1' : 'ms-1'}" style="font-size: 10px;">${timeStr}</small>
            </div>
        `;
        
        chatArea.appendChild(div);
    }

    // Fungsi mengirim pesan ke Server
    chatForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const messageText = messageInput.value.trim();
        if (messageText === '') return;

        // Kosongkan input langsung agar UX terasa cepat
        messageInput.value = ''; 

        const formData = new URLSearchParams();
        formData.append('room_id', roomId);
        formData.append('message', messageText);

        fetch(`<?= BASEURL; ?>/chat/send_message`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: formData.toString()
        })
        .then(response => response.json())
        .then(res => {
            if(res.status === 'success') {
                fetchMessages(); // Langsung tarik data agar pesan kita muncul
            }
        });
    });

    // Panggil fetchMessages pertama kali, lalu polling setiap 3 detik
    fetchMessages();
    setInterval(fetchMessages, 3000); 
});
</script>