@extends('admin.template')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tambah Pembayaran Baru</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.payments.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.payments.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="iduser">Nama Warga</label>
                                    <select class="form-control @error('iduser') is-invalid @enderror" id="iduser" name="iduser" required>
                                        <option value="">Pilih Warga</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}" {{ (old('iduser') == $user->id || (isset($selectedUser) && $selectedUser == $user->id)) ? 'selected' : '' }}>
                                                {{ $user->name }} - {{ $user->email }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('iduser')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="idmember">Anggota Iuran</label>
                                    <select class="form-control @error('idmember') is-invalid @enderror" id="idmember" name="idmember" required>
                                        <option value="">Pilih Anggota</option>
                                        @foreach($members as $member)
                                            <option value="{{ $member->id }}" {{ (old('idmember') == $member->id || (isset($selectedMember) && $selectedMember == $member->id)) ? 'selected' : '' }}>
                                                {{ $member->user ? $member->user->name : 'Unknown User' }} - {{ $member->duesCategory ? $member->duesCategory->name : 'Unknown Category' }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('idmember')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="idduescategory">Kategori Iuran</label>
                                    <select class="form-control @error('idduescategory') is-invalid @enderror" id="idduescategory" name="idduescategory" required>
                                        <option value="">Pilih Kategori</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ (old('idduescategory') == $category->id || (isset($selectedCategory) && $selectedCategory == $category->id)) ? 'selected' : '' }}>
                                                {{ $category->name }} - Rp {{ number_format($category->nominal, 0, ',', '.') }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('idduescategory')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nominal">Nominal</label>
                                    <input type="number" class="form-control @error('nominal') is-invalid @enderror" id="nominal" name="nominal" value="{{ old('nominal') }}" required min="0">
                                    @error('nominal')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="payment_method">Metode Pembayaran</label>
                                    <select class="form-control @error('payment_method') is-invalid @enderror" id="payment_method" name="payment_method" required>
                                        <option value="cash" {{ old('payment_method') == 'cash' ? 'selected' : '' }}>Cash</option>
                                        <option value="transfer" {{ old('payment_method') == 'transfer' ? 'selected' : '' }}>Transfer Bank</option>
                                        <option value="qris" {{ old('payment_method') == 'qris' ? 'selected' : '' }}>QRIS</option>
                                    </select>
                                    @error('payment_method')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="payment_date">Tanggal Pembayaran</label>
                                    <input type="date" class="form-control @error('payment_date') is-invalid @enderror" id="payment_date" name="payment_date" value="{{ old('payment_date', date('Y-m-d')) }}" required>
                                    @error('payment_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="period">Periode</label>
                                    <select class="form-control @error('period') is-invalid @enderror" id="period" name="period" required>
                                        <option value="mingguan" {{ old('period') == 'mingguan' ? 'selected' : '' }}>Mingguan</option>
                                        <option value="bulanan" {{ old('period') == 'bulanan' ? 'selected' : '' }}>Bulanan</option>
                                        <option value="tahunan" {{ old('period') == 'tahunan' ? 'selected' : '' }}>Tahunan</option>
                                    </select>
                                    @error('period')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="notes">Catatan (Opsional)</label>
                                    <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes" rows="3">{{ old('notes') }}</textarea>
                                    @error('notes')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="bukti_pembayaran">Bukti Pembayaran (Opsional)</label>
                                    <input type="file" class="form-control-file @error('bukti_pembayaran') is-invalid @enderror" id="bukti_pembayaran" name="bukti_pembayaran" accept="image/*">
                                    <small class="form-text text-muted">
                                        Format: JPG, PNG, JPEG. Maksimal 2MB
                                    </small>
                                    @error('bukti_pembayaran')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Simpan Pembayaran
                                </button>
                                <a href="{{ route('admin.payments.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-times"></i> Batal
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
