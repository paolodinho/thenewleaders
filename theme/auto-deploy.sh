#!/bin/bash
# Tự động: sync theme source + build lại bản tĩnh + commit + push GitHub.
# Gọi bởi Stop hook của Claude Code. Luôn exit 0 để không chặn session.
REPO="/Users/dohieu/thenewleaders-site"
THEME="/Users/dohieu/Local Sites/thenewleaders/app/public/wp-content/themes/thenewleaders"
cd "$REPO" 2>/dev/null || exit 0
git remote get-url origin >/dev/null 2>&1 || exit 0   # chưa có remote -> bỏ qua

# 1) sync source theme -> repo/theme
rsync -a --delete --exclude 'backups' --exclude '.DS_Store' "$THEME/" "$REPO/theme/" 2>/dev/null

# 2) nếu theme có thay đổi & site Local đang chạy -> build lại bản tĩnh
if [ -n "$(git status --porcelain theme/ 2>/dev/null)" ]; then
  if curl -s -o /dev/null -m 3 "http://thenewleaders.local/en/" 2>/dev/null; then
    bash "$REPO/build-static.sh" 2>/dev/null || true
  fi
fi

# 3) commit + push nếu có thay đổi
if [ -n "$(git status --porcelain 2>/dev/null)" ]; then
  git add -A
  git -c user.email="hieudx3107@gmail.com" -c user.name="Do Hieu" commit -q -m "auto-update $(date '+%Y-%m-%d %H:%M')" 2>/dev/null
  git push -q origin main 2>/dev/null
fi
exit 0
