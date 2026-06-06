# The New Leaders — Website (2026)

Custom WordPress theme + bản demo tĩnh cho khách xem.

## Xem demo (GitHub Pages)
Link: https://<USER>.github.io/thenewleaders/  (cập nhật sau khi bật Pages)
- Trang chủ + 17 trang × 2 ngôn ngữ (EN/VI)
- Quiz EQ tương tác, mega-menu, đổi ngôn ngữ — chạy được trên bản tĩnh
- Lưu ý: bản tĩnh nên FORM không gửi email thật (chỉ hiện "cảm ơn"); để chạy đầy đủ cần hosting WordPress.

## Cấu trúc
- `theme/` — source code WordPress custom theme (PHP/CSS/JS/assets). Copy vào `wp-content/themes/` để chạy bản động.
- `docs/` — bản export tĩnh (GitHub Pages phục vụ từ thư mục này).

## Go-live (bản động đầy đủ)
1. Cài WordPress trên hosting, đặt permalink `/%year%/%monthnum%/%day%/%postname%/`, front page tĩnh.
2. Copy `theme/` vào `wp-content/themes/thenewleaders`, kích hoạt.
3. Tạo các page: contact, newsletter, careers, our-services(+4 con), products(+3 con), resources, events, eq-quiz, eq-with-ngan-tran.
4. Cấu hình SMTP để form gửi mail; trỏ domain.

Digito Combat — 2026.
