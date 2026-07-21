<?php
class AdminController extends Controller {

    public function __construct() {
        // PROTEKSI MUTLAK: Hanya Admin
        $this->requireAuth('admin');
        // --- Kelola Kategori ---
    public function categories() {
        $adminModel = $this->model('AdminModel');
        $data['title'] = 'Manajemen Kategori';
        $data['categories'] = $adminModel->getCategories();
        $this->view('admin/categories', $data);
    }
    public function add_category() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($_POST['csrf_token'] !== $_SESSION['csrf_token']) die("CSRF Token Invalid.");
            $name = htmlspecialchars($_POST['name']);
            $icon = htmlspecialchars($_POST['icon'] ?? 'fas fa-tag');
            $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name))) . '-' . time();
            $adminModel = $this->model('AdminModel');
            $adminModel->addCategory($name, $icon, $slug);
            $adminModel->logAction($_SESSION['user_id'], 'add_category', 'category', null, $name);
            $_SESSION['flash_success'] = "Kategori ditambahkan.";
            header('Location: ' . BASEURL . '/admin/categories');
            exit;
        }
    }
    public function edit_category($id) {
        $adminModel = $this->model('AdminModel');
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($_POST['csrf_token'] !== $_SESSION['csrf_token']) die("CSRF Token Invalid.");
            $name = htmlspecialchars($_POST['name']);
            $icon = htmlspecialchars($_POST['icon'] ?? 'fas fa-tag');
            $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name))) . '-' . $id;
            $adminModel->updateCategory($id, $name, $icon, $slug);
            $adminModel->logAction($_SESSION['user_id'], 'edit_category', 'category', $id, $name);
            $_SESSION['flash_success'] = "Kategori diperbarui.";
            header('Location: ' . BASEURL . '/admin/categories');
            exit;
        }
        $data['title'] = 'Edit Kategori';
        $data['category'] = $adminModel->getCategories();
        $data['category'] = $data['categories'][array_search($id, array_column($data['categories'], 'id'))] ?? null;
        $this->view('admin/categories', $data);
    }
    public function delete_category($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($_POST['csrf_token'] !== $_SESSION['csrf_token']) die("CSRF Token Invalid.");
            $adminModel = $this->model('AdminModel');
            $ok = $adminModel->deleteCategory($id);
            $adminModel->logAction($_SESSION['user_id'], 'delete_category', 'category', $id, $ok ? 'ok' : 'used_by_items');
            $_SESSION['flash_success'] = $ok ? "Kategori dihapus." : "Gagal: kategori masih dipakai oleh item.";
            header('Location: ' . BASEURL . '/admin/categories');
            exit;
        }
    }

    // --- Kelola Barang ---
    public function items() {
        $adminModel = $this->model('AdminModel');
        $data['title'] = 'Manajemen Barang';
        $data['items'] = $adminModel->getAllItems($_GET['q'] ?? '');
        $data['categories'] = $adminModel->getCategories();
        $this->view('admin/items', $data);
    }
    public function update_item_status($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($_POST['csrf_token'] !== $_SESSION['csrf_token']) die("CSRF Token Invalid.");
            $status = $_POST['status'];
            $adminModel = $this->model('AdminModel');
            $adminModel->updateItemStatus($id, $status);
            $adminModel->logAction($_SESSION['user_id'], 'update_item_status', 'item', $id, $status);
            $_SESSION['flash_success'] = "Status barang diperbarui.";
        }
        header('Location: ' . BASEURL . '/admin/items');
        exit;
    }
    public function update_item_category($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($_POST['csrf_token'] !== $_SESSION['csrf_token']) die("CSRF Token Invalid.");
            $cat = (int)$_POST['category_id'];
            $adminModel = $this->model('AdminModel');
            $adminModel->updateItemCategory($id, $cat);
            $adminModel->logAction($_SESSION['user_id'], 'assign_category', 'item', $id, 'cat='.$cat);
            $_SESSION['flash_success'] = "Kategori barang diperbarui.";
        }
        header('Location: ' . BASEURL . '/admin/items');
        exit;
    }
    public function delete_item($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($_POST['csrf_token'] !== $_SESSION['csrf_token']) die("CSRF Token Invalid.");
            $adminModel = $this->model('AdminModel');
            $adminModel->deleteItem($id);
            $adminModel->logAction($_SESSION['user_id'], 'delete_item', 'item', $id, null);
            $_SESSION['flash_success'] = "Barang dihapus.";
        }
        header('Location: ' . BASEURL . '/admin/items');
        exit;
    }

    // --- Kelola Booking ---
    public function update_booking_status($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($_POST['csrf_token'] !== $_SESSION['csrf_token']) die("CSRF Token Invalid.");
            $status = $_POST['status'];
            $adminModel = $this->model('AdminModel');
            $adminModel->updateBookingStatus($id, $status);
            $adminModel->logAction($_SESSION['user_id'], 'update_booking_status', 'booking', $id, $status);
            $_SESSION['flash_success'] = "Status transaksi diperbarui.";
        }
        header('Location: ' . BASEURL . '/admin/bookings');
        exit;
    }

    // --- Kelola Review ---
    public function delete_review($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($_POST['csrf_token'] !== $_SESSION['csrf_token']) die("CSRF Token Invalid.");
            $adminModel = $this->model('AdminModel');
            $adminModel->deleteReview($id);
            $adminModel->logAction($_SESSION['user_id'], 'delete_review', 'review', $id, null);
            $_SESSION['flash_success'] = "Ulasan dihapus.";
        }
        header('Location: ' . BASEURL . '/admin/bookings');
        exit;
    }

    // --- Activity Log ---
    public function logs() {
        $adminModel = $this->model('AdminModel');
        $data['title'] = 'Log Aktivitas Admin';
        $data['logs'] = $adminModel->getLogs(200);
        $this->view('admin/logs', $data);
    }
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
        $data['uncategorized'] = $adminModel->getAllItems(''); // akan difilter di model/view? simpler: ambil semua lalu filter category_id=7
        $data['uncategorized'] = array_filter($data['uncategorized'] ?? [], function($it){ return (int)($it['category_id'] ?? 0) === 7; });
        $data['all_categories'] = $adminModel->getCategories();
        
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
    public function toggle_super_admin($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($_POST['csrf_token'] !== $_SESSION['csrf_token']) die("CSRF Token Invalid.");
            $flag = !empty($_POST['flag']);
            $adminModel = $this->model('AdminModel');
            $adminModel->toggleSuperAdmin($id, $flag);
            $adminModel->logAction($_SESSION['user_id'], 'toggle_super_admin', 'user', $id, $flag ? 'grant' : 'revoke');
            $_SESSION['flash_success'] = "Hak akses super admin diperbarui.";
        }
        header('Location: ' . BASEURL . '/admin/users');
        exit;
    }
}
?>