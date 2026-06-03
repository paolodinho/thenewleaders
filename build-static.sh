#!/bin/bash
# Build bản tĩnh từ site Local -> docs/ (cho GitHub Pages)
set -e
REPO="/Users/dohieu/thenewleaders-site"
WPROOT="/Users/dohieu/Local Sites/thenewleaders/app/public"
THEME="$WPROOT/wp-content/themes/thenewleaders"
B="http://thenewleaders.local"
slugs=( "" contact newsletter careers our-services products resources events eq-quiz \
  our-services/for-manager our-services/for-team-member our-services/executive-coach our-services/individual-courses \
  products/heart-heart-hand products/the-story-of-empathy products/the-eq-calendar eq-with-ngan-tran )
rm -rf "$REPO/docs"; mkdir -p "$REPO/docs"
for l in en vi; do
  for s in "${slugs[@]}"; do
    if [ -z "$s" ]; then out="$REPO/docs/$l/index.html"; url="$B/$l/"; else out="$REPO/docs/$l/$s/index.html"; url="$B/$l/$s/"; fi
    mkdir -p "$(dirname "$out")"; curl -s "$url" -o "$out"
  done
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
