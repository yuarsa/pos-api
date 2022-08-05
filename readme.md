# POS API dengan Lumen PHP Framework

### Setup
Silakan clone repository ke local machine anda masing-masing

```
git clone https://gitlab.com/yuarsa/pos-api.git
```
Setelah selesai install dependency yang dibutuhkan menggunakan perintah di bawah ini

```
composer update --prefer-dist -vvv --profile
```

Copy file .env.example ke file .env lalu generate random key dengan menggunakan tinker

```
php artisan tinker
str_random(32)
copy random key ke file .env
```

Migrasi database dengan perintah berikut

```
php artisan migrate
```

Untuk menjalankan lumen:

```
php -S localhost -t public
atau
menggunakan xampp masing-masing jika menggunakan windows
```

### Development
DILARANG LANGSUNG DEVELOPMENT DI BRANCH MASTER

Agar branch master tetap bersih dan tidak ternoda, maka development dilakukan menggunakan branch masing-masing

Untuk melakukan development di local machine, buat branch git terlebih dahulu lalu checkout

```
git checkout -b namabranch
Contoh: git checkout -b eko
```

Untuk melihat anda sudah berada di branch yang anda buat tadi dapat dengan perintah berikut ini:

```
git branch
```

Mulailah development

Apabila mau push ke server (Gitlab), ikutin langkah di bawah ini:

```
git add .
git commit -m "isi pesan dari yang anda development(Bebas bro)"
git push -u origin namabranch
Contoh: git push -u origin eko
```

### Merge Request
Apabila dirasa sudah fix hasil dari development nya dan siap untuk di merge, maka gunakan fasilitas Merge Request yang ada di Gitlab, atau bisa hubungin Mimin.
