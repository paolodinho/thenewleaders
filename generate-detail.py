#!/usr/bin/env python3
# Dựng các trang chi tiết (events/blog/courses) từ clone/parts/detail/ -> docs/{lang}/{type}/{slug}/index.html
import os,glob,re,sys
REPO="/Users/dohieu/thenewleaders-site"
THEME="/Users/dohieu/Local Sites/thenewleaders/app/public/wp-content/themes/thenewleaders"
PREFIX="/thenewleaders"
CLONE=PREFIX+"/wp-content/themes/thenewleaders/clone"
s3='bucketeer-4deb826f-734a-4fe9-b45f-0e12646315fb.s3.eu-west-1.amazonaws.com'
def ver(p):
    try: return str(int(os.path.getmtime(p)))
    except: return '1'
cssv=ver(THEME+"/clone/css/live.css"); jsv=ver(THEME+"/clone/js/clone.js")
n=0
for f in glob.glob(THEME+"/clone/parts/detail/*/*.html"):
    m=re.match(r'.*/detail/([^/]+)/(.+)-(vi|en)\.html$', f)
    if not m: continue
    type_,slug,lang=m.group(1),m.group(2),m.group(3)
    body=open(f,encoding='utf-8',errors='ignore').read()
    body=body.replace('="images/','="'+CLONE+'/images/').replace('../'+s3+'/','https://'+s3+'/')
    out=f"{REPO}/docs/{lang}/{type_}/{slug}/index.html"
    os.makedirs(os.path.dirname(out),exist_ok=True)
    doc=('<!DOCTYPE html><html lang="%s"><head><meta charset="utf-8">'
         '<meta name="viewport" content="width=device-width, initial-scale=1.0">'
         '<link rel="stylesheet" href="%s/css/live.css?v=%s"></head><body>%s'
         '<script src="%s/js/clone.js?v=%s"></script></body></html>') % (lang,CLONE,cssv,body,CLONE,jsv)
    open(out,'w').write(doc)
    n+=1
print("generated detail pages:",n)
