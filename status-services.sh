#!/bin/bash

# Script kiểm tra trạng thái Reverb và Queue Worker
# Sử dụng: bash status-services.sh

echo "📊 Trạng thái Laravel Services"
echo "================================"
echo ""

# Kiểm tra Reverb
echo "📡 Reverb:"
REVERB_RUNNING=$(pgrep -f "artisan reverb:start" | wc -l)
if [ $REVERB_RUNNING -gt 0 ]; then
    echo "   ✅ Đang chạy (PID: $(pgrep -f 'artisan reverb:start'))"
else
    echo "   ❌ Không chạy"
fi

echo ""

# Kiểm tra Queue Worker
echo "⚙️  Queue Worker:"
QUEUE_RUNNING=$(pgrep -f "artisan queue:work" | wc -l)
if [ $QUEUE_RUNNING -gt 0 ]; then
    echo "   ✅ Đang chạy (PID: $(pgrep -f 'artisan queue:work'))"
else
    echo "   ❌ Không chạy"
fi

echo ""
echo "================================"
echo ""

# Hiển thị log files nếu có
if [ -f "storage/logs/reverb.log" ]; then
    echo "📋 10 dòng cuối của Reverb log:"
    tail -n 10 storage/logs/reverb.log
    echo ""
fi

if [ -f "storage/logs/queue.log" ]; then
    echo "📋 10 dòng cuối của Queue log:"
    tail -n 10 storage/logs/queue.log
    echo ""
fi
