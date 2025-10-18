<?php
namespace App\Events;
use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;
use App\Models\Order;

class OrderCreated implements ShouldBroadcast
{
    use SerializesModels;
    public $order;
    public function __construct(Order $order){ $this->order = $order; }
    public function broadcastOn(){ return new Channel('orders'); }
    public function broadcastAs(){ return 'OrderCreated'; }
}
