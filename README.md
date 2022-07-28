# Orenda Preliminary Test
Repo untuk hasil pengerjaan task premilinary test dari Orenda.
## Requirement
 - Web Server
 - Database PostgreSQL
 - PHP > 8
## Cara Install 
 1. Jalankan perintah "git clone https://github.com/idnorman/orenda-test.git"
 2. Ubah nama file "**.env.example"** menjadi "**.env**"
 3. Buat database dengan nama "**orenda_test**" atau konfigurasi **DB_DATABASE** di "**.env**"
 4. Jalankan perintah "`composer install`"
 5. Jalankan perintah "`php artisan key:generate`"
 6. Lakukan migrasi dengan "`php artisan migrate`"
 7. Jalankan code dengan "`php artisan serve`"

## Dokumentasi API

 - Membuat Users (Register/Create)
	 Untuk membuat users dapat mengakses url dengan method:
     
	 `POST` : http://url.domain/api/register
     
	 Contoh request:
>      {
>     	 "Users": [
>             "example1@mail.com",
>             "example2@mail.com"
>           ]
>      }

 - Menambahkan item ke koli
     Untuk menambah item ke koli dapat mengakses url dengan method:
     
      `POST` : http://url.domain/api/putin
	 
     Contoh request:

>      {
>         "user": "example@mail.com",
>         "koli": "Cat",
>         "item": [
>                     { 
>                         "name": "Cat Minyak",
>                         "qty": "3 Kaleng"
>                     },
>                     {
>                         "name": "Cat Air",
>                         "qty": "2 Kaleng" 
>                     }
>                 ]
>      }

 - Mengurangi/menghapus item dari koli
     Untuk mengurangi/menghapus item ke koli dapat mengakses url dengan method:
     
     `POST` : http://url.domain/api/takeout
	 
     Contoh request:

>      {
>         "user": "example@mail.com",
>         "koli": "Cat",
>         "item": [
>                     { 
>                         "name": "Cat Minyak",
>                         "qty": "3 Kaleng"
>                     },
>                     {
>                         "name": "Cat Air",
>                         "qty": "2 Kaleng" 
>                     }
>                 ]
>      }

 - Mengambil koli yang sama dari dua users berbeda
     Untuk mengambil koli yang sama dari dua users berbeda dapat mengakses url dengan method:
     
      `GET` : http://url.domain/api/koli/common
	 
	 
| Parameter | Jenis |	Deskripsi |
|--|--|--|
| user | array |	(wajib) array berisi email user yang telah terdaftar	|

Contoh URL dengan parameter:

    http://url.domain/api/koli/common/?user=["example1@mail.com","example2@mail.com"]

>      {
>     	 "user":  ["example1@mail.com", "example2@mail.com"]
>      }
