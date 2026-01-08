<?php
class Database {
    public static function connect() {
        $host = 'localhost';
        $db   = 'tiket_konser';
        $user = 'root';
        $pass = '';
        $port = 3306; // ubah jika MySQL Anda di port lain, mis. 3307

        $dsn = "mysql:host={$host};port={$port};dbname={$db};charset=utf8mb4";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_PERSISTENT         => false,
        ];
        return new PDO($dsn, $user, $pass, $options);
    }
}
