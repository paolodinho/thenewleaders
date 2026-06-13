#!/usr/bin/env python3
# Dựng trang chi tiết (events/blog/courses) từ clone/parts/detail/ -> docs/{lang}/{type}/{slug}/index.html
import os,glob,re,json
REPO="/Users/dohieu/thenewleaders-site"
# Tham số hoá để dùng cho cả v1 và v2 (env override)
THEME=os.environ.get("TNL_THEME","/Users/dohieu/Local Sites/thenewleaders/app/public/wp-content/themes/thenewleaders")
PREFIX=os.environ.get("TNL_PREFIX","/thenewleaders")
DOCS=os.environ.get("TNL_DOCS",REPO+"/docs")
CLONE=PREFIX+"/wp-content/themes/thenewleaders/clone"
s3='bucketeer-4deb826f-734a-4fe9-b45f-0e12646315fb.s3.eu-west-1.amazonaws.com'
def ver(p):
    try: return str(int(os.path.getmtime(p)))
    except: return '1'
cssv=ver(THEME+"/clone/css/live.css"); jsv=ver(THEME+"/clone/js/clone.js")
optv=ver(THEME+"/clone/css/optimize.css") if os.path.exists(THEME+"/clone/css/optimize.css") else None
titles={}
tj=THEME+"/clone/parts/detail/titles.json"
if os.path.exists(tj):
    try: titles=json.load(open(tj))
    except: titles={}
def esc(s): return (s or '').replace('&','&amp;').replace('<','&lt;').replace('>','&gt;')
n=0
for f in glob.glob(THEME+"/clone/parts/detail/*/*.html"):
    m=re.match(r'.*/detail/([^/]+)/(.+)-(vi|en)\.html$', f)
    if not m: continue
    type_,slug,lang=m.group(1),m.group(2),m.group(3)
    body=open(f,encoding='utf-8',errors='ignore').read()
    body=body.replace('="images/','="'+CLONE+'/images/').replace('../'+s3+'/','https://'+s3+'/')
    t=titles.get(f"{lang}/{type_}/{slug}") or "The New Leaders"
    out=f"{DOCS}/{lang}/{type_}/{slug}/index.html"
    os.makedirs(os.path.dirname(out),exist_ok=True)
    optlink=('<link rel="stylesheet" href="%s/css/optimize.css?v=%s">'%(CLONE,optv)) if optv else ''
    optcls='tnl-opt'+(' tnl-opt-events' if type_=='events' else '')
    bodytag=('<body class="%s">'%optcls) if optv else '<body>'
    doc=('<!DOCTYPE html><html lang="%s"><head><meta charset="utf-8">'
         '<meta name="viewport" content="width=device-width, initial-scale=1.0">'
         '<title>%s</title>'
         '<link rel="stylesheet" href="%s/css/live.css?v=%s">%s</head>%s%s'
         '<script src="%s/js/clone.js?v=%s"></script></body></html>') % (lang,esc(t),CLONE,cssv,optlink,bodytag,body,CLONE,jsv)
    open(out,'w').write(doc)
    n+=1
print("generated detail pages:",n)
