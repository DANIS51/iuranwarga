@extends('admin.template')

@section('content')
<div class="container">
    <h4 class="text-white mb-4">Daftar Warga</h4>
    <a href="{{ route('register') }}" class="btn btn-primary mb-3">+ Tambah Warga</a>

    <div class="table-responsive">
        <table class="table table-dark table-hover table-bordered rounded shadow overflow-hidden">
            <thead class="table-dark text-light">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">No HP</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->nohp }}</td>
                    <td>{{ $item->address }}</td>
                    <td>
                        <form action="" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">Tidak ada data warga.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
