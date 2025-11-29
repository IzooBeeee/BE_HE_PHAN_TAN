#!/bin/bash

# Script khởi động Reverb và Queue Worker
# Sử dụng: bash start-services.sh

echo "🚀 Đang khởi động Laravel Services..."

# Lấy đường dẫn thư mục hiện tại
PROJECT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
cd "$PROJECT_DIR"

# Tạo thư mục logs nếu chưa có
mkdir -p storage/logs

# Kiểm tra và dừng processes cũ nếu có
echo "🔍 Kiểm tra processes đang chạy..."
pkill -f "artisan reverb:start" 2>/dev/null
pkill -f "artisan queue:work" 2>/dev/null
sleep 2

# Khởi động Reverb
echo "📡 Đang khởi động Reverb..."
nohup php artisan reverb:start > storage/logs/reverb.log 2>&1 &
REVERB_PID=$!
echo "✅ Reverb đã khởi động (PID: $REVERB_PID)"

# Đợi 2 giây
sleep 2

# Khởi động Queue Worker
echo "⚙️  Đang khởi động Queue Worker..."
nohup php artisan queue:work --sleep=3 --tries=3 --timeout=60 > storage/logs/queue.log 2>&1 &
QUEUE_PID=$!
echo "✅ Queue Worker đã khởi động (PID: $QUEUE_PID)"

echo ""
echo "✨ Hoàn tất! Services đang chạy:"
echo "   - Reverb PID: $REVERB_PID"
echo "   - Queue Worker PID: $QUEUE_PID"
echo ""
echo "📋 Xem logs:"
echo "   tail -f storage/logs/reverb.log"
echo "   tail -f storage/logs/queue.log"
echo ""
echo "🛑 Để dừng services, chạy: bash stop-services.sh"
