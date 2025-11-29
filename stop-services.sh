#!/bin/bash

# Script dừng Reverb và Queue Worker
# Sử dụng: bash stop-services.sh

echo "🛑 Đang dừng Laravel Services..."

# Dừng Reverb
echo "📡 Đang dừng Reverb..."
pkill -f "artisan reverb:start"
if [ $? -eq 0 ]; then
    echo "✅ Đã dừng Reverb"
else
    echo "ℹ️  Không tìm thấy Reverb process"
fi

# Dừng Queue Worker
echo "⚙️  Đang dừng Queue Worker..."
pkill -f "artisan queue:work"
if [ $? -eq 0 ]; then
    echo "✅ Đã dừng Queue Worker"
else
    echo "ℹ️  Không tìm thấy Queue Worker process"
fi

echo ""
echo "✨ Hoàn tất!"
