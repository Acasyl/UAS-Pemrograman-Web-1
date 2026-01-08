<?php
class Pesanan {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function create($data) {
        $stmt = $this->db->prepare(
            "INSERT INTO pemesanan (user_id,konser_id,jumlah,total)
             VALUES (?,?,?,?)"
        );
        return $stmt->execute($data);
    }

    public function byUser($userId) {
        $stmt = $this->db->prepare(
            "SELECT p.id, p.jumlah, p.total, p.status, p.created_at,
                    k.nama_konser, k.lokasi
             FROM pemesanan p
             JOIN konser k ON k.id = p.konser_id
             WHERE p.user_id = ?
             ORDER BY p.created_at DESC"
        );
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    }

    public function updateStatus($orderId, $status) {
        $allowed = ['pending','completed','cancelled'];
        if (!in_array($status, $allowed, true)) return false;
        $stmt = $this->db->prepare("UPDATE pemesanan SET status=? WHERE id=?");
        return $stmt->execute([$status, $orderId]);
    }
}
