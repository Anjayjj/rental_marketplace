<?php
class AdminBookingController extends Controller {

    public function verify($payment_id, $action) {
        // 1. Pastikan yang akses adalah Admin
        $this->requireAuth('admin');

        $paymentModel = $this->model('PaymentModel');
        // Ambil data payment untuk mendapatkan booking_id (Asumsi ada method getPaymentById)
        $payment = $paymentModel->getPaymentById($payment_id); 
        
        if (!$payment) {
            header('Location: ' . BASEURL . '/admin/payments');
            exit;
        }

        $booking_id = $payment['booking_id'];

        // 2. Logika Keputusan Admin
        if ($action === 'approve') {
            // Jika disetujui: Payment = verified, Booking = approved
            $paymentModel->updatePaymentStatus($payment_id, $booking_id, 'verified', 'approved');
            $_SESSION['flash_success'] = "Pembayaran berhasil diverifikasi. Booking disetujui.";
            
            // TODO: (Opsional) Trigger Notifikasi ke User & Pemilik Barang
            
        } elseif ($action === 'reject') {
            // Jika ditolak (misal bukti palsu): Payment = failed, Booking = rejected
            $paymentModel->updatePaymentStatus($payment_id, $booking_id, 'failed', 'rejected');
            $_SESSION['flash_error'] = "Pembayaran ditolak. Booking dibatalkan.";
        }

        header('Location: ' . BASEURL . '/admin/payments');
        exit;
    }
}
?>