<?php
class User {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function login($email) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email=?");
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    public function register($data) {
        $stmt = $this->db->prepare(
            "INSERT INTO users (nama,email,password,role) VALUES (?,?,?,?)"
        );
        return $stmt->execute($data);
    }

    public function findById($id) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id=?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function updatePhoto($id, $fotoPath) {
        $stmt = $this->db->prepare("UPDATE users SET foto=? WHERE id=?");
        return $stmt->execute([$fotoPath, $id]);
    }

    public function updateName($id, $nama) {
        $stmt = $this->db->prepare("UPDATE users SET nama=? WHERE id=?");
        return $stmt->execute([$nama, $id]);
    }
}
