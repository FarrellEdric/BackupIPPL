@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Pesanan</h1>

    @if(isset($orders) && count($orders) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Pelanggan</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->customer_name }}</td>
                        <td>{{ $order->total }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Tidak ada pesanan.</p>
    @endif
</div>
@endsection
