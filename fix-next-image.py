#!/usr/bin/env python3
# Đổi tham chiếu Next.js image optimizer (/_next/image?url=%2Fimages%2F...) -> path ảnh thật.
# Dùng: python3 fix-next-image.py <prefix> <file1> [file2 ...]
#   prefix = chuỗi đặt trước path (vd "images" cho parts; hoặc đường dẫn clone tuyệt đối cho docs)
# Bỏ luôn srcset chứa _next/image (tránh path tương đối sai trong srcset).
import sys, re, urllib.parse

prefix = sys.argv[1].rstrip('/')
files = sys.argv[2:]

# /_next/image?url=%2Fimages%2Flogos%2Fcornell.png&amp;w=1920&amp;q=75  (hoặc &)
SRC = re.compile(r'/_next/image\?url=(%2F[^&"\s]+?)(?:&amp;|&)w=\d+(?:&amp;|&)q=\d+')
# srcset="...có _next/image..."
SRCSET = re.compile(r'\s*srcset="[^"]*_next/image[^"]*"')

def target(m):
    dec = urllib.parse.unquote(m.group(1)).lstrip('/')   # images/logos/cornell.png
    return (prefix + '/' + dec) if prefix else dec        # <prefix>/images/... hoặc images/...

n = 0
for f in files:
    s = open(f, encoding='utf-8').read()
    o = SRCSET.sub('', s)
    o = SRC.sub(target, o)
    if o != s:
        open(f, 'w', encoding='utf-8').write(o)
        n += 1
print('rewritten files:', n, '| prefix:', prefix)
