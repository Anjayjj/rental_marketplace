<?php
class PaymentController extends Controller {

    public function upload() {
        $this->requireAuth('user');

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // 1. CSRF Validation
            if ($_POST['csrf_token'] !== $_SESSION['csrf_token']) {
                die("Akses ditolak.");
            }

            $booking_id = (int)$_POST['booking_id'];
            $amount = $_POST['amount'];
            $payment_method = htmlspecialchars($_POST['payment_method']);

            // 2. Validasi File Upload
            if (!isset($_FILES['proof_image']) || $_FILES['proof_image']['error'] !== UPLOAD_ERR_OK) {
                $_SESSION['flash_error'] = "File rusak atau belum diunggah.";
                header('Location: ' . BASEURL . '/booking/invoice/' . $booking_id);
                exit;
            }

            $file = $_FILES['proof_image'];
            $max_size = 2 * 1024 * 1024; // 2 MB

            // Cek Ukuran
            if ($file['size'] > $max_size) {
                $_SESSION['flash_error'] = "Ukuran file maksimal 2MB.";
                header('Location: ' . BASEURL . '/booking/invoice/' . $booking_id);
                exit;
            }

            // Cek MIME-Type sesungguhnya (Bukan dari ekstensi nama file)
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mime_type = finfo_file($finfo, $file['tmp_name']);
            finfo_close($finfo);

            $allowed_types = ['image/jpeg', 'image/png', 'image/jpg'];
            if (!in_array($mime_type, $allowed_types)) {
                $_SESSION['flash_error'] = "Format file tidak didukung. Gunakan JPG atau PNG.";
                header('Location: ' . BASEURL . '/booking/invoice/' . $booking_id);
                exit;
            }

            // 3. Generate Nama File Unik & Aman
            $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
            $new_filename = 'proof_' . date('YmdHis') . '_' . bin2hex(random_bytes(8)) . '.' . $extension;
            $upload_path = '../public/assets/uploads/payments/' . $new_filename;

            // Pindahkan file
            if (move_uploaded_file($file['tmp_name'], $upload_path)) {
                
                $data = [
                    'booking_id' => $booking_id,
                    'amount' => $amount,
                    'payment_method' => $payment_method,
                    'proof_image' => $new_filename
                ];

                // 4. Simpan ke database
                $paymentModel = $this->model('PaymentModel');
                if ($paymentModel->storePayment($data)) {
                    $_SESSION['flash_success'] = "Bukti pembayaran berhasil diunggah. Menunggu verifikasi Admin.";
                    header('Location: ' . BASEURL . '/user/booking_saya');
                    exit;
                }
            } else {
                $_SESSION['flash_error'] = "Gagal mengunggah sistem. Periksa perizinan folder.";
                header('Location: ' . BASEURL . '/booking/invoice/' . $booking_id);
                exit;
            }
        }
    }
}
?>