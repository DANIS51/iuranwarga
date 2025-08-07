
@extends('admin.template')

@section('content')
<div class="container">
    <h4>Daftar Warga</h4>
    <a href="" class="btn btn-primary mb-3">Tambah Warga</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Username</th>
                <th>No HP</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        @foreach($users as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->nohp }}</td>
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
@endsection
