@extends('admin.template')

@section('content')
<div class="container-fluid px-4 mt-4">
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Daftar Kategori Iuran</h5>
                    <a href="{{ route('categories.add') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus me-1"></i> Tambah Kategori Baru
                    </a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kategori</th>
                                    <th>Jenis Pembayaran</th>
                                    <th>Periode</th>
                                    <th>Nominal</th>
                                    <th>Petugas</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($categories as $index => $category)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ ucfirst(str_replace('per', '', $category->payment_type)) }}</td>
                                        <td>{{ $category->period }}</td>
                                        <td>Rp {{ number_format($category->nominal, 0, ',', '.') }}</td>
                                        <td>{{ $category->officer->user->name ?? 'Tidak ada petugas' }}</td>
                                        <td>
                                            <span class="badge bg-{{ $category->status === 'active' ? 'success' : 'secondary' }}">
                                                {{ ucfirst($category->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-warning me-1">
                                                <i class="fas fa-edit">edit</i>
                                            </a>
                                            <a href="#" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">
                                                <i class="fas fa-trash-alt">hapus</i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-muted">Belum ada kategori</td>
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

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endpush
@endsection
