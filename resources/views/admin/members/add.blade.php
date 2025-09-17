@extends('officer.template')

@section('title', 'Tambah Anggota Iuran')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tambah Anggota Iuran Baru</h3>
                    <div class="card-tools">
                        <a href="{{ route('officer.members') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('admin.members.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="iduser">Nama Warga <span class="text-danger">*</span></label>
                            <select class="form-control @error('iduser') is-invalid @enderror" id="iduser" name="iduser" required>
                                <option value="">-- Pilih Warga --</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ old('iduser') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }} - {{ $user->email }}
                                    </option>
                                @endforeach
                            </select>
                            @error('iduser')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="idduescategory">Kategori Iuran <span class="text-danger">*</span></label>
                            <select class="form-control @error('idduescategory') is-invalid @enderror" id="idduescategory" name="idduescategory" required>
                                <option value="">-- Pilih Kategori Iuran --</option>
                                @foreach($duesCategories as $category)
                                    <option value="{{ $category->id }}" {{ old('idduescategory') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }} - Rp {{ number_format($category->nominal, 0, ',', '.') }} ({{ $category->payment_type }})
                                    </option>
                                @endforeach
                            </select>
                            @error('idduescategory')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan
                            </button>
                            <a href="{{ route('officer.members') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

