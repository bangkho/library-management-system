## Library Management System - Ahmad Khoirudin - 2301973273

Menggunakan Laravel 10 dan ReactJS, dengan database PostgreSQL 15.3

Cara instalasi dan run
- clone repo ini / download zip source code
- lakukan composer install dan npm install
- run database PostgreSQL 15.3 dengan nama database `db_library`
- .env file sudah tersedia dan kredensial database sudah diisi, dapat dilihat di .env
- jalankan `php artisan migrate` untuk migrasi database
- jalankan `php artisan serve` untuk menjalankan aplikasi
- jalankan `npm run dev` untuk menjalankan reactjs

Aplikasi berjalan pada port 8000, dapat diakses melalui browser dengan url `http://localhost:8000`

Backend API dapat diakses melalui url `http://localhost:8000/api/` dengan method GET, POST, PUT, DELETE
List API ada di file `routes/api.php`

Frontend ReactJS dapat diakses melalui url `http://localhost:8000/`
data dari aplikasi belum terseeding dapat menggunakan sql backup yang ada di folder `database/dump-db_library-202308160503.tar`

Akses DB menggunakan DBeaver 23.1.4