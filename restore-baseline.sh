#!/bin/bash
# Rollback trang demo (docs -> gh-pages) về một mốc git bất kỳ.
# Mặc định: baseline-2026-06-13 (trạng thái khớp live nhất).
# Dùng:
#   ./restore-baseline.sh                      # về baseline mặc định
#   ./restore-baseline.sh <tag-hoặc-commit>    # về mốc chỉ định
# An toàn: tự commit trạng thái hiện tại (làm điểm quay lại) TRƯỚC khi rollback.
set -e
REPO="/Users/dohieu/thenewleaders-site"
REF="${1:-baseline-2026-06-13}"
cd "$REPO"

echo "==> Sẽ rollback docs/ về: $REF"
git rev-parse --verify "$REF" >/dev/null 2>&1 || { echo "LỖI: không tìm thấy mốc '$REF'. Xem: git tag / git log --oneline"; exit 1; }

# 1) Chốt trạng thái hiện tại để còn quay lại được (undo của undo)
git add -A && git commit -q -m "snapshot trước khi rollback về $REF ($(date +%Y-%m-%d_%H%M))" || true

# 2) Lấy docs/ từ mốc đích
git checkout "$REF" -- docs
git commit -q -m "rollback docs về $REF" || true

# 3) Đẩy lên gh-pages (trang khách xem)
git worktree add -q /tmp/ghp-rb gh-pages
rsync -a --delete --exclude='.git' docs/ /tmp/ghp-rb/
( cd /tmp/ghp-rb && git add -A && git commit -q -m "rollback demo về $REF" && git push -q origin gh-pages )
git worktree remove /tmp/ghp-rb --force
git push -q origin main || true

echo "==> XONG. Demo đã về mốc '$REF'. Kiểm tra: https://paolodinho.github.io/thenewleaders/vi/ (chờ ~1 phút + hard refresh)"
echo "    Muốn huỷ rollback này: git log --oneline (tìm commit 'snapshot trước khi rollback') rồi chạy lại script với commit đó."
