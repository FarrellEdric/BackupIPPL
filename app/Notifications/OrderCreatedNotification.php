<?php
namespace App\Notifications;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class OrderCreatedNotification extends Notification
{
    use Queueable;
    protected $order;
    public function __construct($order){ $this->order = $order; }
    public function via($notifiable){ return ['database','broadcast']; }
    public function toArray($notifiable){
        return [
            'order_id'=>$this->order->id,
            'total'=>$this->order->total,
            'message'=>'Pesanan baru diterima'
        ];
    }
}
