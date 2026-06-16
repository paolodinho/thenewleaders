#!/usr/bin/env python3
# Post-process HTML tĩnh để tăng tốc tải & Core Web Vitals (idempotent).
# - Lazy-load + decoding=async cho ảnh raster (png/jpg/jpeg/webp/gif) DƯỚI màn.
#   Giữ EAGER ảnh raster ĐẦU TIÊN mỗi trang (thường là LCP/hero) để không hại LCP.
# - Preconnect + dns-prefetch tới host ảnh/video (S3 bucketeer) trong <head>.
# Chạy: python3 optimize-static.py <thư-mục> [<thư-mục>...]
import re, sys, os
from urllib.parse import unquote

S3 = "https://bucketeer-4deb826f-734a-4fe9-b45f-0e12646315fb.s3.eu-west-1.amazonaws.com"
LIVE = "https://www.thenewleaders.asia"

NEXT_IMG = re.compile(r'/_next/image\?url=([^&"\']+)[^"\']*', re.I)
HEAD_BLOCK = (
    '<!--tnl-perf-->'
    '<link rel="preconnect" href="%s" crossorigin>'
    '<link rel="dns-prefetch" href="%s">' % (S3, S3)
)
RASTER = re.compile(r'\.(png|jpe?g|webp|gif)(\?|#|$)', re.I)
IMG = re.compile(r'<img\b[^>]*>', re.I)

def fix_next_image(m):
    path = unquote(m.group(1))
    return LIVE + path

def process(html):
    # 0) Fix /_next/image?url=... → live site direct URL
    html = NEXT_IMG.sub(fix_next_image, html)

    # 1) head: preconnect (1 lần)
    if '<!--tnl-perf-->' not in html and '</head>' in html:
        html = html.replace('</head>', HEAD_BLOCK + '</head>', 1)

    # 2) lazy ảnh raster, eager ảnh đầu tiên
    state = {'first_raster_seen': False}
    def repl(m):
        tag = m.group(0)
        if re.search(r'\bloading\s*=', tag, re.I):   # đã có loading -> bỏ qua
            return tag
        src = re.search(r'\bsrc\s*=\s*"([^"]*)"', tag, re.I)
        if not src or not RASTER.search(src.group(1)):
            return tag                               # svg/không phải raster -> bỏ qua
        if not state['first_raster_seen']:
            state['first_raster_seen'] = True
            # ảnh đầu: eager + ưu tiên tải (LCP), chỉ thêm decoding async
            add = ' decoding="async" fetchpriority="high"'
        else:
            add = ' loading="lazy" decoding="async"'
        return '<img' + add + tag[4:]
    html = IMG.sub(repl, html)
    return html

def main(dirs):
    n = 0
    for d in dirs:
        for root, _, files in os.walk(d):
            for fn in files:
                if not fn.endswith('.html'):
                    continue
                p = os.path.join(root, fn)
                try:
                    s = open(p, encoding='utf-8').read()
                except Exception:
                    continue
                out = process(s)
                if out != s:
                    open(p, 'w', encoding='utf-8').write(out)
                    n += 1
    print('optimized files:', n)

if __name__ == '__main__':
    main(sys.argv[1:] or ['docs'])
