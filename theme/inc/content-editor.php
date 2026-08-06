<?php
/**
 * CONTENT EDITOR - The New Leaders (ĐỘNG)
 * Sửa nội dung trang CLONE bằng field chia theo section, GIỮ NGUYÊN giao diện.
 * Nguồn sự thật = các marker data-tnl-field="key" trong clone/parts/{slug}-{lang}.html.
 * -> Thêm/bớt TRANG (file clone) hoặc SECTION (marker) đều TỰ ĐỘNG hiện/ẩn ở đây.
 * Giá trị lưu ở option tnl_content[slug][lang][key]. Song ngữ VI/EN riêng.
 */

if (!defined('ABSPATH')) exit;

function tnl_content_langs() { return array('vi' => 'Tiếng Việt', 'en' => 'English'); }
function tnl_ce_file($slug, $lang) { return get_template_directory() . "/clone/parts/{$slug}-{$lang}.html"; }

/* Nhãn trang song ngữ: array('en'=>.., 'vi'=>..). Brand name giống nhau -> en=vi. */
function tnl_ce_page_names($slug) {
    $map = array(
        'home'               => array('Home', 'Trang chủ'),
        'our-services'       => array('Services & Products', 'Dịch vụ & Sản phẩm'),
        'products'           => array('Products', 'Sản phẩm'),
        'contact'            => array('Contact', 'Liên hệ'),
        'newsletter'         => array('Newsletter', 'Bản tin'),
        'executive-coach'    => array('Executive Coaching', 'Coaching cho lãnh đạo'),
        'individual-courses' => array('Individual Courses', 'Khoá cá nhân'),
        'for-manager'        => array('For Managers', 'Dành cho Quản lý'),
        'for-team-member'    => array('For Team Members', 'Dành cho Đội nhóm'),
        'eq-quiz'            => array('EQ Quiz', 'EQ Quiz'),
        'eq-with-ngan-tran'  => array('EQ with Ngân Trần', 'EQ cùng Ngân Trần'),
        'tet-gift-box'       => array('Tet Gift Box', 'Hộp quà Tết'),
        // Tên sản phẩm/chương trình (brand) - giữ nguyên 2 ngôn ngữ.
        'the-eq-calendar'    => array('The EQ Calendar', 'The EQ Calendar'),
        'vision-craft'       => array('Vision Craft', 'Vision Craft'),
        'the-story-of-empathy' => array('The Story of Empathy', 'The Story of Empathy'),
        'seli-strategic-eq-leadership-index' => array('SELI Index', 'SELI Index'),
        'heart-heart-hand'   => array('Heart to Heart & Hand', 'Heart to Heart & Hand'),
        'hlmays'             => array('HLMAYS', 'HLMAYS'),
        'lgad'               => array('LGAD', 'LGAD'),
    );
    if (isset($map[$slug])) return array('en' => $map[$slug][0], 'vi' => $map[$slug][1]);
    $g = ucwords(str_replace('-', ' ', $slug));
    return array('en' => $g, 'vi' => $g);
}
/* Nhãn 1 dòng (khi cần chuỗi đơn) - lấy bản Việt. */
function tnl_ce_page_label($slug) {
    $n = tnl_ce_page_names($slug);
    return $n['vi'];
}

/* Suy vai trò + kiểu field từ tên key. */
function tnl_ce_role($key) {
    if (preg_match('/_(title|heading)$/', $key)) return array('role' => 'title', 'type' => 'text',     'label' => 'Tiêu đề');
    if (preg_match('/_body$/', $key))            return array('role' => 'body',  'type' => 'textarea', 'label' => 'Nội dung');
    if (preg_match('/_(img|image)$/', $key))     return array('role' => 'img',   'type' => 'image',    'label' => 'Ảnh');
    return array('role' => 'title', 'type' => 'text', 'label' => 'Nội dung');
}
/* Nhóm section = phần trước hậu tố (_title/_heading/_body/_img). */
function tnl_ce_section_key($key) {
    return preg_replace('/_(title|heading|body|img|image)$/', '', $key);
}

/* Đọc nội dung GỐC của 1 marker từ file clone. */
function tnl_ce_original($slug, $lang, $key, $type) {
    $file = tnl_ce_file($slug, $lang);
    if (!is_readable($file)) return '';
    $html = file_get_contents($file);
    $k = preg_quote($key, '/');
    if ($type === 'image') {
        if (preg_match('/<img\b[^>]*\bdata-tnl-field="' . $k . '"[^>]*>/i', $html, $m)
            && preg_match('/\ssrc="([^"]*)"/i', $m[0], $s)) return $s[1];
        return '';
    }
    if (preg_match('/<([a-z0-9]+)\b[^>]*\bdata-tnl-field="' . $k . '"[^>]*>(.*?)<\/\1>/is', $html, $m)) {
        return trim(html_entity_decode(wp_strip_all_tags($m[2]), ENT_QUOTES, 'UTF-8'));
    }
    return '';
}

/* Quét marker của 1 trang (từ file EN, theo thứ tự) -> cấu trúc section. */
function tnl_ce_scan($slug) {
    $file = tnl_ce_file($slug, 'en');
    if (!is_readable($file)) return array();
    $html = file_get_contents($file);
    if (!preg_match_all('/data-tnl-field="([a-z0-9_]+)"/i', $html, $mm)) return array();

    $sections = array(); $seen = array();
    foreach ($mm[1] as $key) {
        if (isset($seen[$key])) continue; $seen[$key] = 1;
        $sec = tnl_ce_section_key($key);
        $r   = tnl_ce_role($key);
        if (!isset($sections[$sec])) $sections[$sec] = array('label' => '', 'fields' => array());
        $sections[$sec]['fields'][$key] = array('type' => $r['type'], 'label' => $r['label'], 'role' => $r['role']);
    }
    // Nhãn section = chữ tiêu đề trong section (ưu tiên tiếng Việt, thiếu thì lấy EN).
    foreach ($sections as $sec => &$data) {
        foreach ($data['fields'] as $key => $f) {
            if ($f['role'] === 'title') {
                $lbl = tnl_ce_original($slug, 'vi', $key, 'text');
                if ($lbl === '') $lbl = tnl_ce_original($slug, 'en', $key, 'text');
                $lbl = trim(preg_replace('/\s+/', ' ', $lbl));       // gộp xuống dòng/space thừa
                if (mb_strlen($lbl) > 60) $lbl = mb_strimwidth($lbl, 0, 60, '…'); // rút gọn cho gọn hàng
                $data['label'] = $lbl;
                break;
            }
        }
        if ($data['label'] === '') $data['label'] = $sec;
    }
    unset($data);
    return $sections;
}

/* Danh sách trang có marker (quét thư mục). */
function tnl_ce_pages() {
    $out = array();
    foreach (glob(get_template_directory() . '/clone/parts/*-en.html') as $file) {
        $base = basename($file, '-en.html');
        if (strpos(file_get_contents($file), 'data-tnl-field=') !== false) {
            $out[$base] = tnl_ce_page_label($base);
        }
    }
    // Trang chủ lên đầu.
    if (isset($out['home'])) { $home = array('home' => $out['home']); unset($out['home']); $out = $home + $out; }
    return $out;
}

/* Toàn bộ field (phẳng) của 1 trang. */
function tnl_ce_fields($slug) {
    $out = array();
    foreach (tnl_ce_scan($slug) as $sec) foreach ($sec['fields'] as $k => $f) $out[$k] = $f;
    return $out;
}

function tnl_content_values($slug, $lang) {
    $all = get_option('tnl_content', array());
    return (isset($all[$slug][$lang]) && is_array($all[$slug][$lang])) ? $all[$slug][$lang] : array();
}

/* ------------------------------------------------------------
 * RENDERER - áp mọi marker có giá trị đã lưu (hoàn toàn động).
 * ------------------------------------------------------------ */
add_filter('tnl_clone_markup', 'tnl_content_apply', 10, 3);
function tnl_content_apply($markup, $slug = '', $lang = '') {
    if ($slug === '') return $markup;
    $vals = tnl_content_values($slug, $lang);
    if (!$vals) return $markup;

    foreach ($vals as $key => $v) {
        if ($v === '') continue;
        $r = tnl_ce_role($key);
        $k = preg_quote($key, '/');
        if ($r['type'] === 'image') {
            $markup = preg_replace_callback('/<img\b[^>]*\bdata-tnl-field="' . $k . '"[^>]*>/i', function ($m) use ($v) {
                $t = preg_replace('/\ssrcset="[^"]*"/i', '', $m[0]);
                $t = preg_replace('/\ssizes="[^"]*"/i', '', $t);
                if (preg_match('/\ssrc="[^"]*"/i', $t)) $t = preg_replace('/\ssrc="[^"]*"/i', ' src="' . esc_url($v) . '"', $t, 1);
                else $t = preg_replace('/<img\b/i', '<img src="' . esc_url($v) . '"', $t, 1);
                return $t;
            }, $markup, 1);
        } else {
            $markup = preg_replace_callback('/(<([a-z0-9]+)\b[^>]*\bdata-tnl-field="' . $k . '"[^>]*>)(.*?)(<\/\2>)/is', function ($m) use ($r, $v) {
                $c = ($r['type'] === 'textarea') ? nl2br(esc_html($v)) : esc_html($v);
                return $m[1] . $c . $m[4];
            }, $markup, 1);
        }
    }
    return $markup;
}

/* ------------------------------------------------------------
 * TỰ ĐỘNG NHẬN DIỆN - chèn marker cho trang chưa/mới có nội dung.
 * Bổ sung (additive): chỉ đánh dấu heading/đoạn CHƯA được đánh dấu.
 * ------------------------------------------------------------ */
function tnl_automark_page($slug) {
    $fe = tnl_ce_file($slug, 'en'); $fv = tnl_ce_file($slug, 'vi');
    if (!is_readable($fe)) return 0;
    $en = file_get_contents($fe);
    $vi = is_readable($fv) ? file_get_contents($fv) : '';

    $cands = function ($html) {
        $hs = array();
        if (preg_match_all('/<(h[12])\b[^>]*>(.*?)<\/\1>/is', $html, $m, PREG_OFFSET_CAPTURE)) {
            $n = count($m[0]);
            for ($i = 0; $i < $n; $i++) {
                $full = $m[0][$i][0]; $off = $m[0][$i][1]; $inner = $m[2][$i][0];
                if (strpos($inner, '<') !== false) continue;
                $txt = trim(preg_replace('/\s+/', ' ', wp_strip_all_tags($inner)));
                if (mb_strlen($txt) < 3 || mb_strlen($txt) > 90) continue;
                $already = (strpos($full, 'data-tnl-field') !== false);
                // vị trí '>' đóng thẻ mở heading = off + (độ dài tới inner)
                $gt = strpos($html, '>', $off);
                $end = $off + strlen($full);
                // body: <p> sạch kế tiếp
                $body = null;
                if (preg_match('/<p\b[^>]*>(.*?)<\/p>/is', substr($html, $end, 900), $pm, PREG_OFFSET_CAPTURE)) {
                    if (strpos($pm[1][0], '<') === false && mb_strlen(trim($pm[1][0])) >= 25) {
                        $body = $end + strpos(substr($html, $end), '>', $pm[0][1]);
                    }
                }
                $hs[] = array('gt' => $gt, 'already' => $already, 'body' => $body, 'full' => $full);
            }
        }
        return $hs;
    };
    $ce = $cands($en); $cv = $cands($vi);

    // chỉ số section kế tiếp
    $max = 0;
    if (preg_match_all('/data-tnl-field="sec(\d+)_/', $en, $mn)) $max = max(array_map('intval', $mn[1]));

    $ins_en = array(); $ins_vi = array(); $added = 0;
    foreach ($ce as $i => $c) {
        if ($c['already']) continue;             // đã đánh dấu -> bỏ qua (additive)
        $max++; $key = 'sec' . $max;
        $ins_en[] = array($c['gt'], ' data-tnl-field="' . $key . '_title"');
        $hasvi = isset($cv[$i]) && !$cv[$i]['already'];
        if ($hasvi) $ins_vi[] = array($cv[$i]['gt'], ' data-tnl-field="' . $key . '_title"');
        if ($c['body'] && (!$hasvi || $cv[$i]['body'])) {
            $ins_en[] = array($c['body'], ' data-tnl-field="' . $key . '_body"');
            if ($hasvi && $cv[$i]['body']) $ins_vi[] = array($cv[$i]['body'], ' data-tnl-field="' . $key . '_body"');
        }
        $added++;
    }
    $apply = function ($html, $ins) {
        usort($ins, function ($a, $b) { return $b[0] - $a[0]; });
        foreach ($ins as $x) $html = substr($html, 0, $x[0]) . $x[1] . substr($html, $x[0]);
        return $html;
    };
    if ($ins_en) file_put_contents($fe, $apply($en, $ins_en));
    if ($ins_vi && $vi !== '') file_put_contents($fv, $apply($vi, $ins_vi));
    return $added;
}

/* ------------------------------------------------------------
 * ADMIN
 * ------------------------------------------------------------ */
add_action('admin_menu', function () {
    add_menu_page('Nội dung trang', 'Nội dung trang', 'edit_pages', 'tnl-content', 'tnl_content_admin_page', 'dashicons-edit-page', 25);
});

add_action('admin_init', function () {
    if (!current_user_can('edit_pages')) return;

    // Lưu nội dung
    if (!empty($_POST['tnl_content_save'])) {
        check_admin_referer('tnl_content_save');
        $slug = isset($_POST['slug']) ? sanitize_key($_POST['slug']) : '';
        $fields = tnl_ce_fields($slug);
        if ($fields) {
            $all = get_option('tnl_content', array());
            foreach (tnl_content_langs() as $lang => $_l) {
                foreach ($fields as $key => $f) {
                    $raw  = isset($_POST['f'][$lang][$key]) ? wp_unslash($_POST['f'][$lang][$key]) : '';
                    $orig = tnl_ce_original($slug, $lang, $key, $f['type']);
                    if ($f['type'] === 'image')        $val = esc_url_raw(trim($raw));
                    elseif ($f['type'] === 'textarea') $val = sanitize_textarea_field($raw);
                    else                               $val = sanitize_text_field($raw);
                    if ($val === '' || $val === $orig) unset($all[$slug][$lang][$key]);
                    else $all[$slug][$lang][$key] = $val;
                }
                if (empty($all[$slug][$lang])) unset($all[$slug][$lang]);
            }
            if (empty($all[$slug])) unset($all[$slug]);
            update_option('tnl_content', $all, false);
            if (function_exists('tnl_purge_litespeed')) tnl_purge_litespeed();
            add_action('admin_notices', function () { echo '<div class="notice notice-success is-dismissible"><p>Đã lưu nội dung.</p></div>'; });
        }
    }

    // Tự động nhận diện nội dung cho 1 trang
    if (!empty($_POST['tnl_automark'])) {
        check_admin_referer('tnl_automark');
        $slug = isset($_POST['slug']) ? sanitize_key($_POST['slug']) : '';
        $n = $slug ? tnl_automark_page($slug) : 0;
        add_action('admin_notices', function () use ($n) {
            echo '<div class="notice notice-success is-dismissible"><p>Đã nhận diện thêm ' . intval($n) . ' mục nội dung.</p></div>';
        });
    }
});

add_action('admin_enqueue_scripts', function ($hook) {
    if ($hook === 'toplevel_page_tnl-content') wp_enqueue_media();
});

function tnl_content_field_row($slug, $key, $f) {
    foreach (tnl_content_langs() as $lang => $lname) :
        $orig = tnl_ce_original($slug, $lang, $key, $f['type']);
        $saved = tnl_content_values($slug, $lang);
        $cur = isset($saved[$key]) ? $saved[$key] : '';
    ?>
      <tr>
        <th scope="row" style="width:200px;">
          <label style="font-weight:600;"><?php echo esc_html($f['label']); ?></label>
          <span style="display:block;font-weight:400;color:#FF4F21;font-size:12px;margin-top:3px;"><?php echo esc_html($lname); ?></span>
        </th>
        <td>
          <?php if ($f['type'] === 'image') : $val = $cur !== '' ? $cur : $orig; ?>
            <div class="tnl-imgfield">
              <img src="<?php echo esc_url($val); ?>" style="max-width:220px;max-height:130px;border:1px solid #ddd;border-radius:6px;display:<?php echo $val ? 'block' : 'none'; ?>;margin-bottom:8px;" class="tnl-imgprev">
              <input type="hidden" name="f[<?php echo esc_attr($lang); ?>][<?php echo esc_attr($key); ?>]" value="<?php echo esc_attr($cur); ?>" class="tnl-imgval">
              <button type="button" class="button tnl-imgpick">Chọn / tải ảnh</button>
              <span style="color:#888;font-size:12px;margin-left:8px;">JPG/PNG/WebP · &lt; 500KB</span>
            </div>
          <?php elseif ($f['type'] === 'textarea') : ?>
            <textarea name="f[<?php echo esc_attr($lang); ?>][<?php echo esc_attr($key); ?>]" rows="2" class="large-text" placeholder="<?php echo esc_attr($orig); ?>"><?php echo esc_textarea($cur); ?></textarea>
          <?php else : ?>
            <input type="text" name="f[<?php echo esc_attr($lang); ?>][<?php echo esc_attr($key); ?>]" style="width:100%;max-width:640px;" value="<?php echo esc_attr($cur); ?>" placeholder="<?php echo esc_attr($orig); ?>">
          <?php endif; ?>
          <?php if ($orig !== '' && $f['type'] !== 'image') : ?>
            <p style="color:#999;font-size:12px;margin:6px 0 0;">Gốc: <?php echo esc_html(mb_strimwidth($orig, 0, 90, '…')); ?></p>
          <?php endif; ?>
        </td>
      </tr>
    <?php endforeach;
}

function tnl_content_admin_page() {
    $pages = tnl_ce_pages();
    if (!$pages) { echo '<div class="wrap"><h1>Nội dung trang</h1><p>Chưa có trang nào được nhận diện.</p></div>'; return; }
    $slug = isset($_GET['slug']) && isset($pages[$_GET['slug']]) ? sanitize_key($_GET['slug']) : array_key_first($pages);
    $sections = tnl_ce_scan($slug);
    ?>
    <div class="wrap">
      <h1 style="display:flex;align-items:center;gap:10px;">Nội dung trang
        <span style="font-size:13px;color:#666;font-weight:400;">- sửa nội dung, giữ nguyên giao diện</span></h1>

      <div class="tnl-tabs" style="display:flex;flex-wrap:wrap;gap:8px;margin:16px 0 0;">
        <?php foreach ($pages as $s => $lbl) :
            $nm = tnl_ce_page_names($s); $same = ($nm['en'] === $nm['vi']); $on = ($s === $slug); ?>
          <a href="<?php echo esc_url(admin_url('admin.php?page=tnl-content&slug=' . $s)); ?>"
             style="display:flex;flex-direction:column;align-items:center;justify-content:center;min-height:52px;padding:6px 14px;border-radius:8px;text-decoration:none;line-height:1.25;text-align:center;box-sizing:border-box;border:1px solid <?php echo $on ? '#FF4F21' : '#dcdcde'; ?>;background:<?php echo $on ? '#FF4F21' : '#fff'; ?>;box-shadow:0 1px 2px rgba(0,0,0,.04);">
            <span style="display:block;font-size:11px;font-weight:400;color:<?php echo $on ? 'rgba(255,255,255,.85)' : '#8a8a8a'; ?>;"><?php echo esc_html($same ? "\xC2\xA0" : $nm['en']); ?></span>
            <span style="display:block;font-size:14px;font-weight:600;color:<?php echo $on ? '#fff' : '#1d1d1d'; ?>;"><?php echo esc_html($nm['vi']); ?></span>
          </a>
        <?php endforeach; ?>
      </div>

      <p style="color:#555;background:#FFF4F0;border-left:4px solid #FF4F21;padding:10px 14px;border-radius:6px;max-width:1000px;margin-top:16px;">
        Mỗi thẻ dưới là một <b>khối nội dung có chữ sửa được</b> trên trang (đặt tên theo tiêu đề khối).
        Các khối chỉ có ảnh/video (vd banner video đầu trang) không hiện ở đây vì không có chữ để gõ.
        Ô đã hiện sẵn chữ đang chạy - sửa rồi bấm Lưu. Để trống = giữ gốc. VI/EN sửa riêng.
        Trang/khối <b>tự cập nhật</b> theo giao diện: thêm trang hoặc khối chữ mới sẽ hiện ở đây.
      </p>

      <?php if (!$sections) : ?>
        <div style="background:#fff;border:1px solid #e2e4e7;border-radius:10px;padding:20px;max-width:1000px;">
          <p>Trang này chưa có mục nào để sửa. Bấm nút dưới để tự động nhận diện tiêu đề/nội dung.</p>
          <form method="post"><?php wp_nonce_field('tnl_automark'); ?>
            <input type="hidden" name="slug" value="<?php echo esc_attr($slug); ?>">
            <button type="submit" name="tnl_automark" value="1" class="button button-primary">Tự động nhận diện nội dung</button>
          </form>
        </div>
      <?php else : ?>
      <form method="post" style="max-width:1000px;margin-top:16px;">
        <?php wp_nonce_field('tnl_content_save'); ?>
        <input type="hidden" name="slug" value="<?php echo esc_attr($slug); ?>">
        <?php foreach ($sections as $sec) : ?>
          <div style="background:#fff;border:1px solid #e2e4e7;border-radius:10px;padding:6px 20px 10px;margin:0 0 18px;box-shadow:0 1px 2px rgba(0,0,0,.04);">
            <h2 style="border-bottom:2px solid #FF4F21;padding:12px 0 10px;margin:0 0 6px;font-size:16px;display:flex;align-items:center;gap:8px;">
              <span style="width:8px;height:8px;border-radius:50%;background:#FF4F21;flex:none;"></span>
              <?php echo esc_html($sec['label']); ?>
            </h2>
            <table class="form-table" role="presentation"><tbody>
              <?php foreach ($sec['fields'] as $key => $f) tnl_content_field_row($slug, $key, $f); ?>
            </tbody></table>
          </div>
        <?php endforeach; ?>
        <p style="display:flex;gap:12px;align-items:center;">
          <button type="submit" name="tnl_content_save" value="1" class="button button-primary button-large">Lưu nội dung</button>
          <button type="submit" name="tnl_automark" value="1" class="button" title="Quét lại giao diện để thêm mục mới (không xoá mục cũ)" formnovalidate>Nhận diện mục mới</button>
        </p>
      </form>
      <?php endif; ?>
    </div>

    <script>
    jQuery(function ($) {
      $('.tnl-imgpick').on('click', function (e) {
        e.preventDefault();
        var wrap = $(this).closest('.tnl-imgfield');
        var frame = wp.media({ title: 'Chọn ảnh', button: { text: 'Dùng ảnh này' }, multiple: false });
        frame.on('select', function () {
          var a = frame.state().get('selection').first().toJSON();
          wrap.find('.tnl-imgval').val(a.url);
          wrap.find('.tnl-imgprev').attr('src', a.url).show();
        });
        frame.open();
      });
    });
    </script>
    <?php
}
