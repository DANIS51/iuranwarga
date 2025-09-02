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
                    {{-- Detail Utama --}}
                    <table class="table table-bordered">
                        <tr>
                            <th>Nama Warga</th>
                            <td>{{ $payment->user ? $payment->user->name : 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Kategori Iuran</th>
                            <td>{{ $payment->duesCategory ? $payment->duesCategory->name : 'N/A' }}</td>
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
                            <td>{{ $payment->officer && $payment->officer->user ? $payment->officer->user->name : 'N/A' }}</td>
                        </tr>
                    </table>

                    {{-- Rincian Bulanan --}}
                    <h5 class="mt-4">Rincian Bulanan</h5>
                    <tr>
                        <th>Jumlah Bulan Terbayar : </th>
                        <td>{{ $jumlahBulan }} Bulan</td>
                    </tr>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Bulan</th>
                                <th>Status</th>
                                <th>Tanggal Bayar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($payment->duesMembers as $dm)
                                <tr>
                                    <td>{{ $dm->bulan }}</td>
                                    <td>
                                        <span class="badge bg-{{ $dm->status == 'paid' ? 'success' : 'warning' }}">
                                            {{ ucfirst($dm->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $dm->tanggal_bayar ? \Carbon\Carbon::parse($dm->tanggal_bayar)->format('d/m/Y') : '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">Belum ada rincian bulanan</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
