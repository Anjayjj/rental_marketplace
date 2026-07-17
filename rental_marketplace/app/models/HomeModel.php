<?php
class HomeModel {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    // Mengambil 8 barang terbaru untuk di halaman depan
    public function getLatestItems($limit = 8) {
        $query = "SELECT i.*, c.name as category_name, 
                  (SELECT image_path FROM item_images WHERE item_id = i.id AND is_primary = 1 LIMIT 1) as cover_image 
                  FROM items i 
                  JOIN categories c ON i.category_id = c.id 
                  WHERE i.status = 'active' 
                  ORDER BY i.created_at DESC 
                  LIMIT :limit";
        
        $this->db->query($query);
        $this->db->bind('limit', $limit, PDO::PARAM_INT);
        return $this->db->resultSet();
    }

    // Mengambil kategori untuk dropdown dan badge
    public function getCategories() {
        $this->db->query("SELECT * FROM categories ORDER BY name ASC");
        return $this->db->resultSet();
    }

    // Logika Pencarian Kompleks (Search & Filter)
    public function searchItems($keyword = '', $category_id = '') {
        $query = "SELECT i.*, c.name as category_name, 
                  (SELECT image_path FROM item_images WHERE item_id = i.id AND is_primary = 1 LIMIT 1) as cover_image 
                  FROM items i 
                  JOIN categories c ON i.category_id = c.id 
                  WHERE i.status = 'active'";

        // Dinamis menambahkan parameter query
        if (!empty($keyword)) {
            $query .= " AND (i.name LIKE :keyword OR i.description LIKE :keyword)";
        }
        
        if (!empty($category_id)) {
            $query .= " AND i.category_id = :category_id";
        }

        $query .= " ORDER BY i.created_at DESC";

        $this->db->query($query);

        // Binding secara dinamis
        if (!empty($keyword)) {
            $this->db->bind('keyword', "%$keyword%");
        }
        if (!empty($category_id)) {
            $this->db->bind('category_id', $category_id);
        }

        return $this->db->resultSet();
    }
}
?>