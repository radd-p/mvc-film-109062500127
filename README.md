# MVC PHP Native - Data Film

Aplikasi CRUD sederhana untuk mempelajari pola Model-View-Controller pada PHP Native dengan tema **Data Film**.

## Kebutuhan
- PHP 8.1 atau lebih baru
- MySQL/MariaDB
- Web server lokal seperti XAMPP atau Laragon
- Git

## Instalasi
1. Clone atau salin project ke folder web server (`htdocs` pada XAMPP / `www` pada Laragon).
2. Import `database/film.sql` melalui phpMyAdmin (menu Import) atau terminal:
   `mysql -u root -p < database/film.sql`
3. Sesuaikan username dan password database pada `config/database.php`.
4. Buka `http://localhost/mvc-native/public/index.php` (sesuaikan nama folder project).

## Struktur MVC
- `app/models/` : akses dan operasi data (`Film.php`).
- `app/controllers/` : alur request, validasi, dan pemanggilan Model/View (`FilmController.php`).
- `app/views/film/` : tampilan HTML (`index.php`, `create.php`, `edit.php`).
- `config/` : konfigurasi koneksi database PDO.
- `database/` : skema dan data awal SQL.
- `public/` : entry point (front controller + router) dan aset CSS.

## Entitas Film
| Atribut | Tipe | Keterangan |
|---|---|---|
| id | INT (PK, AI) | Primary key |
| judul | VARCHAR(150) | Wajib |
| sutradara | VARCHAR(100) | Wajib |
| genre | VARCHAR(50) | Wajib, dipilih dari daftar |
| tahun_rilis | SMALLINT | Wajib, 1888 - tahun ini + 5 |
| durasi | SMALLINT | Wajib, dalam menit |
| rating | DECIMAL(3,1) | Wajib, 0 - 10 |
| created_at | TIMESTAMP | Otomatis |

## Fitur
- Menampilkan data film
- Menambah data film
- Mengubah data film
- Menghapus data film (via POST + konfirmasi)
- Validasi input di sisi server dan pesan sukses/gagal

## Keamanan Dasar
- PDO dengan prepared statement pada semua query.
- `htmlspecialchars()` pada seluruh output dari pengguna.
- Aksi tambah, ubah, dan hapus hanya diterima lewat POST.

## Histori Git
Hasil `git log --oneline`:

```
9d67062 (HEAD -> main) fix: clearing all bugs on app
c82200f style: add basic interface styling
0fd6015 fix: clearing all typo in CRUD views
f473e12 fix: fixing typo in database config
e7b19ad feat: add complete CRUD routing
6c840bc feat: add complete film CRUD views
32e4d08 feat: add complete film CRUD controller with validation
e465317 fix: add missing PHP closing tag in database config
cbeea09 feat: add complete film CRUD model
89bad63 feat: add PDO database connection
a67102c feat: add film database schema and seed data
701a0cd chore: initialize mvc php natice project
```

Gunakan `git log --oneline --graph --decorate` untuk melihat tahapan pengembangan.
