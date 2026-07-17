<?php
class Controller {
    public function view($view, $data = []) {
        // XSS Protection pada data yang dikirim ke view
        require_once '../app/views/' . $view . '.php';
    }

    public function model($model) {
        require_once '../app/models/' . $model . '.php';
        return new $model;
    }
    
    // Role Middleware
    public function requireAuth($role = null) {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASEURL . '/auth/login');
            exit;
        }
        if ($role && $_SESSION['user_role'] != $role) {
            header('Location: ' . BASEURL . '/error/403');
            exit;
        }
    }
}
?>