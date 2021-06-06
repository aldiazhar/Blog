### Simple Blog

## Systems Requirements

Systems Anda harus memenuhi kriteria ini:
- PHP 7
- Laravel 7
- Mysql
- Composer
- Node Js

## Cara Install di Localhost

- Download ZIP/RAR project ini
- Extract file yang telah Anda unduh
- Letakan file zip yang telah di extract di folder kerja anda.
- Buat database di MySQL/PHPMyAdmin Anda
- Masuk ke step **Konfigurasi File .env**
- Kemudian ketikan perintah **php artisan migrate**
- Setelah itu ketikan perintah **php artisan db:seed**
- Setelah itu ketikan perintah **php artisan storage:link**
- Dan terakhir keitkan perintah **php artisan serve** untuk menjalankan web apps. Buka browser dan masuk ke url http://localhost:8000
- Masuk ke step **Akses**

## Konfigurasi file .env

Selanjutnya lakukan konfigurasi file .env Anda sesuai dengan data website dan koneksi databasenya.
- Setting DB_DATABASE=namadatabase
- Setting DB_USERNAME=usernamedatabase
- Setting DB_PASSWORD=passworddatabase
- Simpan kembali file .env

## Akses

Untuk mengakses halaman admin anda bisa menggunakan akun (email dan password) dibawah ini:
- E-Mail: gold@roger.com
- Password: Secret

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
