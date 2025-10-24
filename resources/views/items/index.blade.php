@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Daftar Items</h2>
    <a href="{{ route('items.create') }}" class="btn btn-primary mb-3">Tambah Item</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Stock</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $i => $item)
            <tr>
                <td>{{ $i + $items->firstItem() }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->category->name }}</td>
                <td>Rp {{ number_format($item->price) }}</td>
                <td>{{ $item->stock }}</td>
                <td>{{ $item->availability ? 'Tersedia' : 'Habis' }}</td>
                <td>
                    <a href="{{ route('items.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>

                    <!-- Update Stock Modal Trigger -->
                    <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#stockModal{{ $item->id }}">
                        Update Stock
                    </button>

                    <!-- Delete Modal Trigger -->
                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $item->id }}">
                        Hapus
                    </button>
                </td>
            </tr>

            <!-- Stock Modal -->
            <div class="modal fade" id="stockModal{{ $item->id }}" tabindex="-1">
                <div class="modal-dialog">
                    <form action="{{ route('items.updateStock', $item->id) }}" method="POST">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Update Stock: {{ $item->name }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <input type="number" name="stock" class="form-control" value="{{ $item->stock }}" required>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-info">Update</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Delete Modal -->
            <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1">
                <div class="modal-dialog">
                    <form action="{{ route('items.destroy', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Hapus Item: {{ $item->name }}?</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                Apakah Anda yakin ingin menghapus item ini?
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-danger">Hapus</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            @endforeach
        </tbody>
    </table>

    {{ $items->links() }}
</div>
@endsection
