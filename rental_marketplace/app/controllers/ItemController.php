<?php
class ItemController extends Controller {

    public function detail($slug) {
        // Bebas diakses tanpa login
        $itemModel = $this->model('ItemModel'); // Asumsi ada method getItemBySlug() dan getImages()
        $reviewModel = $this->model('ReviewModel');
        $wishlistModel = $this->model('WishlistModel');

        // Ambil Data Barang & Pemilik
        $item = $itemModel->getItemBySlug($slug);
        
        if (!$item) {
            header('Location: ' . BASEURL . '/error/404');
            exit;
        }

        $item_id = $item['id'];

        $data['item'] = $item;
        $data['images'] = $itemModel->getItemImages($item_id); // Ambil galeri foto
        
        // Ambil Data Review
        $data['reviews'] = $reviewModel->getReviewsByItem($item_id);
        $data['rating'] = $reviewModel->getAverageRating($item_id);

        // Cek Wishlist (Hanya jika login)
        $data['is_wishlist'] = false;
        if (isset($_SESSION['user_id'])) {
            $data['is_wishlist'] = $wishlistModel->checkWishlist($_SESSION['user_id'], $item_id) ? true : false;
        }

        $this->view('public/detail_barang', $data);
    }

    // Endpoint AJAX untuk Wishlist
    public function toggle_wishlist() {
        if (!isset($_SESSION['user_id'])) {
            echo json_encode(['status' => 'error', 'message' => 'Silakan login terlebih dahulu.']);
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $item_id = (int)$_POST['item_id'];
            $user_id = $_SESSION['user_id'];

            $wishlistModel = $this->model('WishlistModel');
            $action = $wishlistModel->toggleWishlist($user_id, $item_id);

            echo json_encode(['status' => 'success', 'action' => $action]);
        }
    }
}
?>