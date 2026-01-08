<?php
require_once 'models/pesanan.php';
require_once 'models/konser.php';

class PesananController {
    public function pesan($id) {
        if (!isset($_SESSION['user'])) {
            header('Location: /Tiket_konser/login');
            exit;
        }
        $konser = (new Konser)->find($id);

        if ($_POST) {
            $jumlah = max(0, (int)($_POST['jumlah'] ?? 0));
            if ($jumlah < 1) {
                $error = 'Jumlah tiket minimal 1.';
                require 'views/user/pesan.php';
                return;
            }
            if ($jumlah > (int)$konser['stok']) {
                $error = 'Jumlah melebihi stok tersedia.';
                require 'views/user/pesan.php';
                return;
            }
            $total = $jumlah * $konser['harga'];

            (new Pesanan)->create([
                $_SESSION['user']['id'],
                $id,
                $jumlah,
                $total
            ]);

            (new Konser)->reduceStock($id, $jumlah);
            header('Location: /Tiket_konser/');
            exit;
        }
        // GET: tampilkan form pemesanan
        require 'views/user/pesan.php';
    }

    public function my() {
        if (!isset($_SESSION['user'])) {
            header('Location: /Tiket_konser/login');
            exit;
        }
        $orders = (new Pesanan)->byUser($_SESSION['user']['id']);
        require 'views/user/pesanan_saya.php';
    }
}
