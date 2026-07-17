<?php
class AdminController extends Controller {

    public function __construct() {
        // PROTEKSI MUTLAK: Hanya Admin
        $this->requireAuth('admin');
    }

    // Method pengaman jika URL hanya /admin
    public function index() {
        header('Location: ' . BASEURL . '/admin/dashboard');
        exit;
    }

    public function dashboard() {
        $adminModel = $this->model('AdminModel');
        
        $data['stats'] = $adminModel->getDashboardStats();
        $data['recent_bookings'] = $adminModel->getRecentBookings();
        $data['chart_data'] = json_encode($adminModel->getRevenueChartData());
        
        $this->view('admin/dashboard', $data);
    }

    // Method baru untuk menangani halaman Semua Transaksi
    public function bookings() {
        $adminModel = $this->model('AdminModel');
        
        $data['title'] = 'Manajemen Transaksi';
        $data['bookings'] = $adminModel->getAllBookings();
        
        $this->view('admin/bookings', $data);
    }
    // Method untuk menampilkan halaman daftar pengguna
    public function users() {
        $adminModel = $this->model('AdminModel');
        
        $data['title'] = 'Manajemen Pengguna';
        $data['users'] = $adminModel->getAllUsers();
        
        $this->view('admin/users', $data);
    }

    // Method untuk menampilkan halaman verifikasi pembayaran
    public function payments() {
        $adminModel = $this->model('AdminModel');
        
        $data['title'] = 'Verifikasi Pembayaran';
        $data['payments'] = $adminModel->getPendingPayments();
        
        $this->view('admin/kelola_pembayaran', $data);
    }

    // Method untuk menghapus pengguna
    public function delete_user($id) {
        $adminModel = $this->model('AdminModel');
        
        if ($adminModel->deleteUser($id)) {
            $_SESSION['flash_success'] = "Pengguna berhasil dihapus beserta seluruh data terkait (barang, booking).";
        } else {
            $_SESSION['flash_error'] = "Terjadi kesalahan saat menghapus pengguna.";
        }
        
        header('Location: ' . BASEURL . '/admin/users');
        exit;
    }
}
?>