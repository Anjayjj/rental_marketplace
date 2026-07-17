<?php
class AdminModel {
    private $db;

    public function __construct() {
        $this->db = new Database;
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

    // Menghapus pengguna berdasarkan ID
    public function deleteUser($id) {
        // Query ini juga memastikan Admin tidak bisa menghapus sesama Admin (role = 'user')
        $query = "DELETE FROM users WHERE id = :id AND role = 'user'";
        $this->db->query($query);
        $this->db->bind('id', $id);
        
        return $this->db->execute();
    }
}
?>