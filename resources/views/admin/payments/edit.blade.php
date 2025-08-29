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
                    <form action="{{ route('admin.payments.update', $payment->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="user_id">Nama Warga</label>
                            <select name="user_id" id="user_id" class="form-control" required>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ $payment->user_id == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="dues_category_id">Kategori Iuran</label>
                            <select name="dues_category_id" id="dues_category_id" class="form-control" required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $payment->dues_category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
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
                                <option value="ewallet" {{ $payment->payment_method == 'ewallet' ? 'selected' : '' }}>E-Wallet</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="payment_date">Tanggal Bayar</label>
                            <input type="date" name="payment_date" id="payment_date" class="form-control"
                                   value="{{ $payment->payment_date ? \Carbon\Carbon::parse($payment->payment_date)->format('Y-m-d') : '' }}">
                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="pending" {{ $payment->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="completed" {{ $payment->status == 'completed' ? 'selected' : '' }}>Completed</option>
                            </select>
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
