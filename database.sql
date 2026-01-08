-- Create database
CREATE DATABASE IF NOT EXISTS jvthpqeo_tiket_konser;
USE jvthpqeo_tiket_konser;

-- Users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    foto VARCHAR(255) NULL,
    role ENUM('admin', 'user') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Konser table
CREATE TABLE IF NOT EXISTS konser (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_konser VARCHAR(255) NOT NULL,
    artis VARCHAR(255) NOT NULL,
    tanggal DATETIME NOT NULL,
    lokasi VARCHAR(255) NOT NULL,
    harga DECIMAL(10,2) NOT NULL,
    stok INT NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Pemesanan table
CREATE TABLE IF NOT EXISTS pemesanan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    konser_id INT NOT NULL,
    jumlah INT NOT NULL,
    total DECIMAL(10,2) NOT NULL,
    status ENUM('pending', 'completed', 'cancelled') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (konser_id) REFERENCES konser(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Seed accounts
-- Admin (password: password)
INSERT INTO users (nama, email, password, role) 
VALUES ('Admin', 'admin@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin');

-- Normal user (password: password)
INSERT INTO users (nama, email, password, role)
VALUES ('User Demo', 'user@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user');

-- Sample konser data
INSERT INTO konser (nama_konser, artis, tanggal, lokasi, harga, stok) VALUES
('Java Jazz Festival 2025', 'Various Artists', '2025-06-15 19:00:00', 'Jakarta International Expo', 500000.00, 1000),
('We The Fest 2025', 'Billie Eilish', '2025-07-20 18:00:00', 'GBK Stadium', 1500000.00, 5000),
('DWP 2025', 'Martin Garrix', '2025-08-10 21:00:00', 'JIS Stadium', 1200000.00, 3000);
