<?php
class ItemModel {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    // Mengambil semua kategori untuk dropdown form
    public function getCategories() {
        $this->db->query("SELECT * FROM categories ORDER BY name ASC");
        return $this->db->resultSet();
    }

    // Mengambil barang khusus milik user yang sedang login
    public function getItemsByOwner($owner_id) {
        $query = "SELECT i.*, c.name as category_name, 
                  (SELECT image_path FROM item_images WHERE item_id = i.id AND is_primary = 1 LIMIT 1) as cover_image 
                  FROM items i 
                  JOIN categories c ON i.category_id = c.id 
                  WHERE i.owner_id = :owner_id 
                  ORDER BY i.created_at DESC";
        $this->db->query($query);
        $this->db->bind('owner_id', $owner_id);
        return $this->db->resultSet();
    }

    // Menyimpan Barang beserta Foto Utama (Menggunakan Transaction)
    public function storeItem($data, $image_filename) {
        try {
            $this->db->dbh->beginTransaction();

            // 1. Insert tabel items
            $queryItem = "INSERT INTO items 
                          (owner_id, category_id, name, slug, description, price_daily) 
                          VALUES 
                          (:owner_id, :category_id, :name, :slug, :description, :price_daily)";
            $this->db->query($queryItem);
            $this->db->bind('owner_id', $data['owner_id']);
            $this->db->bind('category_id', $data['category_id']);
            $this->db->bind('name', $data['name']);
            $this->db->bind('slug', $data['slug']);
            $this->db->bind('description', $data['description']);
            $this->db->bind('price_daily', $data['price_daily']);
            $this->db->execute();

            // Ambil ID item yang baru saja diinsert
            $item_id = $this->db->dbh->lastInsertId();

            // 2. Insert tabel item_images (Set sebagai primary)
            $queryImg = "INSERT INTO item_images (item_id, image_path, is_primary) 
                         VALUES (:item_id, :image_path, 1)";
            $this->db->query($queryImg);
            $this->db->bind('item_id', $item_id);
            $this->db->bind('image_path', $image_filename);
            $this->db->execute();

            $this->db->dbh->commit();
            return true;
        } catch (Exception $e) {
            $this->db->dbh->rollBack();
            return false;
        }
    }

    // Mengecek kepemilikan sebelum Hapus / Edit (Proteksi IDOR)
    public function checkOwnership($item_id, $owner_id) {
        $this->db->query("SELECT id FROM items WHERE id = :id AND owner_id = :owner_id");
        $this->db->bind('id', $item_id);
        $this->db->bind('owner_id', $owner_id);
        return $this->db->single(); // Jika return data, berarti benar miliknya
    }

    public function deleteItem($id) {
        $this->db->query("DELETE FROM items WHERE id = :id");
        $this->db->bind('id', $id);
        return $this->db->execute();
    }
    // Mengambil detail barang beserta info pemiliknya berdasarkan Slug (URL)
    public function getItemBySlug($slug) {
        $query = "SELECT i.*, 
                         c.name as category_name, 
                         u.name as owner_name, 
                         u.avatar as owner_avatar,
                         u.phone as owner_phone
                  FROM items i 
                  JOIN categories c ON i.category_id = c.id 
                  JOIN users u ON i.owner_id = u.id 
                  WHERE i.slug = :slug AND i.status != 'inactive'";
        $this->db->query($query);
        $this->db->bind('slug', $slug);
        return $this->db->single();
    }

    // Mengambil semua foto barang untuk ditampilkan di Carousel Slider
    public function getItemImages($item_id) {
        $query = "SELECT image_path, is_primary 
                  FROM item_images 
                  WHERE item_id = :item_id 
                  ORDER BY is_primary DESC"; // Foto utama akan tampil pertama
        $this->db->query($query);
        $this->db->bind('item_id', $item_id);
        return $this->db->resultSet();
    }

    // Mengambil detail barang berdasarkan ID (Digunakan untuk validasi saat proses Booking)
    public function getItemById($id) {
        $query = "SELECT * FROM items WHERE id = :id";
        $this->db->query($query);
        $this->db->bind('id', $id);
        return $this->db->single();
    }
}
?>