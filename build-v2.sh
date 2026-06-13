#!/bin/bash
# Build bản tĩnh site V2 (thenewleaders-v2.local) -> docs/v2/ (GitHub Pages, prefix /thenewleaders/v2)
# Chạy SAU build-static.sh (v1). KHÔNG xoá docs gốc, chỉ quản docs/v2.
set -e
REPO="/Users/dohieu/thenewleaders-site"
WPROOT="/Users/dohieu/Local Sites/thenewleaders-v2/app/public"
THEME="$WPROOT/wp-content/themes/thenewleaders"
B="http://thenewleaders-v2.local"
OUT="$REPO/docs/v2"
slugs=( "" contact newsletter careers our-services products resources events eq-quiz \
  our-services/for-manager our-services/for-team-member our-services/executive-coach our-services/individual-courses \
  products/heart-heart-hand products/the-story-of-empathy products/the-eq-calendar \
  products/seli-strategic-eq-leadership-index products/tet-gift-box \
  products/vision-craft products/hlmays products/lgad eq-with-ngan-tran )
rm -rf "$OUT"; mkdir -p "$OUT"
for l in en vi; do
  for s in "${slugs[@]}"; do
    if [ -z "$s" ]; then out="$OUT/$l/index.html"; url="$B/$l/"; else out="$OUT/$l/$s/index.html"; url="$B/$l/$s/"; fi
    mkdir -p "$(dirname "$out")"; curl -s "$url" -o "$out"
  done
done
# assets (css/js/fonts/images clone + theme assets) cho v2
mkdir -p "$OUT/wp-content/themes/thenewleaders"
cp "$THEME/style.css" "$OUT/wp-content/themes/thenewleaders/" 2>/dev/null || true
rsync -a --exclude 'backups' "$THEME/assets" "$OUT/wp-content/themes/thenewleaders/"
rsync -a "$THEME/clone" "$OUT/wp-content/themes/thenewleaders/"
mkdir -p "$OUT/wp-includes/css/dist/block-library"
cp "$WPROOT/wp-includes/css/classic-themes.min.css" "$OUT/wp-includes/css/" 2>/dev/null || true
cp "$WPROOT/wp-includes/css/dist/block-library/common.min.css" "$OUT/wp-includes/css/dist/block-library/" 2>/dev/null || true
if [ -d "$WPROOT/wp-content/uploads" ]; then
  mkdir -p "$OUT/wp-content/uploads"; rsync -a "$WPROOT/wp-content/uploads/" "$OUT/wp-content/uploads/"
fi
# Trang chi tiết (events/blog/courses) cho v2 — generate-detail tham số hoá qua env
TNL_THEME="$THEME" TNL_DOCS="$OUT" TNL_PREFIX="/thenewleaders/v2" python3 "$REPO/generate-detail.py" 2>/dev/null || true
# rewrite host -> /thenewleaders/v2 ; bỏ dòng còn .local
find "$OUT" -type f \( -name '*.html' -o -name '*.css' \) -print0 | xargs -0 sed -i '' \
  -e 's#http://thenewleaders-v2\.local#/thenewleaders/v2#g' -e 's#http:\\/\\/thenewleaders-v2\.local#/thenewleaders/v2#g'
find "$OUT" -name '*.html' -print0 | xargs -0 sed -i '' '/thenewleaders-v2\.local/d'
# redirect gốc v2
printf '<!doctype html><meta charset=utf-8><meta http-equiv=refresh content="0; url=/thenewleaders/v2/vi/"><a href="/thenewleaders/v2/vi/">The New Leaders v2</a>' > "$OUT/index.html"
echo "v2 build done -> $OUT"

python3 "$REPO/optimize-static.py" "$OUT"
