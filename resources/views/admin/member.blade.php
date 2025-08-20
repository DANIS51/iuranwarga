@extends('admin.template')

@section('content')
<div class="container">
    <h4 class="text-white">Daftar Warga</h4>
    <a href="{{ route('register') }}" class="btn btn-primary mb-3">Tambah Warga</a>

    <div class="table-responsive">
        <table class="table table-bordered table-dark">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>No HP</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            @foreach($users as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item ->nohp }}</td>
                    <td>{{ $item->address }}</td>
                    <td>
                        <form action="" method="POST" onsubmit="return confirm('Yakin hapus?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
