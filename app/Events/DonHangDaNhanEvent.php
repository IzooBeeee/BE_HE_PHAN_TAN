<?php

namespace App\Events;

use App\Models\DonHang;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DonHangDaNhanEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $donHang;

    /**
     * Create a new event instance.
     * Event này được trigger khi shipper nhận đơn hàng
     */
    public function __construct(DonHang $donHang)
    {
        $this->donHang = $donHang;
    }

    /**
     * Get the channels the event should broadcast on.
     * Broadcast đến: Khách hàng và Quán ăn
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('khach-hang.' . $this->donHang->id_khach_hang),
            new PrivateChannel('quan-an.' . $this->donHang->id_quan_an),
        ];
    }

    /**
     * Tên event broadcast
     */
    public function broadcastAs(): string
    {
        return 'don-hang.da-nhan';
    }

    /**
     * Dữ liệu broadcast
     */
    public function broadcastWith(): array
    {
        return [
            'id' => $this->donHang->id,
            'ma_don_hang' => $this->donHang->ma_don_hang,
            'id_shipper' => $this->donHang->id_shipper,
            'tinh_trang' => $this->donHang->tinh_trang,
            'updated_at' => $this->donHang->updated_at,
            'message' => 'Shipper đã nhận đơn hàng!',
        ];
    }
}
