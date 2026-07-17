<?php
class HomeController extends Controller {

    public function index() {
        // Langsung panggil method explore() agar katalog tampil di halaman depan
        $this->explore();
    }

    public function explore() {
        $homeModel = $this->model('HomeModel');
        
        // Menangkap parameter GET dari form pencarian
        $keyword = isset($_GET['q']) ? htmlspecialchars($_GET['q']) : '';
        $category_id = isset($_GET['category']) ? (int)$_GET['category'] : '';

        $data['title'] = 'Eksplorasi Barang';
        $data['categories'] = $homeModel->getCategories();
        $data['items'] = $homeModel->searchItems($keyword, $category_id);
        
        // Kirim kembali parameter agar form search tetap terisi (Sticky Form)
        $data['search_q'] = $keyword;
        $data['search_cat'] = $category_id;

        $this->view('public/explore', $data);
    }
}
?>