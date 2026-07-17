<?php
class ChatController extends Controller {

    public function __construct() {
        $this->requireAuth(); // Wajib Login
    }

    // 1. Inisiasi Obrolan dari Halaman Detail Barang
    public function start($item_id, $owner_id) {
        $renter_id = $_SESSION['user_id'];
        
        // Mencegah user chat dengan dirinya sendiri
        if ($renter_id == $owner_id) {
            $_SESSION['flash_error'] = "Anda tidak bisa mengirim pesan ke barang milik sendiri.";
            header('Location: ' . BASEURL . '/item/detail/' . $item_id);
            exit;
        }

        $chatModel = $this->model('ChatModel');
        $room_id = $chatModel->getOrCreateRoom($item_id, $renter_id, $owner_id);
        
        header('Location: ' . BASEURL . '/chat/room/' . $room_id);
        exit;
    }

    // 2. Menampilkan Halaman UI Chat (Room)
    public function room($room_id) {
        $chatModel = $this->model('ChatModel');
        
        // Proteksi: Cek apakah user berhak masuk ke room ini
        if (!$chatModel->checkRoomAccess($room_id, $_SESSION['user_id'])) {
            header('Location: ' . BASEURL . '/error/403');
            exit;
        }

        $data['room_id'] = $room_id;
        $data['current_user_id'] = $_SESSION['user_id'];
        
        $this->view('user/chat_room', $data);
    }

    // 3. Endpoint AJAX: Ambil Pesan Baru
    public function get_messages($room_id) {
        // Menerima ID Pesan terakhir dari Javascript
        $last_msg_id = isset($_GET['last_id']) ? (int)$_GET['last_id'] : 0;
        
        $chatModel = $this->model('ChatModel');
        $messages = $chatModel->getMessages($room_id, $last_msg_id);

        header('Content-Type: application/json');
        echo json_encode(['status' => 'success', 'data' => $messages]);
    }

    // 4. Endpoint AJAX: Kirim Pesan
    public function send_message() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $room_id = (int)$_POST['room_id'];
            $message = htmlspecialchars(trim($_POST['message']));
            $sender_id = $_SESSION['user_id'];

            if (!empty($message)) {
                $chatModel = $this->model('ChatModel');
                $chatModel->sendMessage($room_id, $sender_id, $message);
                
                echo json_encode(['status' => 'success']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Pesan kosong']);
            }
        }
    }
}
?>