@extends('admin.template')
@section('content')

<div class="container min-vh-100 d-flex align-items-center justify-content-center mt-10">
    <div class="bg-white card p-4" style="max-width: 450px; width: 100%;">
        <h4 class="text-center mb-4">Edit Category</h4>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $item)
                    <li>{{ $item }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('categories-update', Crypt::encrypt($category->id)) }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Nama Kategori</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}" required>
                <small class="text-muted">Contoh: Iuran Kebersihan, Iuran Satpam, Iuran Lingkungan</small>
            </div>

            <div class="mb-3">
                <label for="period" class="form-label">Periode</label>
                <input type="text" class="form-control" id="period" name="period" value="{{ $category->period }}" required>
                <small class="text-muted">Contoh: Januari 2024, Q1 2024, Tahunan 2024</small>
            </div>

            <div class="mb-3">
                <label for="payment_type" class="form-label">Jenis Pembayaran</label>
                <select class="form-select" id="payment_type" name="payment_type" required>
                    <option value="">Pilih Jenis Pembayaran</option>
                    <option value="mingguan" {{ $category->payment_type == 'mingguan' ? 'selected' : '' }}>Mingguan</option>
                    <option value="bulanan" {{ $category->payment_type == 'bulanan' ? 'selected' : '' }}>Bulanan</option>
                    <option value="tahunan" {{ $category->payment_type == 'tahunan' ? 'selected' : '' }}>Tahunan</option>
                </select>
                <small class="text-muted">Pilih frekuensi pembayaran untuk kategori ini</small>
            </div>

            <div class="mb-3">
                <label for="nominal" class="form-label">Nominal</label>
                <input type="number" class="form-control" id="nominal" name="nominal" value="{{ $category->nominal }}" required>
                <small class="text-muted">Masukkan nominal dalam Rupiah</small>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status" required>
                    <option value="active" {{ $category->status == 'active' ? 'selected' : '' }}>Aktif</option>
                    <option value="inactive" {{ $category->status == 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="petugas" class="form-label">Petugas</label>
                <select class="form-select" id="petugas" name="petugas" required>
                    <option value="">Pilih Petugas</option>
                    @foreach($officers as $officer)
                        <option value="{{ $officer->id }}" {{ $category->petugas == $officer->id ? 'selected' : '' }}>
                            {{ $officer->user->name }}
                        </option>
                    @endforeach
                </select>
                <small class="text-muted">Pilih petugas yang bertanggung jawab</small>
            </div>

            <button type="submit" class="btn btn-primary w-100">Update</button>
        </form>
    </div>
</div>

@endsection
