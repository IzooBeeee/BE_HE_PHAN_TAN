<?php

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Log;
use App\Models\KhachHang;
use App\Models\QuanAn;
use App\Models\Shipper;

// Channel cho Khách Hàng
Broadcast::channel('khach-hang.{id}', function ($user, $id) {
    $isAuthorized = $user instanceof KhachHang && (int) $user->id === (int) $id;

    Log::info('Channel Authorization: khach-hang', [
        'user_id' => $user->id ?? null,
        'user_type' => get_class($user),
        'channel_id' => $id,
        'authorized' => $isAuthorized
    ]);

    return $isAuthorized;
});

// ===========================================
// Channel: private-quan-an.{id}
// ===========================================
Broadcast::channel('quan-an.{id}', function ($user, $id) {
    // Kiểm tra user có phải quán ăn này không
    $isAuthorized = false;

    // Cách 1: Kiểm tra model type và ID
    if ($user instanceof QuanAn && (int) $user->id === (int) $id) {
        $isAuthorized = true;
    }

    // Cách 2: Kiểm tra ID và loại tài khoản
    if (!$isAuthorized && isset($user->loai_tai_khoan) &&
        strtolower($user->loai_tai_khoan) === 'quan_an' &&
        (int) $user->id === (int) $id) {
        $isAuthorized = true;
    }

    // Cách 3: Kiểm tra table và ID
    if (!$isAuthorized && method_exists($user, 'getTable') &&
        $user->getTable() === 'quan_ans' &&
        (int) $user->id === (int) $id) {
        $isAuthorized = true;
    }

    Log::info('Channel Authorization: quan-an', [
        'user_id' => $user->id ?? null,
        'user_type' => get_class($user),
        'channel_id' => $id,
        'loai_tai_khoan' => $user->loai_tai_khoan ?? 'N/A',
        'authorized' => $isAuthorized
    ]);

    return $isAuthorized;
});

// ===========================================
// QUAN TRỌNG: all-shippers channel
// Channel chung cho tất cả Shipper (để nhận thông báo đơn hàng mới)
// ===========================================
Broadcast::channel('all-shippers', function ($user) {
    // Kiểm tra user có phải shipper không - nhiều cách để đảm bảo chắc chắn

    // Cách 1: Kiểm tra model type (chính xác nhất)
    if ($user instanceof Shipper) {
        Log::info('Channel Authorization: all-shippers - Authorized (instanceof)', [
            'user_id' => $user->id ?? null,
            'user_type' => get_class($user),
            'authorized' => true
        ]);
        return true;
    }

    // Cách 2: Kiểm tra loại tài khoản (nếu có field này)
    if (isset($user->loai_tai_khoan) && strtolower($user->loai_tai_khoan) === 'shipper') {
        Log::info('Channel Authorization: all-shippers - Authorized (loai_tai_khoan)', [
            'user_id' => $user->id ?? null,
            'user_type' => get_class($user),
            'loai_tai_khoan' => $user->loai_tai_khoan,
            'authorized' => true
        ]);
        return true;
    }

    // Cách 3: Kiểm tra table name
    if (method_exists($user, 'getTable') && $user->getTable() === 'shippers') {
        Log::info('Channel Authorization: all-shippers - Authorized (table name)', [
            'user_id' => $user->id ?? null,
            'user_type' => get_class($user),
            'table' => $user->getTable(),
            'authorized' => true
        ]);
        return true;
    }

    // Cách 4: Kiểm tra class name
    $className = get_class($user);
    if (strpos($className, 'Shipper') !== false) {
        Log::info('Channel Authorization: all-shippers - Authorized (class name)', [
            'user_id' => $user->id ?? null,
            'user_type' => $className,
            'authorized' => true
        ]);
        return true;
    }

    // QUAN TRỌNG: Phải return false cho các user khác
    Log::warning('Channel Authorization: all-shippers - NOT Authorized', [
        'user_id' => $user->id ?? null,
        'user_type' => get_class($user),
        'loai_tai_khoan' => $user->loai_tai_khoan ?? 'N/A',
        'table' => method_exists($user, 'getTable') ? $user->getTable() : 'N/A',
        'authorized' => false
    ]);

    return false;
});

// Channel riêng cho từng Shipper
Broadcast::channel('shipper.{id}', function ($user, $id) {
    $isAuthorized = $user instanceof Shipper && (int) $user->id === (int) $id;

    Log::info('Channel Authorization: shipper', [
        'user_id' => $user->id ?? null,
        'user_type' => get_class($user),
        'channel_id' => $id,
        'authorized' => $isAuthorized
    ]);

    return $isAuthorized;
});
