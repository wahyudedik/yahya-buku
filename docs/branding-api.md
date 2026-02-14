# Branding API

## GET /admin/branding
- Auth: required
- Deskripsi: Menampilkan halaman pengaturan branding (logo & favicon).
- Response: HTML form dengan status konfigurasi saat ini.

## POST /admin/branding
- Auth: required
- Deskripsi: Menyimpan perubahan branding.
- Body (multipart/form-data):
  - logo: file (PNG/JPG/SVG), maks 2MB. Opsional.
  - favicon: file (ICO/PNG/SVG), opsional. PNG wajib persegi dan berukuran 16, 32, atau 48 px.
  - logo_width: number (px), opsional.
  - logo_height: number (px), opsional.
  - logo_position: enum left|center|right, wajib.
  - favicon_enabled: boolean (1/0), opsional, default true.
- Efek:
  - Backup otomatis file lama ke storage/app/public/branding/backups/TIMESTAMP/.
  - Sanitasi konten SVG.
  - Penyimpanan metadata updated_by, timestamps, dan cache_bust_token.
- Response:
  - Redirect 302 ke /admin/branding dengan flash session `status`.

## POST /admin/branding/reset
- Auth: required
- Deskripsi: Mengembalikan pengaturan branding ke nilai default (tanpa logo/fav, posisi left).
- Response:
  - Redirect 302 ke /admin/branding dengan flash session `status`.

## Status Konfigurasi
Nilai aktif dapat diambil dari model `App\Models\BrandingSetting::first()`:
- logo_path, logo_width, logo_height, logo_position
- favicon_path, favicon_enabled
- cache_bust_token, updated_by, updated_at

## Catatan Keamanan
- Validasi mimetype file dan batas ukuran diterapkan.
- SVG dibersihkan dari `<script>` dan atribut `on*`.
- File tersimpan pada disk `public` di `branding/`.

