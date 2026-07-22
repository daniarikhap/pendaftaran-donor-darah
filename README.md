# Panduan Instalasi Project - Pendaftaran Donor 

Dokumen ini berisi panduan langkah demi langkah untuk mengkloning dan menjalankan project **Pendaftaran Donor** di komputer Windows lain. Project ini dibangun menggunakan **Laravel** dan menggunakan **Laravel Sail (Docker)** sebagai lingkungan pengembangannya. 

---

## 📝 Deskripsi Aplikasi
Aplikasi **Pendaftaran Donor Darah** adalah sistem berbasis web yang dirancang untuk mempermudah proses pendaftaran, seleksi kelayakan, dan pengelolaan data pendonor darah. Aplikasi ini dilengkapi dengan integrasi database wilayah administratif Indonesia resmi dari Kemendagri untuk validasi alamat/NIK, serta sistem kuesioner dinamis untuk skrining awal kesehatan calon pendonor.

## ✨ Fitur Utama
1. **Pendaftaran Pendonor (Registrasi & Biodata)**:
   - Validasi data pendonor berdasarkan NIK.
   - Dropdown wilayah administratif Indonesia terintegrasi secara dinamis (Provinsi, Kabupaten, Kecamatan, Kelurahan).
2. **Pendaftaran Donor Darah & Skrining**:
   - Pengisian kuesioner kelayakan donor darah dinamis.
   - Pendaftaran antrean berdasarkan pemilihan ruangan/lokasi donor.
3. **Manajemen Admin (Back-Office)**:
   - Dashboard statistik real-time (total pendaftaran, donor berhasil, total pendonor, dll).
   - CRUD Manajemen Kuesioner Skrining.
   - CRUD Manajemen Ruang/Lokasi Donor.
   - CRUD Manajemen Jenis Pekerjaan Pendonor.
4. **Proses Seleksi & Riwayat**:
   - Pemeriksaan kelayakan medis pendonor oleh petugas (seleksi donor).
   - Pencatatan status donor (Donor Berhasil, Batal, dll).
   - Tracking riwayat donor pendonor.

---

## 🛠️ Persyaratan Sistem (Prerequisites) 

Sebelum memulai, pastikan komputer Windows tujuan sudah terinstal perangkat lunak berikut: 

1. **WSL 2 (Windows Subsystem for Linux)** 
   - Buka PowerShell sebagai Administrator dan jalankan perintah: 
     ```powershell
     wsl --install 
     ```
   - Restart komputer jika diminta. Pastikan Anda telah menginstal distribusi Linux (direkomendasikan **Ubuntu**) dari Microsoft Store.

2. **Docker Desktop untuk Windows**
   - Unduh dan instal [Docker Desktop](https://www.docker.com/products/docker-desktop/).
   - Saat instalasi, pastikan opsi **"Use the WSL 2 based engine"** dicentang.
   - Setelah terinstal, buka Docker Desktop, lalu masuk ke **Settings > Resources > WSL Integration**, aktifkan integrasi untuk distro Ubuntu Anda, lalu klik *Apply & Restart*.

3. **Git untuk Windows**
   - Unduh dan instal [Git for Windows](https://git-scm.com/).

---

## 🚀 Langkah-langkah Instalasi

Ikuti langkah-langkah di bawah ini di dalam terminal **WSL (Ubuntu)** untuk performa file yang maksimal (jangan gunakan folder `/mnt/c/...` karena akan sangat lambat).

### 1. Clone Repository
Buka terminal WSL Anda, masuk ke direktori home, lalu clone project ini:
```bash
cd ~
mkdir -p Development
cd Development
git clone <URL_REPOSITORY_ANDA>
cd pendaftaran-donor-darah
```

### 2. Duplikasi File `.env` 
Salin file konfigurasi environment dari template yang disediakan:
```bash
cp .env.example .env 
```
Secara default, konfigurasi database untuk Laravel Sail sudah terisi di dalam file `.env.example` dan siap digunakan dengan Docker. 

### 3. Install Dependensi Composer (Tanpa PHP Lokal) 
Karena Anda mungkin belum menginstal PHP dan Composer di mesin baru, gunakan container Docker sementara untuk menginstal dependensi project:
```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php84-composer:latest \
    composer install --ignore-platform-reqs
```

### 4. Jalankan Laravel Sail (Docker Containers)
Bangun image container terlebih dahulu lalu nyalakan semua service (Web server, MySQL, Redis, Meilisearch, dll) di latar belakang:
```bash
./vendor/bin/sail build
./vendor/bin/sail up -d
```
Untuk menghentikan service, Anda dapat menggunakan perintah:
```bash
./vendor/bin/sail down
```
> [!NOTE] 
> Proses pertama kali (first boot/build) mungkin memakan waktu beberapa menit karena Docker harus mengunduh dan membangun image yang dibutuhkan.

### 5. Generate Application Key
Generate key keamanan untuk aplikasi Laravel Anda:
```bash
./vendor/bin/sail artisan key:generate
```

### 6. Jalankan Migrasi Database
Jalankan migrasi untuk membuat tabel database beserta data awal (seeders):
```bash
./vendor/bin/sail artisan migrate:fresh --seed
```

### 7. Install & Jalankan Frontend Assets
Instal modul Node.js dan lakukan kompilasi asset frontend.

* **Mode Produksi (Rekomendasi agar tidak perlu menjalankan server dev secara terus-menerus):**
  ```bash
  ./vendor/bin/sail npm install
  ./vendor/bin/sail npm run build
  ```

* **Mode Pengembangan (Jika ingin kompilasi real-time / hot reload):**
  ```bash
  ./vendor/bin/sail npm install
  ./vendor/bin/sail npm run dev
  ```

---

## 🌐 Akses Aplikasi

Setelah semua langkah di atas selesai, Anda dapat mengakses layanan berikut melalui browser di Windows:

- **Aplikasi Utama:** [http://localhost](http://localhost)
- **Mailpit (Dashboard Email Testing):** [http://localhost:8025](http://localhost:8025)
- **Meilisearch (Mesin Pencarian):** [http://localhost:7700](http://localhost:7700)

---

## 💡 Perintah Bermanfaat (Cheat Sheet)

Untuk mempermudah penulisan perintah, Anda bisa membuat alias untuk Sail di terminal WSL Anda:
```bash
alias sail="./vendor/bin/sail"
```
Setelah membuat alias, Anda dapat menggunakan perintah di bawah ini:

* **Menyalakan Server:** `sail up -d`
* **Mematikan Server:** `sail down`
* **Menjalankan Artisan Perintah:** `sail artisan <command>` (Contoh: `sail artisan migrate`)
* **Menginstal package composer:** `sail composer require <package>`
* **Menjalankan test unit:** `sail test`

---

## ⚠️ Troubleshooting

1. **Error: `Ports are not available` (Port bentrok)**
   Jika Anda mendapatkan error port 80 atau 3306 sudah digunakan oleh aplikasi lain di Windows (seperti XAMPP, IIS, atau MySQL lokal):
   - Buka file `.env`.
   - Ubah port dengan menambahkan baris berikut di paling bawah file `.env`:
     ```env
     APP_PORT=8080
     FORWARD_DB_PORT=3307
     ```
   - Matikan dan nyalakan kembali Sail: `sail down && sail up -d`.
   - Sekarang web dapat diakses di `http://localhost:8080`.

2. **Docker Desktop belum berjalan**
   Pastikan aplikasi Docker Desktop di Windows sudah dibuka dan dalam status *Running* (berwarna hijau) sebelum menjalankan `./vendor/bin/sail up -d`.

3. **Error: `dial tcp: lookup ... no such host` (Masalah DNS di WSL2/Docker)**
   Jika Anda mendapatkan error saat mengunduh image (*pull access denied* atau *no such host*) yang menandakan WSL2 tidak terhubung ke internet:
   Jalankan perintah berikut di terminal WSL Anda untuk mengonfigurasi DNS Google secara manual:
   ```bash
   # Hapus file konfigurasi DNS lama yang bermasalah
   sudo rm -f /etc/resolv.conf

   # Buat file baru dengan DNS Google.
   echo "nameserver 8.8.8.8" | sudo tee /etc/resolv.conf
   ```

---

## 🗺️ Database Wilayah Indonesia (Kemendagri)

Aplikasi ini menggunakan database lokal untuk menyimpan seluruh wilayah administratif Indonesia (Provinsi, Kabupaten/Kota, Kecamatan, Kelurahan/Desa) untuk kebutuhan pencocokan NIK KTP dan dropdown wilayah pendaftaran donor.

* **Sumber Dataset**: Repositori GitHub [guzfirdaus/Wilayah-Administrasi-Indonesia](https://github.com/guzfirdaus/Wilayah-Administrasi-Indonesia) yang berbasis pada standar Keputusan Kemendagri resmi (kode wilayah 10 digit).
* **Lokasi Data Mentah (CSV)**: [database/data/](file:///home/mahrus/Development/pendaftaran-donor-darah/database/data/)
  * `provinces.csv` (Provinsi)
  * `regencies.csv` (Kabupaten/Kota)
  * `districts.csv` (Kecamatan)
  * `villages.csv` (Kelurahan/Desa)
* **Mekanisme Import**: Diimpor langsung ke database lokal menggunakan seeder [WilayahSeeder.php](file:///home/mahrus/Development/pendaftaran-donor-darah/database/seeders/WilayahSeeder.php) yang dijalankan saat `sail artisan migrate:fresh --seed`.
