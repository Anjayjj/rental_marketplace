<form action="<?= BASEURL; ?>/booking/store" method="POST" id="form_booking">
    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?? ''; ?>">
    <input type="hidden" name="item_id" value="<?= $data['item']['id']; ?>">
    <input type="hidden" id="daily_price" value="<?= $data['item']['price_daily']; ?>">

    <!-- DETEKSI SIAPA YANG MEMBUKA HALAMAN INI -->
    <?php 
    $is_owner = (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $data['item']['owner_id']); 
    ?>

    <?php if($is_owner): ?>
        <div class="alert alert-warning p-2 small mb-3 border-0">
            <i class="fas fa-exclamation-triangle text-dark"></i> <strong>Mode Pemilik:</strong> Anda sedang melakukan penyewaan internal untuk memblokir jadwal barang Anda sendiri.
        </div>
    <?php endif; ?>

    <div class="mb-3">
        <label for="start_date" class="form-label fw-semibold text-secondary">Tanggal Mulai</label>
        <input type="date" class="form-control" id="start_date" name="start_date" required min="<?= date('Y-m-d'); ?>">
    </div>

    <div class="mb-3">
        <label for="end_date" class="form-label fw-semibold text-secondary">Tanggal Selesai</label>
        <input type="date" class="form-control" id="end_date" name="end_date" required disabled>
    </div>

    <div id="price_summary" class="d-none bg-light border p-3 rounded mb-3">
        <div class="d-flex justify-content-between mb-1">
            <span class="text-muted small">Durasi Sewa:</span>
            <span id="display_duration" class="fw-bold small">0 Hari</span>
        </div>
        <div class="d-flex justify-content-between align-items-center">
            <span class="text-muted small">Total Tagihan:</span>
            <span id="display_total" class="fw-bold text-primary fs-5">Rp 0</span>
        </div>
    </div>

    <!-- JIKA PEMILIK, MUNCULKAN CHECKBOX S&K -->
    <?php if($is_owner): ?>
        <div class="form-check mb-3 bg-light p-2 rounded border">
            <input class="form-check-input ms-1" type="checkbox" id="tnc_owner" required>
            <label class="form-check-label small text-muted ms-2" for="tnc_owner">
                Saya setuju dengan <strong>S&K Marketplace</strong>: Transaksi internal ini murni untuk pemakaian pribadi dan tidak ditujukan untuk memanipulasi rating atau ulasan fiktif.
            </label>
        </div>
    <?php endif; ?>

    <button type="submit" class="btn <?= $is_owner ? 'btn-warning text-dark' : 'btn-primary'; ?> w-100 fw-bold py-2" id="btn_submit" disabled>
        <?= $is_owner ? 'Konfirmasi Blokir Jadwal' : 'Ajukan Sewa Sekarang'; ?>
    </button>
</form>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const startDateInput = document.getElementById('start_date');
    const endDateInput = document.getElementById('end_date');
    const priceSummary = document.getElementById('price_summary');
    const displayDuration = document.getElementById('display_duration');
    const displayTotal = document.getElementById('display_total');
    const btnSubmit = document.getElementById('btn_submit');
    const dailyPrice = parseFloat(document.getElementById('daily_price').value);
    
    // Cek keberadaan checkbox S&K 
    const tncOwner = document.getElementById('tnc_owner');

    startDateInput.addEventListener('change', function() {
        endDateInput.disabled = false;
        endDateInput.min = this.value;
        calculatePrice();
    });

    endDateInput.addEventListener('change', calculatePrice);
    
    if(tncOwner) {
        tncOwner.addEventListener('change', calculatePrice);
    }

    function calculatePrice() {
        if(startDateInput.value && endDateInput.value) {
            const start = new Date(startDateInput.value);
            const end = new Date(endDateInput.value);
            
            const diffTime = end - start;
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;

            if (diffDays > 0) {
                const total = diffDays * dailyPrice;
                displayDuration.innerText = diffDays + " Hari";
                displayTotal.innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(total);
                priceSummary.classList.remove('d-none');
                
                // Logika JavaScript Validasi S&K
                if(tncOwner && !tncOwner.checked) {
                    btnSubmit.disabled = true; // Kunci tombol jika tidak setuju S&K
                } else {
                    btnSubmit.disabled = false; // Buka tombol
                }
            } else {
                priceSummary.classList.add('d-none');
                btnSubmit.disabled = true;
            }
        }
    }
});
</script>