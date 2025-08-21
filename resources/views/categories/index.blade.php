 
@extends('admin.template')

@section('content')
<div class="container-fluid px-4 mt-4" style="margin-top: 80px !important;">
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-transparent d-flex justify-content-between align-items-center py-3">
                    <h5 class="mb-0">Daftar Kategori Iuran</h5>
                    <a href="{{ route('categories.add') }}" class="btn btn-primary">+ Tambah Kategori</a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
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
                                            <a href="{{ route('categories-edit', Crypt::encrypt($category->id)) }}" class="btn btn-sm btn-warning me-1">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <form action="{{ route('categories.destroy', Crypt::encrypt($category->id)) }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
                                                    <i class="fas fa-trash-alt"></i> Hapus
                                                </button>
                                            </form>
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


</body>
@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endpush
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endpush
@endsection