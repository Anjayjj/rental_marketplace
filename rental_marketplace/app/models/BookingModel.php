<?php
class BookingModel {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    // Cek apakah tanggal bentrok dengan booking yang sudah ada (status approved/active)
    public function isDateAvailable($item_id, $start_date, $end_date) {
        $query = "SELECT COUNT(*) as count FROM bookings 
                  WHERE item_id = :item_id 
                  AND status IN ('approved', 'active')
                  AND (start_date <= :end_date AND end_date >= :start_date)";
        
        $this->db->query($query);
        $this->db->bind('item_id', $item_id);
        $this->db->bind('start_date', $start_date);
        $this->db->bind('end_date', $end_date);
        
        $result = $this->db->single();
        return $result['count'] == 0; // Mengembalikan true jika tersedia (count = 0)
    }

    // Simpan data booking
    public function createBooking($data) {
        $query = "INSERT INTO bookings 
                  (invoice_no, item_id, user_id, start_date, end_date, duration, daily_price, total_price, admin_fee, grand_total, status) 
                  VALUES 
                  (:invoice_no, :item_id, :user_id, :start_date, :end_date, :duration, :daily_price, :total_price, :admin_fee, :grand_total, 'pending')";

        $this->db->query($query);
        // Binding data...
        $this->db->bind('invoice_no', $data['invoice_no']);
        $this->db->bind('item_id', $data['item_id']);
        $this->db->bind('user_id', $data['user_id']);
        $this->db->bind('start_date', $data['start_date']);
        $this->db->bind('end_date', $data['end_date']);
        $this->db->bind('duration', $data['duration']);
        $this->db->bind('daily_price', $data['daily_price']);
        $this->db->bind('total_price', $data['total_price']);
        $this->db->bind('admin_fee', $data['admin_fee']);
        $this->db->bind('grand_total', $data['grand_total']);

        return $this->db->execute();
    }
    public function getBookingsByUser($user_id) {
        $query = "SELECT b.*, i.name as item_name 
                  FROM bookings b
                  JOIN items i ON b.item_id = i.id
                  WHERE b.user_id = :user_id
                  ORDER BY b.created_at DESC";
        $this->db->query($query);
        $this->db->bind('user_id', $user_id);
        return $this->db->resultSet();
    }

    // Mengambil satu booking lengkap beserta nama barang (untuk invoice)
    public function getBookingById($id) {
        $query = "SELECT b.*, i.name as item_name 
                  FROM bookings b
                  JOIN items i ON b.item_id = i.id
                  WHERE b.id = :id";
        $this->db->query($query);
        $this->db->bind('id', $id);
        return $this->db->single();
    }
}
?>