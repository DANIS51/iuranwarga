@extends('admin.template')

@section('title', 'Data Petugas')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Petugas</h3>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
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
                                @forelse($officers as $index => $officer)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $officer->user->name ?? '-' }}</td>
                                        <td>{{ $officer->user->email ?? '-' }}</td>
                                        <td>{{ $officer->user->nohp ?? '-' }}</td>
                                        <td>{{ $officer->position ?? 'Petugas' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Tidak ada data petugas</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


 
