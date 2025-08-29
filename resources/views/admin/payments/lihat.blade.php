@extends('admin.template')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detail Pembayaran</h3>
                    <a href="{{ route('admin.payments.index') }}" class="btn btn-secondary btn-sm float-right">
                        Kembali
                    </a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Nama Warga</th>
                            <td>{{ $payment->user->name ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Kategori Iuran</th>
                            <td>{{ $payment->duesCategory->name ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Nominal</th>
                            <td>Rp {{ number_format($payment->nominal, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th>Metode Pembayaran</th>
                            <td>{{ ucfirst($payment->payment_method ?? 'Cash') }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Bayar</th>
                            <td>{{ $payment->payment_date ? \Carbon\Carbon::parse($payment->payment_date)->format('d/m/Y') : '-' }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>{{ ucfirst($payment->status ?? 'Pending') }}</td>
                        </tr>
                        <tr>
                            <th>Petugas</th>
                            <td>{{ $payment->officer->user->name ?? 'N/A' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
