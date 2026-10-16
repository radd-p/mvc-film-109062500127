CREATE DATABASE IF NOT EXISTS movies
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE movies;

CREATE TABLE IF NOT EXISTS film (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(150) NOT NULL,
    sutradara VARCHAR(100) NOT NULL,
    genre VARCHAR(50) NOT NULL,
    tahun_rilis SMALLINT NOT NULL,
    durasi SMALLINT NOT NULL COMMENT 'dalam menit',
    rating DECIMAL(3,1) NOT NULL DEFAULT 0.0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO film (judul, sutradara, genre, tahun_rilis, durasi, rating) VALUES
('Laskar Pelangi', 'Riri Riza', 'Drama', 2008, 125, 7.7),
('The Raid', 'Gareth Evans', 'Aksi', 2011, 101, 7.6),
('Pengabdi Setan', 'Joko Anwar', 'Horor', 2017, 107, 6.5),
('Dilan 1990', 'Fajar Bustomi', 'Romantis', 2018, 110, 6.6),
('Ada Apa dengan Cinta?', 'Rudi Soedjarwo', 'Romantis', 2002, 112, 7.0),
('Avengers: Endgame', 'Russo Brothers', 'Aksi', 2019, 180, 8.4);