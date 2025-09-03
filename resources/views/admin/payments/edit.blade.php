@extends('admin.template')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Pembayaran</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.payments.update', $payment->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="iduser">Nama Warga</label>
                            <select name="iduser" id="iduser" class="form-control" required>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ $payment->iduser == $user->id ? 'selected' : '' }}>
                                        {{ $user->name ?? 'Unknown User' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="idduescategory">Kategori Iuran</label>
                            <select name="idduescategory" id="idduescategory" class="form-control" required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $payment->idduescategory == $category->id ? 'selected' : '' }}>
                                        {{ $category->name ?? 'Unknown Category' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="nominal">Nominal</label>
                            <input type="number" name="nominal" id="nominal" class="form-control"
                                   value="{{ old('nominal', $payment->nominal) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="payment_method">Metode Pembayaran</label>
                            <select name="payment_method" id="payment_method" class="form-control">
                                <option value="cash" {{ $payment->payment_method == 'cash' ? 'selected' : '' }}>Cash</option>
                                <option value="transfer" {{ $payment->payment_method == 'transfer' ? 'selected' : '' }}>Transfer</option>
                                <option value="qris" {{ $payment->payment_method == 'qris' ? 'selected' : '' }}>QRIS</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="payment_date">Tanggal Bayar</label>
                            <input type="date" name="payment_date" id="payment_date" class="form-control"
                                   value="{{ $payment->payment_date ? \Carbon\Carbon::parse($payment->payment_date)->format('Y-m-d') : '' }}">
                        </div>

                        <div class="form-group">
                            <label for="period">Periode</label>
                            <select name="period" id="period" class="form-control">
                                <option value="mingguan" {{ $payment->period == 'mingguan' ? 'selected' : '' }}>Mingguan</option>
                                <option value="bulanan" {{ $payment->period == 'bulanan' ? 'selected' : '' }}>Bulanan</option>
                                <option value="tahunan" {{ $payment->period == 'tahunan' ? 'selected' : '' }}>Tahunan</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="pending" {{ $payment->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="completed" {{ $payment->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ $payment->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="bukti_pembayaran">Bukti Pembayaran</label>
                            <input type="file" name="bukti_pembayaran" id="bukti_pembayaran" class="form-control" accept="image/*">
                            <small class="form-text text-muted">Format: JPG, PNG, JPEG. Maksimal 2MB</small>
                            @if($payment->bukti_pembayaran)
                                <div class="mt-2">
                                    <img src="{{ Storage::url($payment->bukti_pembayaran) }}" alt="Bukti Pembayaran" class="img-thumbnail" style="max-width: 200px;">
                                </div>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save"></i> Simpan Perubahan
                        </button>
                        <a href="{{ route('admin.payments.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
