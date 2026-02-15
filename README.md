# Yahya Book / Pena Langit Publishing

Sistem manajemen profil perusahaan dan penerbitan buku yang dibangun menggunakan Laravel. Aplikasi ini menyediakan fitur lengkap untuk mengelola konten website, galeri, artikel, layanan, dan toko buku.

## Fitur Utama

### 1. Dashboard Admin
Pusat kontrol untuk mengelola seluruh konten website dengan antarmuka yang mudah digunakan.

### 2. Manajemen Halaman Depan
Kelola tampilan utama website secara dinamis:
- **Branding**: Upload logo, favicon, dan pengaturan identitas visual.
- **Hero Section**: Atur banner utama, judul, dan deskripsi selamat datang.
- **Profil**: Kelola informasi visi, misi, dan profil perusahaan.
- **FAQ**: Tambah dan kelola daftar pertanyaan yang sering diajukan.
- **Footer**: Atur informasi kontak, link sosial media, dan copyright di bagian bawah website.

### 3. Manajemen Konten
Kelola berbagai jenis konten publik:
- **Ruang Tulisan**: Publikasikan artikel dan berita terkini.
- **Galeri**: Upload dokumentasi kegiatan dan event.
- **Karir**: Posting lowongan pekerjaan.
- **Layanan**: Informasikan paket dan layanan penerbitan.
- **Toko Buku**: Katalog buku terbitan Pena Langit.

### 4. Manajemen Kontak
- **Pengaturan Kontak**: Update alamat, nomor telepon/WhatsApp, email, dan link sosial media.
- **Pesan Masuk**: Pantau pesan yang dikirim pengunjung melalui formulir kontak.

---

## Panduan Instalasi di VPS Ubuntu (aaPanel)

Berikut adalah langkah-langkah untuk menginstal aplikasi ini di VPS Ubuntu yang menggunakan aaPanel.

### Persyaratan Sistem
- PHP >= 8.2
- Composer
- MySQL / MariaDB
- Nginx / Apache
- Git

### Langkah-langkah Instalasi

1. **Login ke aaPanel**
   - Masuk ke dashboard aaPanel Anda.
   - Pastikan PHP 8.2 atau lebih baru sudah terinstall di App Store.

2. **Buat Website Baru**
   - Pergi ke menu **Website** > **Add Site**.
   - Masukkan domain (misal: `yahya-buku.test` atau domain asli Anda).
   - Pilih versi PHP yang sesuai (PHP-82 atau PHP-83).
   - Buat database MySQL baru saat membuat website. Catat nama database, user, dan password.

3. **Masuk ke Terminal**
   - Buka menu **Terminal** di aaPanel atau SSH ke server Anda.
   - Masuk ke direktori root website Anda:
     ```bash
     cd /www/wwwroot/domain-anda.com
     ```
   - Hapus file default (jika ada):
     ```bash
     rm -rf ./*
     ```

4. **Clone Repository**
   - Clone project ini ke dalam folder tersebut:
     ```bash
     git clone https://github.com/username/repo-name.git .
     ```
     *(Ganti URL dengan repository git Anda)*

5. **Install Dependencies**
   - Jalankan perintah composer untuk menginstall library PHP:
     ```bash
     composer install --optimize-autoloader --no-dev
     ```

6. **Konfigurasi Environment (.env)**
   - Salin file contoh konfigurasi:
     ```bash
     cp .env.example .env
     ```
   - Edit file `.env`:
     ```bash
     nano .env
     ```
   - Sesuaikan konfigurasi database:
     ```
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=nama_database_anda
     DB_USERNAME=user_database_anda
     DB_PASSWORD=password_database_anda
     ```
   - Simpan dan keluar (Ctrl+X, Y, Enter).

7. **Generate Application Key**
   ```bash
   php artisan key:generate
   ```

8. **Setup Database & Storage**
   - Jalankan migrasi database dan seeder:
     ```bash
     php artisan migrate --seed --force
     ```
   - Buat symbolic link untuk storage:
     ```bash
     php artisan storage:link
     ```

9. **Set Permission**
   - Pastikan folder storage dan cache bisa ditulisi:
     ```bash
     chown -R www:www storage bootstrap/cache
     chmod -R 775 storage bootstrap/cache
     ```

10. **Konfigurasi Web Server (Nginx)**
    - Kembali ke menu **Website** di aaPanel.
    - Klik nama website Anda, lalu masuk ke tab **Site directory**.
    - Ubah **Running directory** menjadi `/public`.
    - Masuk ke tab **URL rewrite** dan pilih template **Laravel**, lalu Simpan.

11. **Selesai**
    - Buka domain Anda di browser.
    - Login ke dashboard admin dengan akun default (jika menggunakan seeder bawaan):
      - Email: `admin@penalangit.id`
      - Password: `password`

---

## Lisensi

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
