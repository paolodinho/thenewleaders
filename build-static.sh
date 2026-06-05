#!/bin/bash
# Build bản tĩnh từ site Local -> docs/ (cho GitHub Pages)
set -e
REPO="/Users/dohieu/thenewleaders-site"
WPROOT="/Users/dohieu/Local Sites/thenewleaders/app/public"
THEME="$WPROOT/wp-content/themes/thenewleaders"
B="http://thenewleaders.local"
slugs=( "" contact newsletter careers our-services products resources events eq-quiz \
  our-services/for-manager our-services/for-team-member our-services/executive-coach our-services/individual-courses \
  products/heart-heart-hand products/the-story-of-empathy products/the-eq-calendar \
  products/vision-craft products/hlmays products/lgad eq-with-ngan-tran )
rm -rf "$REPO/docs"; mkdir -p "$REPO/docs"
for l in en vi; do
  for s in "${slugs[@]}"; do
    if [ -z "$s" ]; then out="$REPO/docs/$l/index.html"; url="$B/$l/"; else out="$REPO/docs/$l/$s/index.html"; url="$B/$l/$s/"; fi
    mkdir -p "$(dirname "$out")"; curl -s "$url" -o "$out"
  done
done
# Trang chi tiết sự kiện (CPT event, /su-kien/{slug}, đơn ngữ)
event_slugs=( the-strategic-interview giao-tiep-hieu-qua empower-her-08-03-2026 bond-beyond-lanh-dao-doi-ngu-hr-trong-mua-dich-chuyen who-takes-care-of-the-people-who-lead-people eq-for-finance-tu-ly-tri-den-suc-anh-huong the-true-well-being-2 leading-with-eq-how-hr-can-future-proof-finance-teams manipulate-behavior-for-good-using-emotional-intelligence wine-and-why emotional-intelligence-for-leading-the-new-generations leading-after-layoffs thriving-in-vietnamese-leadership-culture the-true-well-being-1 persolkelly-coffee-and-connect-series-leading-effectively-with-emotional-intelligence guest-speaker-adapting-and-thriving-a-leadership-journey-in-a-dynamic-world-2 am-cham-communicating-with-impact-telling-your-own-story-1 transform-your-sales-approach-with-emotional-intelligence elevate-your-leadership-skills-through-emotional-intelligence master-the-art-of-leadership-enhance-skills-with-emotional-intelligence medisetter-enhancing-medical-services-through-emotionally-intelligent-communication-2 leaders-talk-series-leadership-storytelling-startup-founders leaders-talk-series-inspiring-women-the-global-stories-vietnamese-women )
for s in "${event_slugs[@]}"; do
  out="$REPO/docs/su-kien/$s/index.html"; mkdir -p "$(dirname "$out")"; curl -s --cookie "tnl_lang=vi" "$B/su-kien/$s/" -o "$out"
done
# Bài blog (post, /blog/{slug}, đơn ngữ)
blog_slugs=( khi-doi-ngu-im-lang doi-tu-duy-thay-ket-qua hieu-suat-doi-ngu-khong-den-tu-kpi-ma-den-tu-cam-xuc mua-bao-nhan-vian-xin-off-sep-eq-cao-se-noi-gi 5-bieu-hien-sep-eq-can-cai-thien khi-my-dam-phan-ho-khong-choi-co-vua-ma-la-poker team-restart-don-t-let-the-new-year-begin-with-stagnation )
for s in "${blog_slugs[@]}"; do
  out="$REPO/docs/blog/$s/index.html"; mkdir -p "$(dirname "$out")"; curl -s --cookie "tnl_lang=vi" "$B/blog/$s/" -o "$out"
done
# assets
mkdir -p "$REPO/docs/wp-content/themes/thenewleaders"
cp "$THEME/style.css" "$REPO/docs/wp-content/themes/thenewleaders/"
rsync -a --exclude 'backups' "$THEME/assets" "$REPO/docs/wp-content/themes/thenewleaders/"
mkdir -p "$REPO/docs/wp-includes/css/dist/block-library"
cp "$WPROOT/wp-includes/css/classic-themes.min.css" "$REPO/docs/wp-includes/css/" 2>/dev/null || true
cp "$WPROOT/wp-includes/css/dist/block-library/common.min.css" "$REPO/docs/wp-includes/css/dist/block-library/" 2>/dev/null || true
# uploads (media library: ảnh sự kiện, testimonial, partner...) — cần cho ảnh không vỡ trên Pages
if [ -d "$WPROOT/wp-content/uploads" ]; then
  mkdir -p "$REPO/docs/wp-content/uploads"
  rsync -a "$WPROOT/wp-content/uploads/" "$REPO/docs/wp-content/uploads/"
fi
# rewrite host -> /thenewleaders ; remove WP head cruft
find "$REPO/docs" -type f \( -name '*.html' -o -name '*.css' \) -print0 | xargs -0 sed -i '' \
  -e 's#http://thenewleaders\.local#/thenewleaders#g' -e 's#http:\\/\\/thenewleaders\.local#/thenewleaders#g'
find "$REPO/docs" -name '*.html' -print0 | xargs -0 sed -i '' '/thenewleaders\.local/d'
# root redirect + nojekyll
printf '<!doctype html><meta charset=utf-8><meta http-equiv=refresh content="0; url=/thenewleaders/vi/"><a href="/thenewleaders/vi/">The New Leaders</a>' > "$REPO/docs/index.html"
touch "$REPO/docs/.nojekyll"
