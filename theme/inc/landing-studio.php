<?php
/**
 * LANDING STUDIO - The New Leaders
 * Trinh tao landing page keo-tha don gian cho nguoi khong chuyen:
 *  - Chon mau khoi dau (5 preset) hoac trang trong.
 *  - Danh sach section ben trai: keo doi thu tu, them/xoa/nhan ban.
 *  - Bam section -> form o chu / o anh don gian (khong block editor).
 *  - Xem truoc trang that trong iframe, bam Luu la cap nhat.
 * Khong plugin ngoai. Noi dung compose tu cac section builder co san
 * (inc/landing-templates.php) -> render front-end y het trang MAU.
 */

if (!defined('ABSPATH')) exit;

/* Title tag: dung gach ngang thuong "-" thay cho en/em dash (rule typography toan du an).
 * wptexturize doi " - " thanh entity &#8211; SAU khi build title -> phai ep lai o priority 20. */
add_filter('document_title', function ($t) {
    return is_string($t) ? str_replace(
        array('—', '–', '&#8212;', '&#8211;', '&#x2014;', '&#x2013;', '&mdash;', '&ndash;'), '-', $t) : $t;
}, 20);

/* ============================================================
 * 1. SCHEMA - dinh nghia section + field cho UI form
 *    type field: text | textarea | image | select | check
 * ============================================================ */
function tnl_studio_schema() {
    $colors = array('cyan' => 'Xanh dương', 'green' => 'Xanh lá', 'yellow' => 'Vàng', 'orange' => 'Cam');
    return array(
        'hero' => array(
            'label' => 'Hero - Ảnh nền + overlay cam', 'group' => 'Mở đầu',
            'fields' => array(
                'title' => array('text', 'Tiêu đề chính', 'Tiêu đề chính của bạn'),
                'sub'   => array('textarea', 'Mô tả ngắn', 'Một câu mô tả ngắn gọn, hấp dẫn.'),
                'btn'   => array('text', 'Chữ trên nút', 'Liên hệ ngay'),
                'img'   => array('image', 'Ảnh nền', ''),
            ),
        ),
        'herodark' => array(
            'label' => 'Hero - Nền tối + đếm ngược', 'group' => 'Mở đầu',
            'fields' => array(
                'badge' => array('text', 'Nhãn nổi bật', 'ƯU ĐÃI CÓ HẠN'),
                'title' => array('text', 'Tiêu đề chính', 'Tiêu đề sự kiện / ưu đãi'),
                'sub'   => array('textarea', 'Mô tả ngắn', 'Mô tả ngắn tạo cảm giác cấp bách.'),
                'btn'   => array('text', 'Chữ trên nút', 'Nhận ưu đãi ngay'),
                'date'  => array('text', 'Đếm ngược đến (VD: 2026-12-31 20:00)', '2026-12-31 20:00'),
            ),
        ),
        'intro' => array(
            'label' => 'Tiêu đề nền màu + đoạn văn', 'group' => 'Nội dung',
            'fields' => array(
                'color' => array('select', 'Màu nền tiêu đề', 'cyan', $colors),
                'title' => array('text', 'Tiêu đề', 'Tiêu đề mục'),
                'body'  => array('textarea', 'Đoạn văn', 'Đoạn giới thiệu nội dung mục này. Viết 2-3 câu tự nhiên.'),
                'gray'  => array('check', 'Nền xám cho cả khối', ''),
            ),
        ),
        'panel' => array(
            'label' => 'Khối màu + ảnh (nửa-nửa)', 'group' => 'Nội dung',
            'fields' => array(
                'color' => array('select', 'Màu khối', 'cyan', $colors),
                'title' => array('text', 'Tiêu đề khối', 'Tiêu đề khối'),
                'body'  => array('textarea', 'Mô tả', 'Mô tả ngắn nội dung khối này.'),
                'btn'   => array('text', 'Chữ trên nút', 'Tìm hiểu thêm'),
                'rev'   => array('check', 'Đảo bên (ảnh trái - chữ phải)', ''),
                'img'   => array('image', 'Ảnh', ''),
            ),
        ),
        'feat' => array(
            'label' => 'Ảnh + chữ (đơn giản)', 'group' => 'Nội dung',
            'fields' => array(
                'kicker' => array('text', 'Nhãn nhỏ phía trên', 'NHÃN NHỎ'),
                'title'  => array('text', 'Tiêu đề', 'Tiêu đề mục'),
                'body'   => array('textarea', 'Đoạn văn', 'Mô tả nội dung mục này, 2-3 câu.'),
                'rev'    => array('check', 'Đảo bên', ''),
                'img'    => array('image', 'Ảnh', ''),
            ),
        ),
        'cards3' => array(
            'label' => 'Bộ thẻ icon + mô tả', 'group' => 'Nội dung',
            'fields' => array('title' => array('text', 'Tiêu đề mục', 'Tiêu đề mục')),
            'items'  => array(
                'label'  => 'Thẻ',
                'fields' => array(
                    'ico'   => array('text', 'Icon (emoji)', '⭐'),
                    'title' => array('text', 'Tiêu đề thẻ', 'Tiêu đề thẻ'),
                    'desc'  => array('textarea', 'Mô tả', 'Mô tả ngắn.'),
                ),
                'default' => 3,
            ),
        ),
        'prog' => array(
            'label' => 'Lưới thẻ (chương trình / tính năng)', 'group' => 'Nội dung',
            'fields' => array(
                'kicker' => array('text', 'Nhãn nhỏ', 'NHÃN'),
                'title'  => array('text', 'Tiêu đề mục', 'Tiêu đề lưới'),
            ),
            'items' => array(
                'label'  => 'Thẻ',
                'fields' => array(
                    'title' => array('text', 'Tiêu đề thẻ', 'Tên mục'),
                    'desc'  => array('textarea', 'Mô tả', 'Mô tả ngắn.'),
                ),
                'default' => 4,
            ),
        ),
        'cred' => array(
            'label' => 'Con số uy tín (nền tối)', 'group' => 'Nội dung',
            'fields' => array('title' => array('text', 'Tiêu đề mục', 'Dựa trên nền tảng vững chắc')),
            'items'  => array(
                'label'  => 'Con số',
                'fields' => array(
                    'num'   => array('text', 'Con số', '20+'),
                    'label' => array('text', 'Chú thích', 'Năm kinh nghiệm'),
                ),
                'default' => 3,
            ),
        ),
        'reports' => array(
            'label' => 'Thẻ báo cáo (tag + tiêu đề)', 'group' => 'Nội dung',
            'fields' => array(
                'kicker' => array('text', 'Nhãn nhỏ', 'NHÃN'),
                'title'  => array('text', 'Tiêu đề mục', 'Các loại báo cáo'),
            ),
            'items' => array(
                'label'  => 'Thẻ',
                'fields' => array(
                    'tag'   => array('text', 'Tag', 'Cá nhân'),
                    'title' => array('text', 'Tiêu đề thẻ', 'Báo cáo cá nhân'),
                    'desc'  => array('textarea', 'Mô tả', 'Mô tả ngắn.'),
                ),
                'default' => 3,
            ),
        ),
        'steps' => array(
            'label' => 'Các bước / quy trình', 'group' => 'Nội dung',
            'fields' => array(
                'color' => array('select', 'Màu nền tiêu đề', 'cyan', $colors),
                'title' => array('text', 'Tiêu đề mục', 'Quy trình 3 bước'),
            ),
            'items' => array(
                'label'  => 'Bước',
                'fields' => array(
                    'title' => array('text', 'Tên bước', 'Bước'),
                    'desc'  => array('textarea', 'Mô tả', 'Mô tả ngắn bước này.'),
                ),
                'default' => 3,
            ),
        ),
        'pricing' => array(
            'label' => 'Thẻ giá / ưu đãi', 'group' => 'Bán hàng',
            'fields' => array(
                'title' => array('text', 'Tiêu đề mục', 'Ưu đãi của bạn'),
                'old'   => array('text', 'Giá gốc (gạch ngang)', '2.000.000đ'),
                'now'   => array('text', 'Giá ưu đãi', '1.200.000đ'),
                'save'  => array('text', 'Nhãn tiết kiệm', 'Tiết kiệm 40%'),
                'note'  => array('text', 'Ghi chú dưới nút', 'Số lượng có hạn.'),
                'btn'   => array('text', 'Chữ trên nút', 'Đăng ký ngay'),
            ),
            'items' => array(
                'label'  => 'Quyền lợi',
                'fields' => array('text' => array('text', 'Nội dung quyền lợi', 'Quyền lợi đi kèm')),
                'default' => 3,
            ),
        ),
        'bigtesti' => array(
            'label' => 'Đánh giá - kiểu lớn (ảnh tròn)', 'group' => 'Uy tín',
            'fields' => array('title' => array('text', 'Tiêu đề mục', 'Cảm nhận của học viên')),
            'items'  => array(
                'label'  => 'Đánh giá',
                'fields' => array(
                    'quote' => array('textarea', 'Câu đánh giá', 'Chương trình thực sự đáng giá.'),
                    'name'  => array('text', 'Tên người', 'Tên khách hàng'),
                    'role'  => array('text', 'Chức danh - Công ty', 'Chức danh - Công ty'),
                    'img'   => array('image', 'Ảnh chân dung', ''),
                ),
                'default' => 3,
            ),
        ),
        'testi3' => array(
            'label' => 'Đánh giá - 3 thẻ nhỏ', 'group' => 'Uy tín',
            'fields' => array('title' => array('text', 'Tiêu đề mục', 'Cảm nhận khách hàng')),
            'items'  => array(
                'label'  => 'Đánh giá',
                'fields' => array(
                    'quote' => array('textarea', 'Câu đánh giá', 'Nội dung sâu sắc, giảng viên tận tâm.'),
                    'name'  => array('text', 'Tên người', 'Tên khách hàng'),
                    'role'  => array('text', 'Chức danh - Công ty', 'Chức danh - Công ty'),
                    'img'   => array('image', 'Ảnh chân dung', ''),
                ),
                'default' => 3,
            ),
        ),
        'quote' => array(
            'label' => 'Trích dẫn nổi bật', 'group' => 'Uy tín',
            'fields' => array(
                'q'  => array('textarea', 'Câu trích dẫn', 'Một câu trích dẫn ấn tượng đặt tại đây.'),
                'by' => array('text', 'Người nói', 'Tên người - Chức danh'),
            ),
        ),
        'video' => array(
            'label' => 'Video YouTube', 'group' => 'Nội dung',
            'fields' => array(
                'color' => array('select', 'Màu nền tiêu đề', 'orange', $colors),
                'title' => array('text', 'Tiêu đề mục', 'Xem video giới thiệu'),
                'url'   => array('text', 'Link YouTube', 'https://www.youtube.com/watch?v='),
            ),
        ),
        'twocol' => array(
            'label' => '2 cột nội dung', 'group' => 'Nội dung',
            'fields' => array(
                'color' => array('select', 'Màu nền tiêu đề', 'green', $colors),
                'title' => array('text', 'Tiêu đề mục', 'Tiêu đề mục'),
                'left'  => array('textarea', 'Nội dung cột trái', 'Nội dung cột trái.'),
                'right' => array('textarea', 'Nội dung cột phải', 'Nội dung cột phải.'),
            ),
        ),
        'faq' => array(
            'label' => 'Câu hỏi thường gặp (FAQ)', 'group' => 'Nội dung',
            'fields' => array(
                'color' => array('select', 'Màu nền tiêu đề', 'yellow', $colors),
                'title' => array('text', 'Tiêu đề mục', 'Câu hỏi thường gặp'),
            ),
            'items' => array(
                'label'  => 'Câu hỏi',
                'fields' => array(
                    'q' => array('text', 'Câu hỏi', 'Câu hỏi?'),
                    'a' => array('textarea', 'Câu trả lời', 'Câu trả lời.'),
                ),
                'default' => 3,
            ),
        ),
        'infocards' => array(
            'label' => 'Thẻ thông tin sự kiện (ngày/giờ/nơi)', 'group' => 'Sự kiện',
            'fields' => array(
                'color' => array('select', 'Màu nền tiêu đề', 'yellow', $colors),
                'title' => array('text', 'Tiêu đề mục', 'Thông tin sự kiện'),
            ),
            'items' => array(
                'label'  => 'Thẻ',
                'fields' => array(
                    'ico'   => array('text', 'Icon (emoji)', '📅'),
                    'label' => array('text', 'Nhãn', 'Ngày'),
                    'value' => array('text', 'Giá trị', '20/08/2026'),
                ),
                'default' => 4,
            ),
        ),
        'countdown' => array(
            'label' => 'Đồng hồ đếm ngược', 'group' => 'Sự kiện',
            'fields' => array(
                'date'  => array('text', 'Đếm ngược đến (VD: 2026-12-31 20:00)', '2026-12-31 20:00'),
                'label' => array('text', 'Nhãn phía trên', 'Bắt đầu sau'),
            ),
        ),
        'regform' => array(
            'label' => 'Form đăng ký (thu lead)', 'group' => 'Sự kiện',
            'fields' => array(
                'title' => array('text', 'Tiêu đề mục', 'Đăng ký tham dự'),
                'sub'   => array('text', 'Mô tả dưới tiêu đề', 'Điền thông tin để giữ chỗ. Ban tổ chức sẽ liên hệ xác nhận.'),
                'btn'   => array('text', 'Chữ trên nút', 'Đăng ký ngay'),
            ),
        ),
        'band' => array(
            'label' => 'Dải kêu gọi hành động', 'group' => 'Kết trang',
            'fields' => array(
                'dark'  => array('check', 'Nền tối', '1'),
                'title' => array('text', 'Tiêu đề', 'Tiêu đề kêu gọi hành động'),
                'sub'   => array('text', 'Câu thuyết phục', 'Một câu thuyết phục ngắn.'),
                'btn'   => array('text', 'Chữ trên nút', 'Nút hành động'),
            ),
        ),
        'contact' => array(
            'label' => 'Dải liên hệ (nền cam)', 'group' => 'Kết trang',
            'fields' => array(
                'title' => array('text', 'Tiêu đề', 'Liên hệ với chúng tôi'),
                'sub'   => array('textarea', 'Mô tả', 'Để lại thông tin hoặc liên hệ trực tiếp - The New Leaders sẽ đồng hành cùng bạn.'),
            ),
        ),
        'team' => array(
            'label' => 'Đội ngũ / giảng viên (ảnh tròn)', 'group' => 'Uy tín',
            'fields' => array(
                'color' => array('select', 'Màu nền tiêu đề', 'cyan', $colors),
                'title' => array('text', 'Tiêu đề mục', 'Đội ngũ của chúng tôi'),
            ),
            'items' => array(
                'label'  => 'Thành viên',
                'fields' => array(
                    'name' => array('text', 'Họ tên', 'Họ và tên'),
                    'role' => array('text', 'Chức danh', 'Chức danh'),
                    'img'  => array('image', 'Ảnh chân dung', ''),
                ),
                'default' => 3,
            ),
        ),
        'logos' => array(
            'label' => 'Dải logo đối tác / khách hàng', 'group' => 'Uy tín',
            'fields' => array('title' => array('text', 'Tiêu đề nhỏ', 'ĐỐI TÁC CỦA CHÚNG TÔI')),
            'items'  => array(
                'label'  => 'Logo',
                'fields' => array('img' => array('image', 'Ảnh logo', '')),
                'default' => 5,
            ),
        ),
        'timeline' => array(
            'label' => 'Lộ trình / dòng thời gian', 'group' => 'Nội dung',
            'fields' => array(
                'color' => array('select', 'Màu nền tiêu đề', 'orange', $colors),
                'title' => array('text', 'Tiêu đề mục', 'Lộ trình của bạn'),
            ),
            'items' => array(
                'label'  => 'Mốc',
                'fields' => array(
                    'time'  => array('text', 'Nhãn thời gian / bước', 'Bước 1'),
                    'title' => array('text', 'Tiêu đề mốc', 'Tên mốc'),
                    'desc'  => array('textarea', 'Mô tả', 'Mô tả ngắn mốc này.'),
                ),
                'default' => 3,
            ),
        ),
        'checklist' => array(
            'label' => 'Ảnh + danh sách ưu điểm (tick)', 'group' => 'Nội dung',
            'fields' => array(
                'color' => array('select', 'Màu nền tiêu đề', 'green', $colors),
                'title' => array('text', 'Tiêu đề', 'Vì sao chọn chúng tôi'),
                'rev'   => array('check', 'Đảo bên (ảnh phải - chữ trái)', ''),
                'img'   => array('image', 'Ảnh', ''),
            ),
            'items' => array(
                'label'  => 'Ý',
                'fields' => array('text' => array('text', 'Nội dung ý', 'Một ưu điểm ngắn gọn')),
                'default' => 4,
            ),
        ),
        'gallery' => array(
            'label' => 'Lưới ảnh (gallery)', 'group' => 'Nội dung',
            'fields' => array(
                'color' => array('select', 'Màu nền tiêu đề', 'yellow', $colors),
                'title' => array('text', 'Tiêu đề mục', 'Hình ảnh hoạt động'),
            ),
            'items' => array(
                'label'  => 'Ảnh',
                'fields' => array('img' => array('image', 'Ảnh', '')),
                'default' => 4,
            ),
        ),
        'compare' => array(
            'label' => 'Bảng so sánh gói', 'group' => 'Bán hàng',
            'fields' => array('title' => array('text', 'Tiêu đề mục', 'Chọn gói phù hợp với bạn')),
            'items'  => array(
                'label'  => 'Gói',
                'fields' => array(
                    'name'  => array('text', 'Tên gói', 'Gói Cơ bản'),
                    'price' => array('text', 'Giá', '1.200.000đ'),
                    'feat'  => array('textarea', 'Quyền lợi (mỗi dòng 1 ý)', "Quyền lợi 1\nQuyền lợi 2\nQuyền lợi 3"),
                    'hl'    => array('check', 'Làm nổi bật gói này', ''),
                ),
                'default' => 2,
            ),
        ),
        'map' => array(
            'label' => 'Bản đồ / địa điểm', 'group' => 'Sự kiện',
            'fields' => array(
                'title'   => array('text', 'Tiêu đề mục', 'Địa điểm tổ chức'),
                'address' => array('text', 'Địa chỉ hiển thị', 'Số nhà, đường, quận, thành phố'),
                'embed'   => array('text', 'Link nhúng Google Maps (tuỳ chọn)', ''),
            ),
        ),
        'richtext' => array(
            'label' => 'Đoạn văn tự do (linh hoạt)', 'group' => 'Nội dung',
            'fields' => array(
                'title' => array('text', 'Tiêu đề (để trống nếu không cần)', ''),
                'body'  => array('textarea', 'Nội dung (mỗi dòng là 1 đoạn)', 'Viết nội dung tự do ở đây - mỗi dòng xuống hàng sẽ thành 1 đoạn văn riêng.'),
                'gray'  => array('check', 'Nền xám', ''),
            ),
        ),
        'spacer' => array(
            'label' => 'Khoảng cách / đường kẻ', 'group' => 'Bố cục',
            'fields' => array(
                'size' => array('select', 'Độ cao', 'md', array('sm' => 'Nhỏ', 'md' => 'Vừa', 'lg' => 'Lớn')),
                'line' => array('check', 'Có đường kẻ ngăn cách', ''),
            ),
        ),
        'contact_hero' => array(
            'label' => 'Khối gốc: Tiêu đề "Kết nối với..." (giữ nguyên thiết kế)', 'group' => 'Khối gốc - Contact',
            'fields' => array(
                'w1' => array('text', 'Từ 1', 'Kết '), 'c1' => array('select', 'Màu từ 1', 'cyan', $colors),
                'w2' => array('text', 'Từ 2', 'nối '), 'c2' => array('select', 'Màu từ 2', 'green', $colors),
                'w3' => array('text', 'Từ 3', 'với'), 'c3' => array('select', 'Màu từ 3', 'yellow', $colors),
                'brand' => array('text', 'Dòng chữ dưới', 'The New Leaders'),
            ),
        ),
        'contact_form' => array(
            'label' => 'Khối gốc: Form liên hệ 6 trường (giữ nguyên thiết kế)', 'group' => 'Khối gốc - Contact',
            'fields' => array(),
        ),
    );
}

/* ============================================================
 * 1b. HINTS - goi y kich thuoc anh / so ky tu cho tung o nhap
 *     Cau truc: type => { field|items.field => [hint, max_ky_tu] }
 * ============================================================ */
function tnl_studio_hints() {
    $img_wide     = array('Ảnh ngang 1920×1080px (JPG, dưới 500KB) - vùng giữa ảnh sẽ được ưu tiên hiển thị', 0);
    $img_43       = array('Ảnh 1200×900px (tỷ lệ 4:3), rõ chủ thể - hiển thị dạng khối vuông bo góc', 0);
    $img_portrait = array('Ảnh chân dung vuông 400×400px, mặt ở giữa - hiển thị bo tròn', 0);
    return array(
        'hero' => array(
            'title' => array('Nêu lợi ích chính, ngắn gọn. VD: "Nâng tầm kỹ năng lãnh đạo bằng EQ"', 70),
            'sub'   => array('1-2 câu bổ nghĩa cho tiêu đề', 160),
            'btn'   => array('Động từ hành động. VD: "Đăng ký ngay"', 25),
            'img'   => $img_wide,
        ),
        'herodark' => array(
            'badge' => array('VIẾT HOA, tạo chú ý. VD: "ƯU ĐÃI CÓ HẠN"', 25),
            'title' => array('Tên ưu đãi / sự kiện', 70),
            'sub'   => array('Nêu giá trị + tính cấp bách', 160),
            'btn'   => array('VD: "Nhận ưu đãi ngay"', 25),
            'date'  => array('Định dạng Năm-Tháng-Ngày Giờ:Phút, VD 2026-12-31 20:00', 20),
        ),
        'intro' => array(
            'title' => array('Tiêu đề mục, ngắn gọn', 50),
            'body'  => array('2-3 câu giới thiệu, viết tự nhiên', 320),
        ),
        'panel' => array(
            'title' => array('Tên lợi ích / học phần / diễn giả', 50),
            'body'  => array('2-3 câu mô tả', 220),
            'btn'   => array('VD: "Tìm hiểu thêm"', 25),
            'img'   => $img_43,
        ),
        'feat' => array(
            'kicker' => array('Nhãn nhỏ VIẾT HOA phía trên tiêu đề', 30),
            'title'  => array('Tiêu đề mục', 60),
            'body'   => array('2-3 câu mô tả', 300),
            'img'    => array('Ảnh ngang 1200×800px', 0),
        ),
        'cards3' => array(
            'title'       => array('Tiêu đề chung của bộ thẻ', 60),
            'items.ico'   => array('1 emoji. VD: ⭐ 💡 🎯 📈 🤝', 4),
            'items.title' => array('Tên thẻ, 2-5 từ', 40),
            'items.desc'  => array('1-2 câu mô tả', 140),
        ),
        'prog' => array(
            'kicker'      => array('Nhãn nhỏ VIẾT HOA', 30),
            'title'       => array('Tiêu đề mục', 60),
            'items.title' => array('Tên mục, 2-6 từ', 50),
            'items.desc'  => array('1-2 câu mô tả', 140),
        ),
        'cred' => array(
            'title'       => array('VD: "Dựa trên nền tảng vững chắc"', 60),
            'items.num'   => array('Con số + đơn vị. VD: "20+", "1000+"', 10),
            'items.label' => array('Chú thích. VD: "Năm kinh nghiệm"', 30),
        ),
        'reports' => array(
            'kicker'      => array('Nhãn nhỏ VIẾT HOA', 30),
            'title'       => array('Tiêu đề mục', 60),
            'items.tag'   => array('Nhãn phân loại ngắn. VD: "Cá nhân"', 15),
            'items.title' => array('Tên báo cáo', 40),
            'items.desc'  => array('1-2 câu mô tả', 140),
        ),
        'steps' => array(
            'title'       => array('VD: "Quy trình 3 bước"', 60),
            'items.title' => array('Tên bước, 2-5 từ', 40),
            'items.desc'  => array('1-2 câu mô tả bước', 140),
        ),
        'pricing' => array(
            'title'      => array('Tiêu đề mục giá', 50),
            'old'        => array('Giá gốc, sẽ gạch ngang. VD: 2.000.000đ', 20),
            'now'        => array('Giá ưu đãi - số to nổi bật', 20),
            'save'       => array('VD: "Tiết kiệm 40%"', 25),
            'note'       => array('Điều kiện áp dụng, hạn chót', 90),
            'btn'        => array('VD: "Đăng ký ngay"', 25),
            'items.text' => array('1 quyền lợi mỗi dòng', 70),
        ),
        'bigtesti' => array(
            'title'       => array('VD: "Cảm nhận của học viên"', 50),
            'items.quote' => array('Trích lời khách, 1-3 câu, có cảm xúc', 220),
            'items.name'  => array('Họ tên người đánh giá', 40),
            'items.role'  => array('Chức danh - Công ty', 60),
            'items.img'   => $img_portrait,
        ),
        'testi3' => array(
            'title'       => array('VD: "Cảm nhận khách hàng"', 50),
            'items.quote' => array('Trích lời khách, 1-2 câu', 160),
            'items.name'  => array('Họ tên', 40),
            'items.role'  => array('Chức danh - Công ty', 60),
            'items.img'   => $img_portrait,
        ),
        'quote' => array(
            'q'  => array('1 câu đắt giá - hiển thị cỡ chữ lớn', 160),
            'by' => array('Tên người - Chức danh', 60),
        ),
        'video' => array(
            'title' => array('Tiêu đề mục video', 60),
            'url'   => array('Dán link YouTube dạng youtube.com/watch?v=... hoặc youtu.be/...', 0),
        ),
        'twocol' => array(
            'title' => array('Tiêu đề mục', 60),
            'left'  => array('Đoạn văn cột trái, 2-4 câu', 400),
            'right' => array('Đoạn văn cột phải, 2-4 câu', 400),
        ),
        'faq' => array(
            'title'   => array('VD: "Câu hỏi thường gặp"', 50),
            'items.q' => array('Câu hỏi khách hay thắc mắc', 90),
            'items.a' => array('Trả lời ngắn gọn, đi thẳng vào ý', 300),
        ),
        'infocards' => array(
            'title'       => array('VD: "Thông tin sự kiện"', 50),
            'items.ico'   => array('1 emoji. VD: 📅 🕐 📍 🎟️', 4),
            'items.label' => array('Nhãn. VD: "Ngày", "Địa điểm"', 20),
            'items.value' => array('Giá trị. VD: "20/08/2026"', 40),
        ),
        'countdown' => array(
            'date'  => array('Định dạng Năm-Tháng-Ngày Giờ:Phút, VD 2026-12-31 20:00', 20),
            'label' => array('Chữ phía trên đồng hồ', 40),
        ),
        'regform' => array(
            'title' => array('VD: "Đăng ký tham dự"', 50),
            'sub'   => array('1 câu trấn an / hướng dẫn', 120),
            'btn'   => array('VD: "Đăng ký ngay"', 25),
        ),
        'band' => array(
            'title' => array('Câu kêu gọi hành động chính', 60),
            'sub'   => array('1 câu thuyết phục thêm', 120),
            'btn'   => array('VD: "Liên hệ ngay"', 25),
        ),
        'contact' => array(
            'title' => array('VD: "Liên hệ với chúng tôi"', 50),
            'sub'   => array('1-2 câu mời liên hệ', 160),
        ),
        'team' => array(
            'title'      => array('VD: "Đội ngũ của chúng tôi"', 50),
            'items.name' => array('Họ và tên đầy đủ', 40),
            'items.role' => array('VD: "Trưởng phòng Đào tạo"', 40),
            'items.img'  => $img_portrait,
        ),
        'logos' => array(
            'title'     => array('Nhãn nhỏ VIẾT HOA phía trên dải logo', 40),
            'items.img' => array('Logo nền trong suốt (PNG), cao khoảng 120px', 0),
        ),
        'timeline' => array(
            'title'       => array('VD: "Lộ trình 6 tháng"', 50),
            'items.time'  => array('VD: "Tháng 1", "Bước 1", "09:00"', 20),
            'items.title' => array('Tên mốc, ngắn gọn', 50),
            'items.desc'  => array('1-2 câu mô tả mốc này', 160),
        ),
        'checklist' => array(
            'title'      => array('Tiêu đề mục', 50),
            'items.text' => array('1 ưu điểm mỗi dòng, ngắn gọn', 90),
            'img'        => $img_43,
        ),
        'gallery' => array(
            'title'     => array('Tiêu đề mục', 50),
            'items.img' => array('Ảnh vuông/ngang đồng đều, hệ thống tự cắt cho khớp lưới', 0),
        ),
        'compare' => array(
            'title'       => array('VD: "Chọn gói phù hợp với bạn"', 60),
            'items.name'  => array('Tên gói', 30),
            'items.price' => array('Giá gói - số to nổi bật', 20),
            'items.feat'  => array('Mỗi dòng 1 quyền lợi, xuống dòng để thêm ý mới', 300),
        ),
        'map' => array(
            'title'   => array('Tiêu đề mục', 50),
            'address' => array('Địa chỉ đầy đủ, hiển thị dưới bản đồ', 120),
            'embed'   => array('Google Maps > Chia sẻ > Nhúng bản đồ > copy link trong src="...". Để trống hệ thống tự tìm theo địa chỉ.', 0),
        ),
        'richtext' => array(
            'title' => array('Để trống nếu đoạn văn không cần tiêu đề riêng', 50),
            'body'  => array('Viết tự do, xuống dòng (Enter) để tách đoạn văn mới', 900),
        ),
        'spacer' => array(),
        'contact_hero' => array(
            'w1' => array('Từ đầu tiên (kèm dấu cách nếu cần)', 12),
            'w2' => array('Từ thứ hai (kèm dấu cách nếu cần)', 12),
            'w3' => array('Từ thứ ba', 12),
            'brand' => array('Dòng chữ nhỏ màu xám dưới tiêu đề', 40),
        ),
    );
}

/* ============================================================
 * 2. PRESETS - bo section khoi dau theo 5 mau
 * ============================================================ */
function tnl_studio_presets() {
    return array(
        'blank' => array('label' => 'Trang trống', 'sections' => array()),
        'product' => array('label' => 'Sản phẩm', 'sections' => array(
            array('type' => 'hero'),
            array('type' => 'intro', 'fields' => array('color' => 'cyan', 'title' => 'Về sản phẩm này')),
            array('type' => 'panel', 'fields' => array('color' => 'cyan', 'title' => 'Lợi ích 1')),
            array('type' => 'panel', 'fields' => array('color' => 'orange', 'title' => 'Lợi ích 2', 'rev' => '1')),
            array('type' => 'panel', 'fields' => array('color' => 'yellow', 'title' => 'Lợi ích 3')),
            array('type' => 'intro', 'fields' => array('color' => 'orange', 'title' => 'Ai sẽ yêu thích sản phẩm này?', 'gray' => '1')),
            array('type' => 'bigtesti'),
            array('type' => 'contact'),
        )),
        'course' => array('label' => 'Chương trình / Khoá học', 'sections' => array(
            array('type' => 'hero', 'fields' => array('title' => 'Nâng tầm kỹ năng lãnh đạo bằng trí tuệ cảm xúc (EQ)', 'btn' => 'Tham gia ngay')),
            array('type' => 'intro', 'fields' => array('color' => 'cyan', 'title' => 'Chương trình dành cho bạn')),
            array('type' => 'intro', 'fields' => array('color' => 'green', 'title' => 'Điều khiến chúng tôi khác biệt', 'gray' => '1')),
            array('type' => 'panel', 'fields' => array('color' => 'cyan', 'title' => 'Học phần 1: Nền tảng EQ')),
            array('type' => 'panel', 'fields' => array('color' => 'orange', 'title' => 'Học phần 2: Lãnh đạo bằng cảm xúc', 'rev' => '1')),
            array('type' => 'panel', 'fields' => array('color' => 'green', 'title' => 'Học phần 3: Giao tiếp hiệu quả')),
            array('type' => 'bigtesti'),
            array('type' => 'contact', 'fields' => array('title' => 'Sẵn sàng bắt đầu?')),
        )),
        'assessment' => array('label' => 'Đánh giá / Báo cáo', 'sections' => array(
            array('type' => 'hero', 'fields' => array('title' => 'Tên bài đánh giá / chỉ số', 'btn' => 'Làm bài đánh giá')),
            array('type' => 'intro', 'fields' => array('color' => 'cyan', 'title' => 'Giá trị bạn nhận được')),
            array('type' => 'reports'),
            array('type' => 'bigtesti'),
            array('type' => 'contact', 'fields' => array('title' => 'Bắt đầu đánh giá ngay')),
        )),
        'offer' => array('label' => 'Ưu đãi / Khuyến mãi', 'sections' => array(
            array('type' => 'herodark'),
            array('type' => 'intro', 'fields' => array('color' => 'orange', 'title' => 'Vì sao nên nhận ngay')),
            array('type' => 'panel', 'fields' => array('color' => 'green', 'title' => 'Quyền lợi 1')),
            array('type' => 'panel', 'fields' => array('color' => 'yellow', 'title' => 'Quyền lợi 2', 'rev' => '1')),
            array('type' => 'pricing'),
            array('type' => 'bigtesti'),
            array('type' => 'contact', 'fields' => array('title' => 'Đăng ký nhận ưu đãi')),
        )),
        'event' => array('label' => 'Sự kiện', 'sections' => array(
            array('type' => 'hero', 'fields' => array('title' => 'Tên sự kiện của bạn tại đây', 'btn' => 'Đăng ký tham dự')),
            array('type' => 'countdown', 'fields' => array('label' => 'Sự kiện bắt đầu sau')),
            array('type' => 'infocards'),
            array('type' => 'intro', 'fields' => array('color' => 'cyan', 'title' => 'Về sự kiện', 'gray' => '1')),
            array('type' => 'panel', 'fields' => array('color' => 'cyan', 'title' => 'Tên diễn giả')),
            array('type' => 'panel', 'fields' => array('color' => 'orange', 'title' => 'Tên diễn giả', 'rev' => '1')),
            array('type' => 'regform'),
            array('type' => 'contact', 'fields' => array('title' => 'Liên hệ ban tổ chức')),
        )),
    );
}

/* ============================================================
 * 3. COMPOSER - JSON sections -> markup front-end
 * ============================================================ */
function tnl_studio_field($fields, $key, $schema_fields) {
    $def = isset($schema_fields[$key][2]) ? $schema_fields[$key][2] : '';
    $v = isset($fields[$key]) && $fields[$key] !== '' ? $fields[$key] : $def;
    // Cho phep vai the an toan trong text hien thi
    return wp_kses($v, array('b' => array(), 'strong' => array(), 'em' => array(), 'br' => array()));
}

function tnl_studio_render_section($type, $fields, $items) {
    $schema = tnl_studio_schema();
    if (!isset($schema[$type])) return '';
    $sf = isset($schema[$type]['fields']) ? $schema[$type]['fields'] : array();
    $F = function ($k) use ($fields, $sf) { return tnl_studio_field($fields, $k, $sf); };
    $IMG = function ($k) use ($fields) {
        $v = isset($fields[$k]) ? esc_url_raw($fields[$k]) : '';
        return $v ? $v : tnl_tpl_ph();
    };
    $CHK = function ($k) use ($fields) { return !empty($fields[$k]); };
    // Chuan hoa items theo subschema
    $rows = array();
    if (isset($schema[$type]['items'])) {
        $isf = $schema[$type]['items']['fields'];
        foreach ((array) $items as $it) {
            $row = array();
            foreach ($isf as $k => $d) {
                if ($d[0] === 'image') { $v = isset($it[$k]) ? esc_url_raw($it[$k]) : ''; $row[$k] = $v ? $v : tnl_tpl_ph(); }
                else $row[$k] = tnl_studio_field((array) $it, $k, $isf);
            }
            $rows[] = $row;
        }
    }

    switch ($type) {
        case 'hero':
            $m = tnl_secx_hero($F('title'), $F('sub'), $F('btn'));
            return str_replace(tnl_tpl_ph(), $IMG('img'), $m);
        case 'herodark':
            return tnl_sec_offer_hero($F('badge'), $F('title'), $F('sub'), $F('btn'), sanitize_text_field($F('date')));
        case 'intro':
            return tnl_secx_intro(sanitize_key($F('color')), $F('title'), $F('body'), $CHK('gray'));
        case 'panel':
            $m = tnl_wrap_secx(tnl_secx_panel(sanitize_key($F('color')), $F('title'), $F('body'), $F('btn'), $CHK('rev')));
            return str_replace(tnl_tpl_ph(), $IMG('img'), $m);
        case 'feat':
            return tnl_sec_feat($F('kicker'), $F('title'), $F('body'), $IMG('img'), $CHK('rev'));
        case 'cards3':
            $cards = array(); foreach ($rows as $r) $cards[] = array($r['ico'], $r['title'], $r['desc']);
            return tnl_sec_cards3($F('title'), $cards);
        case 'prog':
            $it = array(); foreach ($rows as $r) $it[] = array($r['title'], $r['desc']);
            return tnl_sec_prog($F('kicker'), $F('title'), $it);
        case 'cred':
            $it = array(); foreach ($rows as $r) $it[] = array($r['num'], $r['label']);
            return tnl_sec_cred($F('title'), $it);
        case 'reports':
            $it = array(); foreach ($rows as $r) $it[] = array($r['tag'], $r['title'], $r['desc']);
            return tnl_sec_reports($F('kicker'), $F('title'), $it);
        case 'steps':
            $it = array(); foreach ($rows as $r) $it[] = array($r['title'], $r['desc']);
            return tnl_secx_steps(sanitize_key($F('color')), $F('title'), $it);
        case 'pricing':
            $it = array(); foreach ($rows as $r) $it[] = $r['text'];
            return tnl_sec_pricing($F('title'), $F('old'), $F('now'), $F('save'), $it, $F('note'), $F('btn'));
        case 'bigtesti':
            $html = '<h2 class="tnl-bigtesti__h" data-tnls-key="title">' . $F('title') . '</h2>';
            $i = 0;
            foreach ($rows as $r) {
                $html .= '<div class="tnl-bigtesti__row' . ($i % 2 ? ' tnl-bigtesti__row--rev' : '') . '">'
                    . '<img src="' . esc_url($r['img']) . '" alt="' . esc_attr($r['name']) . '">'
                    . '<div><p class="tnl-bigtesti__q">"' . $r['quote'] . '"</p><p class="tnl-bigtesti__n">' . $r['name'] . '</p><p class="tnl-bigtesti__r">' . $r['role'] . '</p></div></div>';
                $i++;
            }
            return '<!-- wp:group {"tagName":"section","className":"tnl-secx","layout":{"type":"constrained"}} --><section class="wp-block-group tnl-secx"><!-- wp:html -->' . $html . '<!-- /wp:html --></section><!-- /wp:group -->';
        case 'testi3':
            $cols = '';
            foreach ($rows as $r) {
                $cols .= '<!-- wp:column --><div class="wp-block-column"><!-- wp:html --><div class="tnl-testi__card">'
                    . '<p class="tnl-testi__quote">"' . $r['quote'] . '"</p>'
                    . '<div class="tnl-testi__who"><img src="' . esc_url($r['img']) . '" alt="' . esc_attr($r['name']) . '"><div>'
                    . '<p class="tnl-testi__name">' . $r['name'] . '</p><p class="tnl-testi__role">' . $r['role'] . '</p></div></div>'
                    . '</div><!-- /wp:html --></div><!-- /wp:column -->';
            }
            return '
<!-- wp:group {"tagName":"section","className":"tnl-sec tnl-testi","layout":{"type":"constrained"}} -->
<section class="wp-block-group tnl-sec tnl-testi">
<!-- wp:heading {"textAlign":"center","className":"tnl-h2"} --><h2 class="has-text-align-center tnl-h2" data-tnls-key="title">' . $F('title') . '</h2><!-- /wp:heading -->
<!-- wp:columns {"className":"tnl-testi__grid"} --><div class="wp-block-columns tnl-testi__grid">' . $cols . '</div><!-- /wp:columns -->
</section>
<!-- /wp:group -->';
        case 'quote':
            return tnl_secx_quote($F('q'), $F('by'));
        case 'video':
            $url = esc_url($fields['url'] ?? '');
            return tnl_wrap_secx(tnl_hl_h(sanitize_key($F('color')), $F('title'))
                . '<!-- wp:embed {"type":"video","providerNameSlug":"youtube","className":"tnl-video wp-block-embed-youtube"} --><figure class="wp-block-embed is-type-video is-provider-youtube wp-block-embed-youtube tnl-video"><div class="wp-block-embed__wrapper">' . $url . '</div></figure><!-- /wp:embed -->');
        case 'twocol':
            return tnl_secx_2col(sanitize_key($F('color')), $F('title'), $F('left'), $F('right'));
        case 'faq':
            $d = '';
            foreach ($rows as $r) $d .= '<details class="tnl-faq__item"><summary>' . $r['q'] . '</summary><p>' . $r['a'] . '</p></details>';
            return tnl_wrap_secx(tnl_hl_h(sanitize_key($F('color')), $F('title')) . '<!-- wp:html -->' . $d . '<!-- /wp:html -->');
        case 'infocards':
            $cols = '';
            foreach ($rows as $r) {
                $cols .= '<!-- wp:column --><div class="wp-block-column"><!-- wp:group {"className":"tnl-card"} --><div class="wp-block-group tnl-card"><!-- wp:paragraph {"className":"tnl-card__ico"} --><p class="tnl-card__ico">' . $r['ico'] . '</p><!-- /wp:paragraph --><!-- wp:heading {"level":3} --><h3>' . $r['label'] . '</h3><!-- /wp:heading --><!-- wp:paragraph --><p>' . $r['value'] . '</p><!-- /wp:paragraph --></div><!-- /wp:group --></div><!-- /wp:column -->';
            }
            return tnl_wrap_secx(tnl_hl_h(sanitize_key($F('color')), $F('title'))
                . '<!-- wp:columns {"className":"tnl-info__grid"} --><div class="wp-block-columns tnl-info__grid">' . $cols . '</div><!-- /wp:columns -->');
        case 'countdown':
            return '<!-- wp:group {"tagName":"section","className":"tnl-sec tnl-hero","layout":{"type":"constrained"}} --><section class="wp-block-group tnl-sec tnl-hero" style="padding-top:48px;padding-bottom:48px"><!-- wp:shortcode -->[tnl_countdown date="' . esc_attr(sanitize_text_field($F('date'))) . '" label="' . esc_attr($F('label')) . '"]<!-- /wp:shortcode --></section><!-- /wp:group -->';
        case 'regform':
            return '<!-- wp:group {"tagName":"section","className":"tnl-sec tnl-register","anchor":"dang-ky","layout":{"type":"constrained"}} --><section class="wp-block-group tnl-sec tnl-register" id="dang-ky">'
                . '<!-- wp:heading {"textAlign":"center","className":"tnl-h2"} --><h2 class="has-text-align-center tnl-h2">' . $F('title') . '</h2><!-- /wp:heading -->'
                . '<!-- wp:paragraph {"align":"center","className":"tnl-register__sub"} --><p class="has-text-align-center tnl-register__sub">' . $F('sub') . '</p><!-- /wp:paragraph -->'
                . '<!-- wp:shortcode -->[tnl_reg_form title="" button="' . esc_attr($F('btn')) . '" fields="name,email,phone,company"]<!-- /wp:shortcode -->'
                . '</section><!-- /wp:group -->';
        case 'band':
            return tnl_secx_band($CHK('dark'), $F('title'), $F('sub'), $F('btn'));
        case 'contact':
            return tnl_sec_contact($F('title'), $F('sub'));
        case 'team':
            $it = array(); foreach ($rows as $r) $it[] = array($r['name'], $r['role'], $r['img']);
            return tnl_secx_team(sanitize_key($F('color')), $F('title'), $it);
        case 'logos':
            $it = array(); foreach ($rows as $r) $it[] = $r['img'];
            return tnl_secx_logos($F('title'), $it);
        case 'timeline':
            $it = array(); foreach ($rows as $r) $it[] = array($r['time'], $r['title'], $r['desc']);
            return tnl_secx_timeline(sanitize_key($F('color')), $F('title'), $it);
        case 'checklist':
            $it = array(); foreach ($rows as $r) $it[] = $r['text'];
            return tnl_secx_checklist(sanitize_key($F('color')), $F('title'), $IMG('img'), $it, $CHK('rev'));
        case 'gallery':
            $it = array(); foreach ($rows as $r) $it[] = $r['img'];
            return tnl_secx_gallery(sanitize_key($F('color')), $F('title'), $it);
        case 'compare':
            $it = array(); foreach ($rows as $r) $it[] = array($r['name'], $r['price'], $r['feat'], !empty($r['hl']));
            return tnl_secx_compare($F('title'), $it);
        case 'map':
            return tnl_secx_map($F('title'), $F('address'), esc_url_raw($fields['embed'] ?? ''));
        case 'richtext':
            return tnl_secx_richtext($F('title'), $F('body'), $CHK('gray'));
        case 'spacer':
            return tnl_secx_spacer(sanitize_key($F('size')), $CHK('line'));
        case 'contact_hero':
            return tnl_native_contact_hero($F('w1'), sanitize_key($fields['c1'] ?? 'cyan'), $F('w2'), sanitize_key($fields['c2'] ?? 'green'), $F('w3'), sanitize_key($fields['c3'] ?? 'yellow'), $F('brand'));
        case 'contact_form':
            return tnl_native_contact_form();
    }
    return '';
}

/* $editable=true: bọc mỗi khối trong <div data-tnls-idx data-tnls-type ...> để
 * assets/studio-canvas.js nhận diện và cho sửa trực tiếp trên canvas (kiểu Elementor).
 * CHỈ bật khi render cho khung preview của Landing Studio (người có quyền edit_pages) -
 * không bao giờ bật cho post_content lưu vĩnh viễn / trang thật cho khách xem. */
function tnl_studio_compose($sections, $editable = false) {
    $out = '';
    $i = -1;
    $schema = $editable ? tnl_studio_schema() : null;
    foreach ((array) $sections as $s) {
        $i++;
        if (empty($s['type'])) continue;
        $type = sanitize_key($s['type']);
        $html = tnl_studio_render_section(
            $type,
            isset($s['fields']) ? (array) $s['fields'] : array(),
            isset($s['items']) ? (array) $s['items'] : array()
        );
        if ($editable && $html !== '') {
            $attrs = ' data-tnls-idx="' . $i . '" data-tnls-type="' . esc_attr($type) . '"';
            if (isset($schema[$type]['fields'])) {
                $has_img = $has_color = false;
                foreach ($schema[$type]['fields'] as $fk => $fd) {
                    if (!$has_img && $fd[0] === 'image') { $attrs .= ' data-tnls-img-key="' . esc_attr($fk) . '"'; $has_img = true; }
                    if (!$has_color && $fd[0] === 'select') { $attrs .= ' data-tnls-color-key="' . esc_attr($fk) . '"'; $has_color = true; }
                }
            }
            $html = '<div class="tnls-canvas-sec"' . $attrs . '>' . $html . '</div>';
        }
        $out .= $html;
    }
    return $out;
}

/* Bo section mac dinh day du (fields + items default) tu schema */
function tnl_studio_default_section($type) {
    $schema = tnl_studio_schema();
    if (!isset($schema[$type])) return null;
    $s = array('type' => $type, 'fields' => array(), 'items' => array());
    foreach ($schema[$type]['fields'] as $k => $d) $s['fields'][$k] = $d[2];
    if (isset($schema[$type]['items'])) {
        $n = $schema[$type]['items']['default'];
        for ($i = 0; $i < $n; $i++) {
            $row = array();
            foreach ($schema[$type]['items']['fields'] as $k => $d) $row[$k] = $d[2];
            $s['items'][] = $row;
        }
    }
    return $s;
}

/* ============================================================
 * 3c. "EDIT" CHUAN CUA WP -> LUON DAN VE DUNG CHO SUA
 * - Post DA bat Landing Studio (co _tnl_studio_data) -> vao thang man keo-tha.
 * - Trang con CLONE MODE (chua bat Studio, van con nguyen giao dien goc) ->
 *   dan THANG RA TRANG THAT voi ?tnl_edit=1 (bat Inline Editor - inc/inline-editor.php):
 *   bam vao chu la sua ngay, di vao anh la doi ngay, GIU NGUYEN giao dien, khong
 *   phai dung lai bang khoi. Day la duong mac dinh cho moi trang co san.
 * - Trang khong lien quan Studio/clone (post thuong, trang moi tinh...) ->
 *   giu nguyen hanh vi WP mac dinh.
 * ============================================================ */
function tnl_studio_edit_target($id) {
    if (!$id) return '';
    if (get_post_meta($id, '_tnl_studio_data', true)) {
        return admin_url('admin.php?page=tnl-studio&post=' . $id);
    }
    $p = get_post($id);
    if ($p && $p->post_type === 'page' && function_exists('tnl_clone_has') && tnl_clone_has($p->post_name)) {
        return add_query_arg('tnl_edit', '1', get_permalink($p));
    }
    return '';
}
add_action('load-post.php', function () {
    if (!isset($_GET['action']) || $_GET['action'] !== 'edit') return;
    $id = isset($_GET['post']) ? absint($_GET['post']) : 0;
    if (!$id || !current_user_can('edit_post', $id)) return;
    $to = tnl_studio_edit_target($id);
    if (!$to) return;
    wp_safe_redirect($to);
    exit;
});

add_filter('get_edit_post_link', function ($link, $post_id) {
    $to = tnl_studio_edit_target($post_id);
    return $to ? $to : $link;
}, 10, 2);

/* ============================================================
 * 4. ADMIN PAGE
 * ============================================================ */
add_action('admin_menu', function () {
    add_menu_page('Landing Studio', 'Landing Studio', 'edit_pages', 'tnl-studio', 'tnl_studio_screen', 'dashicons-layout', 21);
});

add_action('admin_enqueue_scripts', function ($hook) {
    if ($hook !== 'toplevel_page_tnl-studio') return;
    $dir = get_template_directory();
    $uri = get_template_directory_uri();
    wp_enqueue_media();
    wp_enqueue_style('tnl-studio', $uri . '/assets/studio.css', array(), @filemtime($dir . '/assets/studio.css') ?: '1');
    wp_enqueue_script('tnl-studio', $uri . '/assets/studio.js', array('jquery'), @filemtime($dir . '/assets/studio.js') ?: '1', true);

    $post_id = isset($_GET['post']) ? absint($_GET['post']) : 0;
    $data = array('sections' => array());
    $post_info = null;
    if ($post_id) {
        $raw = get_post_meta($post_id, '_tnl_studio_data', true);
        if ($raw) { $dec = json_decode($raw, true); if (is_array($dec)) $data = $dec; }
        $p = get_post($post_id);
        if ($p) {
            $post_info = array(
                'id' => $p->ID, 'title' => $p->post_title, 'status' => $p->post_status,
                'type'    => $p->post_type,
                'preview' => add_query_arg('preview', 'true', get_permalink($p)),
                'permalink' => get_permalink($p),
                'slug'      => $p->post_name,
                'parent'    => $p->post_parent,
                'seoTitle'  => get_post_meta($p->ID, '_tnl_seo_title', true),
                'seoDesc'   => get_post_meta($p->ID, '_tnl_seo_desc', true),
            );
        }
    }
    // Danh sach trang cha kha di (trang publish, khong phai trang MAU)
    $parents = array();
    foreach (get_pages(array('post_status' => 'publish', 'sort_column' => 'post_title')) as $pg) {
        if (strpos($pg->post_title, 'MẪU') === 0) continue;
        $parents[] = array('id' => $pg->ID, 'title' => $pg->post_title);
    }
    wp_localize_script('tnl-studio', 'tnlStudio', array(
        'ajax'    => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('tnl_studio'),
        'schema'  => tnl_studio_schema(),
        'hints'   => tnl_studio_hints(),
        'presets' => tnl_studio_presets(),
        'data'    => $data,
        'post'    => $post_info,
        'ph'      => tnl_tpl_ph(),
        'listUrl' => admin_url('admin.php?page=tnl-studio'),
        'homeUrl' => trailingslashit(home_url()),
        'parents' => $parents,
    ));
});

function tnl_studio_screen() {
    $post_id = isset($_GET['post']) ? absint($_GET['post']) : 0;
    if ($post_id) { tnl_studio_screen_editor($post_id); return; }
    // ---- Man hinh danh sach ----
    $items = get_posts(array(
        'post_type' => array('page', 'post'), 'post_status' => array('publish', 'draft'),
        'meta_key' => '_tnl_studio_data', 'numberposts' => 50, 'orderby' => 'modified', 'order' => 'DESC',
    ));
    ?>
    <div class="wrap tnl-studio-list">
        <h1>Landing Studio</h1>
        <p class="tnls-lead">Dựng trang hoặc bài viết bằng cách ghép các khối có sẵn - chọn mẫu, sửa chữ, đổi ảnh, kéo đổi thứ tự. Không thể làm vỡ giao diện.</p>
        <h2>Tạo mới từ mẫu</h2>
        <div class="tnls-type-toggle">
            <label><input type="radio" name="tnls-type-choice" value="page" checked> Trang (page)</label>
            <label><input type="radio" name="tnls-type-choice" value="post"> Bài viết (blog)</label>
        </div>
        <div class="tnls-presets">
            <?php foreach (tnl_studio_presets() as $key => $p) : ?>
            <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" class="tnls-preset-card">
                <input type="hidden" name="action" value="tnl_studio_create">
                <input type="hidden" name="preset" value="<?php echo esc_attr($key); ?>">
                <input type="hidden" name="type" class="tnls-type-input" value="page">
                <?php wp_nonce_field('tnl_studio_create'); ?>
                <span class="tnls-preset-name"><?php echo esc_html($p['label']); ?></span>
                <span class="tnls-preset-count"><?php echo count($p['sections']); ?> khối</span>
                <button type="submit" class="button button-primary">Tạo</button>
            </form>
            <?php endforeach; ?>
        </div>
        <script>
        document.querySelectorAll('input[name="tnls-type-choice"]').forEach(function (r) {
            r.addEventListener('change', function () {
                document.querySelectorAll('.tnls-type-input').forEach(function (i) { i.value = r.value; });
            });
        });
        </script>
        <?php
        $adoptable = get_posts(array(
            'post_type' => 'page', 'post_status' => array('publish', 'draft'), 'numberposts' => 200,
            'orderby' => 'title', 'order' => 'ASC',
            'meta_query' => array(array('key' => '_tnl_studio_data', 'compare' => 'NOT EXISTS')),
        ));
        $adoptable = array_values(array_filter($adoptable, function ($pg) {
            return function_exists('tnl_clone_has') && tnl_clone_has($pg->post_name);
        }));
        ?>
        <?php
        $adopt_hint = isset($_GET['adopt']) ? absint($_GET['adopt']) : 0;
        $adopt_pg = null;
        if ($adopt_hint) { foreach ($adoptable as $pg) { if ($pg->ID === $adopt_hint) { $adopt_pg = $pg; break; } } }
        ?>
        <?php if ($adoptable) : ?>
        <h2 id="tnls-adopt-anchor">Chuyển trang có sẵn sang kéo-thả</h2>
        <?php if ($adopt_pg) : ?>
        <p class="tnls-lead" style="color:#B5470B"><b><?php echo esc_html($adopt_pg->post_title); ?></b> chưa dùng Landing Studio nên bấm "Edit" vẫn ra màn soạn thảo mặc định. Chọn mẫu khởi đầu rồi bấm "Chuyển sang Landing Studio" bên dưới để bắt đầu kéo-thả trên trang này.</p>
        <?php endif; ?>
        <p class="tnls-lead">Trang đang chạy theo thiết kế cố định (khớp Figma) - chuyển sang đây để kéo-thả được, nhưng phải dựng lại nội dung bằng các khối (không tự copy nội dung cũ). <b>Trang sẽ đổi giao diện NGAY khi bấm "Chuyển"</b> nếu trang đang publish - chỉ làm khi đã sẵn sàng dựng lại nội dung.</p>
        <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" class="tnls-adopt-form">
            <input type="hidden" name="action" value="tnl_studio_adopt">
            <?php wp_nonce_field('tnl_studio_adopt'); ?>
            <select name="post_id">
                <?php foreach ($adoptable as $pg) : ?>
                <option value="<?php echo esc_attr($pg->ID); ?>" <?php selected($adopt_pg && $pg->ID === $adopt_pg->ID); ?>><?php echo esc_html($pg->post_title . ' (/' . $pg->post_name . '/)'); ?></option>
                <?php endforeach; ?>
            </select>
            <select name="preset">
                <option value="blank">Bắt đầu trống</option>
                <?php foreach (tnl_studio_presets() as $key => $p) : if ($key === 'blank') continue; ?>
                <option value="<?php echo esc_attr($key); ?>"><?php echo esc_html($p['label']); ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit" class="button button-primary" onclick="return confirm('Trang này sẽ đổi sang giao diện Landing Studio ngay lập tức nếu đang publish. Tiếp tục?');">Chuyển sang Landing Studio</button>
        </form>
        <?php if ($adopt_pg) : ?>
        <script>document.getElementById('tnls-adopt-anchor').scrollIntoView({behavior:'smooth', block:'center'});</script>
        <?php endif; ?>
        <?php endif; ?>
        <h2>Đã tạo</h2>
        <?php if (!$items) : ?><p>Chưa có trang/bài viết nào. Tạo mới từ mẫu phía trên.</p><?php else : ?>
        <table class="widefat striped tnls-table">
            <thead><tr><th>Tên</th><th>Loại</th><th>Trạng thái</th><th>Sửa lần cuối</th><th></th></tr></thead>
            <tbody>
            <?php foreach ($items as $p) : ?>
                <tr>
                    <td><strong><?php echo esc_html($p->post_title); ?></strong></td>
                    <td><?php echo $p->post_type === 'post' ? 'Bài viết' : 'Trang'; ?></td>
                    <td><?php echo $p->post_status === 'publish' ? '<span class="tnls-live">Đang chạy</span>' : '<span class="tnls-draft">Nháp</span>'; ?></td>
                    <td><?php echo esc_html(get_the_modified_date('d/m/Y H:i', $p)); ?></td>
                    <td>
                        <a class="button button-primary" href="<?php echo esc_url(admin_url('admin.php?page=tnl-studio&post=' . $p->ID)); ?>">Mở Studio</a>
                        <a class="button" href="<?php echo esc_url(add_query_arg('preview', 'true', get_permalink($p))); ?>" target="_blank">Xem trang</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <?php endif; ?>
    </div>
    <?php
}

function tnl_studio_screen_editor($post_id) {
    $p = get_post($post_id);
    if (!$p) { echo '<div class="wrap"><h1>Không tìm thấy trang.</h1></div>'; return; }
    ?>
    <div class="tnls-editor" id="tnls-app">
        <div class="tnls-topbar">
            <a href="<?php echo esc_url(admin_url('admin.php?page=tnl-studio')); ?>" class="tnls-back">&larr; Danh sách</a>
            <input type="text" id="tnls-title" value="<?php echo esc_attr($p->post_title); ?>" placeholder="Tên trang landing">
            <span class="tnls-status" id="tnls-status-label"></span>
            <span class="tnls-savemsg" id="tnls-savemsg"></span>
            <button class="button" id="tnls-settings-btn">Cài đặt trang</button>
            <button class="button" id="tnls-save-draft">Lưu nháp</button>
            <button class="button button-primary" id="tnls-publish">Lưu &amp; Đăng</button>
            <a class="button" id="tnls-view" href="#" target="_blank">Mở trang thật</a>
        </div>
        <div class="tnls-body">
            <div class="tnls-side">
                <div class="tnls-side-head">
                    <strong>Các khối trên trang</strong>
                    <button class="button button-primary" id="tnls-add">+ Thêm khối</button>
                </div>
                <p class="tnls-hint">Kéo ☰ để đổi thứ tự - bấm tên khối để sửa nội dung.</p>
                <ul id="tnls-sections"></ul>
            </div>
            <div class="tnls-preview">
                <div class="tnls-preview-bar">
                    <span>Xem trước</span>
                    <span class="tnls-preview-note">Tự cập nhật khi bạn sửa - bấm "Lưu" khi ưng ý</span>
                    <span class="tnls-devices">
                        <button data-w="100%" class="active">Máy tính</button>
                        <button data-w="390px">Điện thoại</button>
                    </span>
                </div>
                <div class="tnls-frame-wrap"><iframe id="tnls-frame" src="about:blank"></iframe></div>
            </div>
        </div>
        <div class="tnls-settings" id="tnls-settings" hidden>
            <div class="tnls-settings-box">
                <div class="tnls-picker-head"><strong>Cài đặt trang (đường dẫn &amp; SEO)</strong><button id="tnls-settings-close">&times;</button></div>
                <label class="tnls-field">
                    <span>Đường dẫn trang (URL)</span>
                    <small class="tnls-fhint">Chữ thường không dấu, nối bằng gạch ngang. VD: <code>uu-dai-thang-8</code></small>
                    <div class="tnls-slugrow"><em id="tnls-url-prefix"></em><input type="text" id="tnls-slug"></div>
                </label>
                <label class="tnls-field" id="tnls-parent-field"<?php echo ($p->post_type !== 'page') ? ' hidden' : ''; ?>>
                    <span>Nằm dưới trang nào (trang cha)</span>
                    <small class="tnls-fhint">Chọn nếu muốn URL dạng <code>/trang-cha/trang-nay/</code>. Để trống = nằm ở gốc website.</small>
                    <select id="tnls-parent"><option value="0">- Nằm ở gốc website -</option></select>
                </label>
                <label class="tnls-field">
                    <span>Tiêu đề SEO <i class="tnls-count" data-for="tnls-seo-title"></i></span>
                    <small class="tnls-fhint">Hiện trên Google &amp; tab trình duyệt. Nên ≤ 60 ký tự, chứa từ khoá chính. KHÔNG cần thêm "The New Leaders" - hệ thống tự gắn vào cuối. Để trống = dùng tên trang.</small>
                    <input type="text" id="tnls-seo-title" maxlength="90">
                </label>
                <label class="tnls-field">
                    <span>Mô tả SEO <i class="tnls-count" data-for="tnls-seo-desc"></i></span>
                    <small class="tnls-fhint">Đoạn mô tả dưới tiêu đề trên Google. Nên 120-160 ký tự, nêu lợi ích + kêu gọi bấm vào.</small>
                    <textarea id="tnls-seo-desc" rows="3" maxlength="220"></textarea>
                </label>
                <p class="tnls-fhint" style="margin:4px 0 0">Các thay đổi trên áp dụng khi bấm <b>Lưu nháp</b> hoặc <b>Lưu &amp; Đăng</b>.</p>
            </div>
        </div>
        <div class="tnls-picker" id="tnls-picker" hidden>
            <div class="tnls-picker-box">
                <div class="tnls-picker-head"><strong>Chọn khối để thêm</strong><button id="tnls-picker-close">&times;</button></div>
                <div id="tnls-picker-groups"></div>
            </div>
        </div>
    </div>
    <?php
}

/* ============================================================
 * 5. HANDLERS - tao trang / luu
 * ============================================================ */
add_action('admin_post_tnl_studio_create', function () {
    if (!current_user_can('edit_pages')) wp_die('Không đủ quyền.');
    check_admin_referer('tnl_studio_create');
    $presets = tnl_studio_presets();
    $key = isset($_POST['preset']) ? sanitize_key($_POST['preset']) : 'blank';
    if (!isset($presets[$key])) $key = 'blank';
    $type = (isset($_POST['type']) && $_POST['type'] === 'post') ? 'post' : 'page';
    // Bo section day du: preset chi ghi de field khac default
    $sections = array();
    foreach ($presets[$key]['sections'] as $ps) {
        $s = tnl_studio_default_section($ps['type']);
        if (!$s) continue;
        if (!empty($ps['fields'])) foreach ($ps['fields'] as $k => $v) $s['fields'][$k] = $v;
        $sections[] = $s;
    }
    $title = ($type === 'post' ? 'Bài viết ' : 'Landing ') . $presets[$key]['label'] . ' ' . date_i18n('d/m');
    $id = wp_insert_post(array(
        'post_type' => $type, 'post_status' => 'draft', 'post_title' => $title,
        'post_content' => tnl_studio_compose($sections),
    ));
    if (!$id || is_wp_error($id)) wp_die('Tạo thất bại.');
    if ($type === 'page') update_post_meta($id, '_wp_page_template', 'page-templates/landing.php');
    update_post_meta($id, '_tnl_studio_data', wp_slash(wp_json_encode(array('sections' => $sections), JSON_UNESCAPED_UNICODE)));
    wp_safe_redirect(admin_url('admin.php?page=tnl-studio&post=' . $id));
    exit;
});

/* "Adopt" 1 trang CLONE MODE co san sang Landing Studio: giu nguyen ID/slug (khong tao trang moi),
 * chi gan _tnl_studio_data + xoa _wp_page_template (de page.php dung page-shell). KHONG dung post_content. */
add_action('admin_post_tnl_studio_adopt', function () {
    if (!current_user_can('edit_pages')) wp_die('Không đủ quyền.');
    check_admin_referer('tnl_studio_adopt');
    $post_id = isset($_POST['post_id']) ? absint($_POST['post_id']) : 0;
    $p = $post_id ? get_post($post_id) : null;
    if (!$p || $p->post_type !== 'page') wp_die('Không tìm thấy trang.');
    if (get_post_meta($post_id, '_tnl_studio_data', true)) wp_die('Trang này đã dùng Landing Studio rồi.');

    $presets = tnl_studio_presets();
    $key = isset($_POST['preset']) ? sanitize_key($_POST['preset']) : 'blank';
    if (!isset($presets[$key])) $key = 'blank';
    $sections = array();
    foreach ($presets[$key]['sections'] as $ps) {
        $s = tnl_studio_default_section($ps['type']);
        if (!$s) continue;
        if (!empty($ps['fields'])) foreach ($ps['fields'] as $k => $v) $s['fields'][$k] = $v;
        $sections[] = $s;
    }
    delete_post_meta($post_id, '_wp_page_template');
    update_post_meta($post_id, '_tnl_studio_data', wp_slash(wp_json_encode(array('sections' => $sections), JSON_UNESCAPED_UNICODE)));
    wp_safe_redirect(admin_url('admin.php?page=tnl-studio&post=' . $post_id));
    exit;
});

add_action('wp_ajax_tnl_studio_save', function () {
    if (!current_user_can('edit_pages')) wp_send_json_error('Không đủ quyền.');
    check_ajax_referer('tnl_studio', 'nonce');
    $post_id = isset($_POST['post_id']) ? absint($_POST['post_id']) : 0;
    $p = $post_id ? get_post($post_id) : null;
    if (!$p || !in_array($p->post_type, array('page', 'post'), true)) wp_send_json_error('Không tìm thấy trang.');

    $raw = isset($_POST['data']) ? wp_unslash($_POST['data']) : '';
    $dec = json_decode($raw, true);
    if (!is_array($dec) || !isset($dec['sections'])) wp_send_json_error('Dữ liệu không hợp lệ.');

    $title  = isset($_POST['title']) ? sanitize_text_field(wp_unslash($_POST['title'])) : $p->post_title;
    $status = (isset($_POST['status']) && $_POST['status'] === 'publish') ? 'publish' : $p->post_status;

    $content = tnl_studio_compose($dec['sections']);
    $upd = array('ID' => $post_id, 'post_title' => $title, 'post_content' => $content, 'post_status' => $status);
    // Duong dan + trang cha (tuy chon - trang cha chi ap dung post_type=page)
    if (isset($_POST['slug'])) {
        $slug = sanitize_title(wp_unslash($_POST['slug']));
        if ($slug !== '') $upd['post_name'] = $slug;
    }
    if ($p->post_type === 'page' && isset($_POST['parent'])) $upd['post_parent'] = absint($_POST['parent']);
    wp_update_post($upd);
    if ($p->post_type === 'page') {
        // Trang trung slug 1 file clone co san ("adopt" trang chinh) -> dung PAGE-SHELL
        // (giu nguyen nav/footer that cua trang do qua page.php), KHONG dung template landing.php
        // (header/footer rieng, chi hop voi trang landing hoan toan moi).
        $final_slug = isset($upd['post_name']) ? $upd['post_name'] : $p->post_name;
        if (function_exists('tnl_clone_has') && tnl_clone_has($final_slug)) {
            delete_post_meta($post_id, '_wp_page_template');
        } else {
            update_post_meta($post_id, '_wp_page_template', 'page-templates/landing.php');
        }
    }
    update_post_meta($post_id, '_tnl_studio_data', wp_slash(wp_json_encode(array('sections' => $dec['sections']), JSON_UNESCAPED_UNICODE)));
    // SEO tung trang
    if (isset($_POST['seo_title'])) update_post_meta($post_id, '_tnl_seo_title', sanitize_text_field(wp_unslash($_POST['seo_title'])));
    if (isset($_POST['seo_desc']))  update_post_meta($post_id, '_tnl_seo_desc', sanitize_text_field(wp_unslash($_POST['seo_desc'])));

    $p = get_post($post_id);
    wp_send_json_success(array(
        'status'    => $p->post_status,
        'preview'   => add_query_arg(array('preview' => 'true', 'ts' => time()), get_permalink($p)),
        'permalink' => get_permalink($p),
    ));
});

/* Live preview: luu tam sections vao transient (KHONG dong post) -> iframe render ngay */
add_action('wp_ajax_tnl_studio_preview', function () {
    if (!current_user_can('edit_pages')) wp_send_json_error('Không đủ quyền.');
    check_ajax_referer('tnl_studio', 'nonce');
    $post_id = isset($_POST['post_id']) ? absint($_POST['post_id']) : 0;
    if (!$post_id || !get_post($post_id)) wp_send_json_error('Không tìm thấy trang.');
    $raw = isset($_POST['data']) ? wp_unslash($_POST['data']) : '';
    $dec = json_decode($raw, true);
    if (!is_array($dec) || !isset($dec['sections'])) wp_send_json_error('Dữ liệu không hợp lệ.');
    set_transient('tnl_studio_prev_' . $post_id, wp_json_encode(array('sections' => $dec['sections']), JSON_UNESCAPED_UNICODE), HOUR_IN_SECONDS);
    wp_send_json_success(array(
        'preview' => add_query_arg(array('preview' => 'true', 'tnl_preview' => '1', 'ts' => time()), get_permalink($post_id)),
    ));
});

/* Front-end: ?tnl_preview=1 (user co quyen) -> render ban nhap tu transient thay post_content */
add_filter('the_content', function ($content) {
    if (!isset($_GET['tnl_preview']) || !is_page() || !current_user_can('edit_pages')) return $content;
    $pid = get_the_ID();
    $raw = get_transient('tnl_studio_prev_' . $pid);
    if (!$raw) return $content;
    $dec = json_decode($raw, true);
    if (!is_array($dec) || !isset($dec['sections'])) return $content;
    // Tra ve block markup o priority 0 -> do_blocks/shortcode chay sau se xu ly
    // $editable=true: day la duong preview cua Studio (chi nguoi co quyen edit_pages thay) -> danh dau canvas de sua truc tiep.
    return tnl_studio_compose($dec['sections'], true);
}, 0);

/* Canvas sua truc tiep (kieu Elementor): CHI nap studio-canvas.js khi dang xem khung
 * preview cua Landing Studio (?tnl_preview=1 + nguoi co quyen edit_pages). KHONG BAO GIO
 * nap cho khach xem trang that - script vo hai (chi doc data-tnls-* attribute) nhung
 * khong can thiet phai tai cho khach. */
add_action('wp_enqueue_scripts', function () {
    if (!isset($_GET['tnl_preview']) || !current_user_can('edit_pages')) return;
    $dir = get_template_directory();
    $uri = get_template_directory_uri();
    wp_enqueue_media();
    wp_enqueue_style('tnl-studio-canvas', $uri . '/assets/studio-canvas.css', array(), @filemtime($dir . '/assets/studio-canvas.css') ?: '1');
    wp_enqueue_script('tnl-studio-canvas', $uri . '/assets/studio-canvas.js', array(), @filemtime($dir . '/assets/studio-canvas.js') ?: '1', true);
}, 30);

/* Trang/bai viet dung Studio: them row action trong danh sach Pages/Posts */
function tnl_studio_row_action($actions, $post) {
    if (in_array($post->post_type, array('page', 'post'), true) && get_post_meta($post->ID, '_tnl_studio_data', true) && current_user_can('edit_pages')) {
        $actions['tnl_studio'] = '<a href="' . esc_url(admin_url('admin.php?page=tnl-studio&post=' . $post->ID)) . '">Mở Landing Studio</a>';
    }
    return $actions;
}
add_filter('page_row_actions', 'tnl_studio_row_action', 10, 2);
add_filter('post_row_actions', 'tnl_studio_row_action', 10, 2);

/* ============================================================
 * 6. "PAGE-SHELL" - Landing Studio cho các trang CLONE MODE có sẵn
 *    (contact/newsletter/careers...) - giữ NGUYÊN header/footer/nav
 *    thật của từng trang (không dùng page-templates/landing.php +
 *    header.php cũ), lấy trực tiếp từ chính file clone của trang đó.
 * ============================================================ */

/* Tách nav (+ style nprogress) và "chân trang" (footer, có thể kèm dải
 * đăng ký newsletter) từ 1 file clone gốc. Trả null nếu không tách được. */
function tnl_studio_page_shell($slug, $lang) {
    $file = function_exists('tnl_clone_has') ? tnl_clone_has($slug) : false;
    if (!$file) return null;
    $html = file_get_contents($file);
    if (!preg_match('/^(<nav\b.*?<\/nav>)(<style>.*?<\/style>)?/s', $html, $m)) return null;
    $head = $m[0];
    $rest = substr($html, strlen($head));
    // Diem bat dau "chan trang": uu tien dai CTA newsletter (id=newsletter-section) neu co,
    // fallback footer nen toi bg-[#101010] (xuat hien dung 1 lan, moi trang deu co).
    $foot_at = false;
    if (preg_match('/<div[^>]*\bid="newsletter-section"[^>]*>/', $rest, $mf, PREG_OFFSET_CAPTURE)) {
        $foot_at = $mf[0][1];
    } elseif (preg_match('/<div[^>]*\bbg-\[#101010\][^"]*"[^>]*>/', $rest, $mf, PREG_OFFSET_CAPTURE)) {
        $foot_at = $mf[0][1];
    }
    if ($foot_at === false) return null;
    return array('head' => $head, 'foot' => substr($rest, $foot_at));
}

/* Render 1 WP Page (post_type=page) đã dùng Landing Studio NHƯNG slug trùng 1 trang
 * clone-mode có sẵn -> ghép: nav+footer THẬT của trang đó + nội dung Studio ở giữa. */
function tnl_studio_render_clone_page($post) {
    $slug = $post->post_name;
    $lang = function_exists('tnl_clone_lang') ? tnl_clone_lang() : 'vi';
    $shell = tnl_studio_page_shell($slug, $lang);
    if (!$shell) return false;

    $sections_json = get_post_meta($post->ID, '_tnl_studio_data', true);
    $is_preview = isset($_GET['tnl_preview']) && current_user_can('edit_pages');
    $sections = array();
    if ($is_preview) {
        $raw_prev = get_transient('tnl_studio_prev_' . $post->ID);
        if ($raw_prev) {
            $dec = json_decode($raw_prev, true);
            if (is_array($dec) && isset($dec['sections'])) $sections = $dec['sections'];
        }
    }
    if (!$sections) {
        $dec = json_decode($sections_json, true);
        if (is_array($dec) && isset($dec['sections'])) $sections = $dec['sections'];
    }
    // $editable=true chi khi dang xem preview cua Studio (nguoi co quyen) -> danh dau canvas de sua truc tiep.
    $body = tnl_studio_compose($sections, $is_preview);
    $body = apply_filters('the_content', $body);

    $dir = get_template_directory();
    $uri = get_template_directory_uri();
    add_action('wp_head', function () use ($dir, $uri) {
        echo '<link rel="stylesheet" href="' . esc_url($uri . '/assets/landing.css?v=' . (@filemtime($dir . '/assets/landing.css') ?: '1')) . '">';
    }, 5);

    $html = $shell['head'] . '<div class="tnl-landing">' . $body . '</div>' . $shell['foot'];
    // Slug rieng cho body class ("studio-<slug>") de KHONG dinh CSS scope rieng cua trang goc
    // (vd .tnl-page-careers) - tranh xung dot voi khoi Landing Studio dung class khac.
    if (function_exists('tnl_clone_emit')) return tnl_clone_emit($html, 'studio-' . $slug);
    echo $html; return true;
}
