<?php
class BookingController extends Controller {
    
    // 1. Fungsi untuk memproses form booking dari Halaman Detail Barang
    public function store() {
        $this->requireAuth('user');

        if ($_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            die("CSRF Token Validation Failed.");
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $item_id = htmlspecialchars($_POST['item_id']);
            $start_date = htmlspecialchars($_POST['start_date']);
            $end_date = htmlspecialchars($_POST['end_date']);
            $user_id = $_SESSION['user_id'];

            $itemModel = $this->model('ItemModel');
            $item = $itemModel->getItemById($item_id);

            if (!$item) {
                header('Location: ' . BASEURL . '/error/404');
                exit;
            }

            $bookingModel = $this->model('BookingModel');
            if (!$bookingModel->isDateAvailable($item_id, $start_date, $end_date)) {
                $_SESSION['flash'] = "Maaf, barang sudah disewa pada tanggal tersebut.";
                header('Location: ' . BASEURL . '/item/detail/' . $item_id);
                exit;
            }

            $start = new DateTime($start_date);
            $end = new DateTime($end_date);
            $duration = $start->diff($end)->days + 1; 
            
            $daily_price = $item['price_daily'];
            $total_price = $duration * $daily_price;
            $admin_fee = 5000; 
            $grand_total = $total_price + $admin_fee;
            $invoice_no = 'INV-' . date('Ymd') . '-' . strtoupper(uniqid());

            $data = [
                'invoice_no' => $invoice_no,
                'item_id' => $item_id,
                'user_id' => $user_id,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'duration' => $duration,
                'daily_price' => $daily_price,
                'total_price' => $total_price,
                'admin_fee' => $admin_fee,
                'grand_total' => $grand_total
            ];

            if ($bookingModel->createBooking($data)) {
                $_SESSION['flash_success'] = "Booking berhasil! Silakan lakukan pembayaran.";
                header('Location: ' . BASEURL . '/booking/saya');
                exit;
            } else {
                $_SESSION['flash_error'] = "Terjadi kesalahan sistem.";
                header('Location: ' . BASEURL . '/item/detail/' . $item_id);
                exit;
            }
        }
    }

    // 2. Fungsi pengaman jika URL diakses /booking saja
    public function index() {
        header('Location: ' . BASEURL . '/booking/saya');
        exit;
    }

    // 3. Fungsi untuk menampilkan tabel riwayat sewa (booking) user
    public function saya() {
        $this->requireAuth(); 
        
        $bookingModel = $this->model('BookingModel');
        $data['title'] = 'Riwayat Sewa (Booking) Saya';
        $data['bookings'] = $bookingModel->getBookingsByUser($_SESSION['user_id']);
        
        $this->view('user/booking_saya', $data);
    }
}
?>