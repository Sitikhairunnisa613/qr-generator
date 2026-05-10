# QR Generator & Payment System

## Deskripsi
Project ini adalah aplikasi QR Generator berbasis Laravel dan Vue.js.  
Aplikasi dapat digunakan untuk membuat QR Code dalam beberapa jenis, seperti:

- Text biasa
- URL / Link
- WhatsApp
- Instagram
- Payment QR

Selain membuat QR Code, aplikasi juga memiliki fitur payment sederhana tanpa menggunakan API pihak ketiga.

---

## Fitur

### QR Generator
- Generate QR Text
- Generate QR URL
- Generate QR WhatsApp
- Generate QR Instagram

### Payment QR
- Membuat QR pembayaran
- Menampilkan detail pembayaran
- Status pembayaran:
  - PENDING
  - PAID

### Tampilan
- Desain soft pink
- Responsive
- Interface sederhana dan mudah digunakan

## Teknologi yang Digunakan

### Frontend
- Vue.js
- JavaScript
- HTML
- CSS

### Backend
- Laravel
- PHP

### Database
- MySQL

### Library
- simplesoftwareio/simple-qrcode


## Cara Menjalankan Project

### 1. Clone / Copy Project
Simpan project ke folder:

C:\xampp\htdocs\qr_code

### 2. Install Dependency Laravel
composer install

### 3. Install Dependency Vue
npm install

### 4. Buat Database
Buat database baru di phpMyAdmin dengan nama:
qr_code

### 5. Konfigurasi .env
Atur bagian database:
DB_DATABASE=qr_code
DB_USERNAME=root
DB_PASSWORD=

### 6. Jalankan Migration
php artisan migrate

### 7. Jalankan Laravel
php artisan serve --host=0.0.0.0 --port=8000

### 8. Jalankan Vue / Vite
npm run dev
