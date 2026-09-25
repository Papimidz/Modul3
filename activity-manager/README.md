# Activity Manager v1

Activity Manager v1 merupakan aplikasi manajemen kegiatan yang dibuat menggunakan Laravel 13 sebagai bagian dari Project 3 Modul 3.

Aplikasi ini digunakan untuk mempelajari request lifecycle Laravel, routing, controller, Blade, Eloquent ORM, migration, validation menggunakan Form Request, route model binding, business logic menggunakan service class, serta clean code.

## Teknologi

Project ini menggunakan:

- PHP 8.5.0
- Composer 2.8.12
- Laravel Framework 13.32.0
- SQLite
- Laravel Blade
- Laravel Pint
- SonarScanner CLI

## Fitur

Fitur yang tersedia pada Activity Manager v1:

- Menampilkan daftar kegiatan
- Menampilkan detail kegiatan
- Menambahkan kegiatan
- Mengubah kegiatan
- Menghapus kegiatan
- Validasi input menggunakan Form Request
- Route Model Binding
- Filter kegiatan berdasarkan status
- Business rule transisi status menggunakan ActivityService
- Flash message setelah proses berhasil
- Penanganan validation error
- Static analysis configuration menggunakan SonarQube

## Data Kegiatan

Setiap kegiatan memiliki field:

- Title
- Description
- Activity Date
- Category
- Status

Status kegiatan terdiri dari:

- Planned
- Ongoing
- Done

## Business Rules

### Validasi Input

- Judul wajib diisi.
- Judul memiliki panjang minimal 5 karakter dan maksimal 100 karakter.
- Tanggal kegiatan wajib berupa tanggal yang valid.
- Status hanya dapat berupa Planned, Ongoing, atau Done.

### Transisi Status

Perubahan status hanya dapat bergerak maju:

```text
Planned → Ongoing → Done