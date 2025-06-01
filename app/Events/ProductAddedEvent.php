<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Product;

class ProductAddedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    // $productプロパティを定義
    public $product;

    /**
     * Create a new event instance.
     */
    public function __construct(Product $product)
    {
        // インスタンス化時に渡されたProductインスタンスを自身の＄productプロパティに代入(クラスないでどこでも＄productを使えるようにする)
        $this->product = $product;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
