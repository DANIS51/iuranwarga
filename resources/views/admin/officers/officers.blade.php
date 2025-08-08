@extends('admin.template')

@section('title', 'Data Officer & Warga')

@section('content')
<div class="container-fluid px-4">
    <!-- Officer Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Data Officer</h5>
                    <a href="{{ route('admin.officers.add') }}" class="btn btn-primary mb-3">+ Tambah Oficer</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead class="table-light">
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

    <!-- Warga Section -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Daftar Warga</h5>
                     <a href="{{ route('register') }}" class="btn btn-primary mb-3">+ Tambah Warga</a>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                    <th>Nama</th>
                    <th>No HP</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
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
                        <a href="{{ route('admin.users.edit', Crypt::encrypt($item->id)) }}" class="btn btn-sm btn-warning me-1">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('admin.users.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data warga {{ $item->name }}?')" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
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
