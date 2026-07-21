<?php
class AdminModel {
    private $db;

    public function __construct() {
        $this->db = new Database;
        // --- Kategori ---
    public function getCategories() {
        $this->db->query("SELECT * FROM categories ORDER BY name ASC");
        return $this->db->resultSet();
    }
    public function addCategory($name, $icon, $slug) {
        $this->db->query("INSERT INTO categories (name, icon, slug) VALUES (:name, :icon, :slug)");
        $this->db->bind('name', $name);
        $this->db->bind('icon', $icon);
        $this->db->bind('slug', $slug);
        return $this->db->execute();
    }
    public function updateCategory($id, $name, $icon, $slug) {
        $this->db->query("UPDATE categories SET name=:name, icon=:icon, slug=:slug WHERE id=:id");
        $this->db->bind('name', $name);
        $this->db->bind('icon', $icon);
        $this->db->bind('slug', $slug);
        $this->db->bind('id', $id);
        return $this->db->execute();
    }
    public function deleteCategory($id) {
        // Cegah hapus kategori yang masih dipakai
        $this->db->query("SELECT COUNT(*) as c FROM items WHERE category_id = :id");
        $this->db->bind('id', $id);
        $row = $this->db->single();
        if ((int)($row['c'] ?? 0) > 0) {
            return false;
        }
        $this->db->query("DELETE FROM categories WHERE id = :id");
        $this->db->bind('id', $id);
        return $this->db->execute();
    }

    // --- Barang ---
    public function getAllItems($q = '') {
        $sql = "SELECT i.*, c.name as category_name, u.name as owner_name,
                (SELECT image_path FROM item_images WHERE item_id = i.id AND is_primary = 1 LIMIT 1) as cover_image
                FROM items i
                JOIN users u ON i.owner_id = u.id
                JOIN categories c ON i.category_id = c.id";
        if ($q !== '') {
            $sql .= " WHERE i.name LIKE :q OR u.name LIKE :q";
        }
        $sql .= " ORDER BY i.created_at DESC";
        $this->db->query($sql);
        if ($q !== '') $this->db->bind('q', "%$q%");
        return $this->db->resultSet();
    }
    public function updateItemStatus($id, $status) {
        $this->db->query("UPDATE items SET status = :status WHERE id = :id");
        $this->db->bind('status', $status);
        $this->db->bind('id', $id);
        return $this->db->execute();
    }
    public function updateItemCategory($id, $category_id) {
        $this->db->query("UPDATE items SET category_id = :category_id WHERE id = :id");
        $this->db->bind('category_id', $category_id);
        $this->db->bind('id', $id);
        return $this->db->execute();
    }
    public function deleteItem($id) {
        $this->db->query("DELETE FROM items WHERE id = :id");
        $this->db->bind('id', $id);
        return $this->db->execute();
    }

    // --- Booking ---
    public function updateBookingStatus($id, $status) {
        $this->db->query("UPDATE bookings SET status = :status WHERE id = :id");
        $this->db->bind('status', $status);
        $this->db->bind('id', $id);
        return $this->db->execute();
    }

    // --- Review ---
    public function deleteReview($id) {
        $this->db->query("DELETE FROM reviews WHERE id = :id");
        $this->db->bind('id', $id);
        return $this->db->execute();
    }

    // --- Admin Logs ---
    public function logAction($admin_id, $action, $target_type = null, $target_id = null, $note = null) {
        $this->db->query("INSERT INTO admin_logs (admin_id, action, target_type, target_id, note) VALUES (:admin_id, :action, :target_type, :target_id, :note)");
        $this->db->bind('admin_id', $admin_id);
        $this->db->bind('action', $action);
        $this->db->bind('target_type', $target_type);
        $this->db->bind('target_id', $target_id);
        $this->db->bind('note', $note);
        return $this->db->execute();
    }
    public function getLogs($limit = 100) {
        $this->db->query("SELECT l.*, u.name as admin_name FROM admin_logs l JOIN users u ON l.admin_id = u.id ORDER BY l.created_at DESC LIMIT :limit");
        $this->db->bind('limit', $limit, PDO::PARAM_INT);
        return $this->db->resultSet();
    }

}

    // Statistik Widget Cards
    public function getDashboardStats() {
        $stats = [];
        
        // Total User (kecuali admin)
        $this->db->query("SELECT COUNT(*) as count FROM users WHERE role = 'user'");
        $stats['total_users'] = $this->db->single()['count'];

        // Total Barang Aktif
        $this->db->query("SELECT COUNT(*) as count FROM items WHERE status != 'inactive'");
        $stats['total_items'] = $this->db->single()['count'];

        // Total Booking Berhasil (Selesai/Aktif)
        $this->db->query("SELECT COUNT(*) as count FROM bookings WHERE status IN ('completed', 'active', 'approved')");
        $stats['total_bookings'] = $this->db->single()['count'];

        // Total Pendapatan (Hanya Biaya Admin dari Booking yang Selesai/Aktif)
        // Di marketplace P2P, pendapatan platform biasanya dari admin_fee, bukan grand_total
        $this->db->query("SELECT SUM(admin_fee) as total FROM bookings WHERE status IN ('completed', 'active')");
        $stats['total_revenue'] = $this->db->single()['total'] ?? 0;

        return $stats;
    }

    // Data untuk Chart.js (Pendapatan Platform per Bulan di Tahun Berjalan)
    public function getRevenueChartData($year = null) {
        if (!$year) $year = date('Y');
        
        // Query untuk mengelompokkan total biaya admin berdasarkan bulan
        $query = "SELECT MONTH(created_at) as month, SUM(admin_fee) as total 
                  FROM bookings 
                  WHERE YEAR(created_at) = :year AND status IN ('completed', 'active')
                  GROUP BY MONTH(created_at)
                  ORDER BY month ASC";
        
        $this->db->query($query);
        $this->db->bind('year', $year);
        $results = $this->db->resultSet();

        // Inisialisasi array 12 bulan dengan nilai 0
        $chartData = array_fill(1, 12, 0); 
        
        foreach ($results as $row) {
            $chartData[$row['month']] = (float)$row['total'];
        }

        return array_values($chartData); // Return array flat [jan, feb, mar...]
    }

    // Mengambil 5 Transaksi Terbaru
    public function getRecentBookings() {
        $query = "SELECT b.invoice_no, b.status, b.grand_total, b.created_at, u.name as user_name 
                  FROM bookings b 
                  JOIN users u ON b.user_id = u.id 
                  ORDER BY b.created_at DESC LIMIT 5";
        $this->db->query($query);
        return $this->db->resultSet();
    }
    // Mengambil seluruh data transaksi untuk tabel admin
    public function getAllBookings() {
        $query = "SELECT b.*, u.name as user_name, i.name as item_name 
                  FROM bookings b 
                  JOIN users u ON b.user_id = u.id 
                  JOIN items i ON b.item_id = i.id
                  ORDER BY b.created_at DESC";
        $this->db->query($query);
        return $this->db->resultSet();
    }
    // Mengambil semua daftar pengguna (kecuali admin)
    public function getAllUsers() {
        $query = "SELECT * FROM users WHERE role = 'user' ORDER BY created_at DESC";
        $this->db->query($query);
        return $this->db->resultSet();
    }

    // Mengambil daftar pembayaran yang menunggu verifikasi (join booking + item)
    public function getPendingPayments() {
        $query = "SELECT p.*, b.invoice_no, b.grand_total, i.name as item_name, u.name as user_name 
                  FROM payments p 
                  JOIN bookings b ON p.booking_id = b.id 
                  JOIN items i ON b.item_id = i.id 
                  JOIN users u ON b.user_id = u.id 
                  WHERE p.status = 'pending' 
                  ORDER BY p.created_at DESC";
        $this->db->query($query);
        return $this->db->resultSet();
    }

    // Mengambil satu pembayaran berdasarkan ID
    public function getPaymentById($id) {
        $this->db->query("SELECT * FROM payments WHERE id = :id");
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    // Menghapus pengguna berdasarkan ID
    public function deleteUser($id) {
        // Query ini juga memastikan Admin tidak bisa menghapus sesama Admin (role = 'user')
        $query = "DELETE FROM users WHERE id = :id AND role = 'user'";
        $this->db->query($query);
        $this->db->bind('id', $id);
        
        return $this->db->execute();
    }
    public function toggleSuperAdmin($id, $flag) {
        $this->db->query("UPDATE users SET is_super_admin = :flag WHERE id = :id");
        $this->db->bind('flag', $flag ? 1 : 0);
        $this->db->bind('id', $id);
        return $this->db->execute();
    }
}
?>