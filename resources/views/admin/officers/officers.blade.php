@extends('admin.template')

@section('title', 'Data Officer')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">Data Officer</h3>
                        <a href="{{ route('admin.officers.add') }}" class="btn btn-primary">Tambah Officer</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>No HP</th>
                                <th>Jabatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($officers as $index => $officer)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $officer->user->name ?? '-' }}</td>
                                <td>{{ $officer->user->email ?? '-' }}</td>
                                <td>{{ $officer->user->nohp ?? '-' }}</td>
                                <td>{{ $officer->position ?? 'Officer' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
