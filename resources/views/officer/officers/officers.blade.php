@extends('officer.template')

@section('title', 'Data Officer & Warga')

@section('content')
<div class="container-fluid px-4">
    <!-- Officer Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Data Officer</h5>
                    <a href="{{ route('admin.officers.add') }}" class="btn btn-primary mb-3">+ Tambah Officer</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Username</th>
                    <th>Name</th>
                    <th>No HP</th>
                    <th>Jabatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($officers as $index => $officer)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $officer->user->username ?? '-' }}</td>
                    <td>{{ $officer->user->name ?? '-' }}</td>
                    <td>{{ $officer->user->nohp ?? '-' }}</td>
                    <td>{{ $officer->position ?? 'Officer' }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">Tidak ada data officer.</td>
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

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endpush
