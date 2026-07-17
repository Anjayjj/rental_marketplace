<?php
class HomeController extends Controller {

    public function index() {
        $homeModel = $this->model('HomeModel');

        $data['title'] = 'RentalMarket - Sewa Peralatan Terpercaya';
        $data['categories'] = $homeModel->getCategories();
        $data['items'] = $homeModel->getLatestItems(8);

        $this->view('public/home', $data);
    }

    public function explore() {
        $homeModel = $this->model('HomeModel');

        // Menangkap parameter GET dari form pencarian (name="search"), filter kategori & sorting
        $keyword = isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '';
        $category_id = isset($_GET['category']) ? (int)$_GET['category'] : 0;
        $sort = isset($_GET['sort']) ? $_GET['sort'] : 'terbaru';

        $data['title'] = 'Eksplorasi Barang';
        $data['categories'] = $homeModel->getCategories();
        $data['items'] = $homeModel->searchItems($keyword, $category_id, $sort);

        // Kirim kembali parameter agar form search & filter tetap terisi (Sticky Form)
        $data['search_q'] = $keyword;
        $data['search_cat'] = $category_id;
        $data['sort'] = $sort;

        $this->view('public/explore', $data);
    }
}
