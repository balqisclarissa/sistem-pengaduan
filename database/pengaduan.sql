CREATE TABLE user (
    id_user INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    nama_lengkap VARCHAR(100) NOT NULL,
    telp VARCHAR(20) NOT NULL,
    role ENUM('admin','user') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE pengaduan(
    id_pengaduan INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT NOT NULL,
    isi_pengaduan TEXT NOT NULL,
    status ENUM('Menunggu','Diproses','Selesai') DEFAULT 'Menunggu',
    tanggal TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY(id_user)
    REFERENCES user(id_user)
);

ALTER TABLE pengaduan add tanggapan TEXT;

INSERT INTO user (email, password, nama_lengkap, telp, role) VALUES ('admin@gmail.com', '$2y$10$BcnuQqHHV.CjhnTxJc8jburc3GtR.SlNf.aG5o.gXEkOYOTuhd7KO', 'Admin', '08122345678', 'admin');