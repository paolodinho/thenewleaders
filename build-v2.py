#!/usr/bin/env python3
# Đóng gói demo v2 (optimize layer) từ docs/{vi,en} -> docs/v2/{vi,en}
# Mỗi trang: chèn <link optimize.css> sau live.css + thêm class body clone-opt.
# Asset (css/js/images) DÙNG CHUNG tại /thenewleaders/... (không nhân đôi).
import os,glob,re,shutil
REPO="/Users/dohieu/thenewleaders-site"
DOCS=REPO+"/docs"
V2=DOCS+"/v2"
THEME="/Users/dohieu/Local Sites/thenewleaders/app/public/wp-content/themes/thenewleaders"
OPT="/thenewleaders/wp-content/themes/thenewleaders/clone/css/optimize.css"
def ver(p):
    try: return str(int(os.path.getmtime(p)))
    except: return '1'
optv=ver(THEME+"/clone/css/optimize.css")
optlink='<link rel="stylesheet" href="%s?v=%s">'%(OPT,optv)
if os.path.isdir(V2): shutil.rmtree(V2)
n=0
for lang in ['vi','en']:
    src=os.path.join(DOCS,lang)
    if not os.path.isdir(src): continue
    for f in glob.glob(src+"/**/index.html",recursive=True):
        rel=os.path.relpath(f,DOCS)            # vi/..../index.html
        out=os.path.join(V2,rel)
        os.makedirs(os.path.dirname(out),exist_ok=True)
        html=open(f,encoding='utf-8',errors='ignore').read()
        # chèn optimize.css sau live.css link (1 lần)
        if 'optimize.css' not in html:
            html=re.sub(r'(<link[^>]*live\.css[^>]*>)', r'\1'+optlink, html, count=1)
            if 'optimize.css' not in html:  # fallback: chèn trước </head>
                html=html.replace('</head>', optlink+'</head>',1)
        # thêm class body
        cls='clone-opt'
        if '/events/' in rel.replace(os.sep,'/'): cls+=' clone-opt-events'
        if re.search(r'<body[^>]*\bclass="', html):
            html=re.sub(r'(<body[^>]*\bclass=")', r'\1'+cls+' ', html, count=1)
        else:
            html=re.sub(r'<body', '<body class="'+cls+'"', html, count=1)
        open(out,'w').write(html)
        n+=1
print("v2 pages:",n)
