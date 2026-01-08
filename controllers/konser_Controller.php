<?php
require_once 'models/konser.php';
require_once 'models/pesanan.php';

class KonserController {
    public function home() {
        $konser = (new Konser)->all();
        require 'views/user/home.php';
    }

    public function index() {
        if (!isset($_SESSION['user'])) {
            header('Location: /Tiket_konser/login');
            exit;
        }
        if ($_SESSION['user']['role'] !== 'admin') {
            header('Location: /Tiket_konser/');
            exit;
        }

        // Handle delete action
        if (isset($_GET['hapus'])) {
            $id = (int)$_GET['hapus'];
            if ($id > 0) {
                (new Konser)->delete($id);
            }
            header('Location: /Tiket_konser/admin');
            exit;
        }

        // Handle update order status action
        if (isset($_GET['order_id'], $_GET['set_status'])) {
            $orderId = (int)$_GET['order_id'];
            $status = $_GET['set_status'];
            if ($orderId > 0 && in_array($status, ['pending','completed','cancelled'], true)) {
                (new Pesanan)->updateStatus($orderId, $status);
            }
            header('Location: /Tiket_konser/admin');
            exit;
        }

        $konser = (new Konser)->all();

        // Dashboard statistics
        $db = Database::connect();
        $totalUsers   = (int)$db->query("SELECT COUNT(*) FROM users")->fetchColumn();
        $totalKonser  = (int)$db->query("SELECT COUNT(*) FROM konser")->fetchColumn();
        $totalPesanan = (int)$db->query("SELECT COUNT(*) FROM pemesanan")->fetchColumn();
        $totalRevenue = (float)$db->query("SELECT COALESCE(SUM(total),0) FROM pemesanan")->fetchColumn();

        // Recent orders
        $recentOrdersStmt = $db->query(
            "SELECT p.id, u.nama AS user_nama, k.nama_konser, p.jumlah, p.total, p.status, p.created_at
             FROM pemesanan p
             JOIN users u ON u.id = p.user_id
             JOIN konser k ON k.id = p.konser_id
             ORDER BY p.created_at DESC
             LIMIT 5"
        );
        $recentOrders = $recentOrdersStmt->fetchAll();

        if ($_POST) {
            // Create with explicit ordering to match positional placeholders
            (new Konser)->create([
                $_POST['nama_konser'] ?? '',
                $_POST['artis'] ?? '',
                $_POST['tanggal'] ?? '',
                $_POST['lokasi'] ?? '',
                (float)($_POST['harga'] ?? 0),
                (int)($_POST['stok'] ?? 0),
            ]);
            header('Location: /Tiket_konser/admin');
            exit;
        }

        require 'views/admin/konser.php';
    }
}
