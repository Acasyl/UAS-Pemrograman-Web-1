<?php
class Konser {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function all() {
        return $this->db->query("SELECT * FROM konser")->fetchAll();
    }

    public function create($data) {
        $stmt = $this->db->prepare(
            "INSERT INTO konser (nama_konser,artis,tanggal,lokasi,harga,stok)
             VALUES (?,?,?,?,?,?)"
        );
        return $stmt->execute($data);
    }

    public function find($id) {
        $stmt = $this->db->prepare("SELECT * FROM konser WHERE id=?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function reduceStock($id, $qty) {
        $stmt = $this->db->prepare(
            "UPDATE konser SET stok = stok - ? WHERE id=?"
        );
        return $stmt->execute([$qty, $id]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM konser WHERE id=?");
        return $stmt->execute([$id]);
    }
}
