@extends('admin.template')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Tambah Kategori Iuran</h4>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('categories.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Kategori</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                            <small class="text-muted">Contoh: Iuran Kebersihan, Iuran Satpam, Iuran Lingkungan</small>
                        </div>
                        <div class="mb-3">
                            <label for="period" class="form-label">Periode</label>
                            <input type="text" class="form-control" id="period" name="period" required>
                            <small class="text-muted">Contoh: Januari 2024, Q1 2024, Tahunan 2024</small>
                        </div>
                        <div class="mb-3">
                            <label for="payment_type" class="form-label">Jenis Pembayaran</label>
                            <select class="form-select" id="payment_type" name="payment_type" required>
                                <option value="">Pilih Jenis Pembayaran</option>
                                <option value="mingguan">Mingguan</option>
                                <option value="bulanan">Bulanan</option>
                                <option value="tahunan">Tahunan</option>
                            </select>
                            <small class="text-muted">Pilih frekuensi pembayaran untuk kategori ini</small>
                        </div>
                        <div class="mb-3">
                            <label for="nominal" class="form-label">Nominal</label>
                            <input type="number" class="form-control" id="nominal" name="nominal" required>
                            <small class="text-muted">Masukkan nominal dalam Rupiah</small>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="active">Aktif</option>
                                <option value="inactive">Tidak Aktif</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="petugas" class="form-label">Petugas</label>
                            <select class="form-select" id="petugas" name="petugas" required>
                                <option value="">Pilih Petugas</option>
                                @foreach($officers as $officer)
                                    <option value="{{ $officer->user->name }}">{{ $officer->user->name }}</option>
                                @endforeach
                            </select>
                            <small class="text-muted">Pilih petugas yang bertanggung jawab</small>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Simpan Kategori</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
