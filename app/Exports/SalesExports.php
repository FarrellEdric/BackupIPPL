<?php
namespace App\Exports;
use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SalesExports implements FromCollection, WithHeadings, WithMapping
{
    protected $filters;
    public function __construct($filters = []){ $this->filters = $filters; }

    public function collection()
    {
        $q = Order::with('items.item');
        if (!empty($this->filters['from'])) $q->whereDate('created_at','>=',$this->filters['from']);
        if (!empty($this->filters['to'])) $q->whereDate('created_at','<=',$this->filters['to']);
        return $q->get();
    }

    public function headings(): array
    {
        return ['ID','Customer','Total','Payment Status','Payment Method','Tanggal'];
    }

    public function map($order): array
    {
        return [
            $order->id,
            $order->customer_name ?? ($order->user->name ?? '-'),
            $order->total,
            $order->payment_status,
            $order->payment_method,
            $order->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
