<?php
require_once 'models/user.php';

class ProfileController {
    public function index() {
        if (!isset($_SESSION['user'])) {
            header('Location: /Tiket_konser/login');
            exit;
        }
        $user = (new User)->findById($_SESSION['user']['id']);
        require 'views/user/profile.php';
    }

    public function updatePhoto() {
        if (!isset($_SESSION['user'])) {
            header('Location: /Tiket_konser/login');
            exit;
        }
        if (!isset($_FILES['foto']) || $_FILES['foto']['error'] !== UPLOAD_ERR_OK) {
            $error = 'Upload gagal. Silakan coba lagi.';
            $user = (new User)->findById($_SESSION['user']['id']);
            require 'views/user/profile.php';
            return;
        }
        $file = $_FILES['foto'];
        $allowed = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/webp' => 'webp'];
        $mime = mime_content_type($file['tmp_name']);
        if (!isset($allowed[$mime])) {
            $error = 'Format gambar harus JPG/PNG/WebP.';
            $user = (new User)->findById($_SESSION['user']['id']);
            require 'views/user/profile.php';
            return;
        }
        $ext = $allowed[$mime];
        $dir = __DIR__ . '/../uploads/avatars/';
        if (!is_dir($dir)) { @mkdir($dir, 0777, true); }
        $filename = 'u' . $_SESSION['user']['id'] . '_' . time() . '.' . $ext;
        $destPath = $dir . $filename;
        if (!move_uploaded_file($file['tmp_name'], $destPath)) {
            $error = 'Gagal menyimpan file.';
            $user = (new User)->findById($_SESSION['user']['id']);
            require 'views/user/profile.php';
            return;
        }
        // path public relatif
        $publicPath = '/Tiket_konser/uploads/avatars/' . $filename;
        (new User)->updatePhoto($_SESSION['user']['id'], $publicPath);
        // update session agar avatar langsung berubah
        $_SESSION['user']['foto'] = $publicPath;
        header('Location: /Tiket_konser/profile');
        exit;
    }

    public function updateName() {
        if (!isset($_SESSION['user'])) {
            header('Location: /Tiket_konser/login');
            exit;
        }
        $nama = trim($_POST['nama'] ?? '');
        if ($nama === '') {
            $error = 'Nama tidak boleh kosong.';
            $user = (new User)->findById($_SESSION['user']['id']);
            require 'views/user/profile.php';
            return;
        }
        (new User)->updateName($_SESSION['user']['id'], $nama);
        $_SESSION['user']['nama'] = $nama;
        header('Location: /Tiket_konser/profile');
        exit;
    }
}
