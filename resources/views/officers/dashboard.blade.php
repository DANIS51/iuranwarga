@extends('officers.template')

@section('content')
<div class="container-fluid px-4">
    <h1 class="h2 mb-4">Dashboard Warga</h1>

    <div class="row mb-4">
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5>Total Iuran</h5>
                    <h3>Rp {{ number_format($totalDues, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5>Total Sudah Dibayar</h5>
                    <h3>Rp {{ number_format($totalPaid, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5>Menunggu Konfirmasi</h5>
                    <h3>Rp {{ number_format($totalPending, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>
    </div>

    <h3>Iuran Saya</h3>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Jenis Iuran</th>
                    <th>Nominal</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @forelse($duesMembers as $duesMember)
                <tr>
                    <td>{{ $duesMember->duesCategory->name ?? '-' }}</td>
                    <td>Rp {{ number_format($duesMember->duesCategory->nominal ?? 0, 0, ',', '.') }}</td>
                    <td>{{ ucfirst($duesMember->status) }}</td>
                    <td>{{ \Carbon\Carbon::parse($duesMember->created_at)->format('d M Y') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center">Belum ada iuran yang terdaftar.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <h3>Riwayat Pembayaran</h3>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Jenis Iuran</th>
                    <th>Nominal</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @forelse($payments as $payment)
                <tr>
                    <td>{{ $payment->duesCategory->name ?? '-' }}</td>
                    <td>Rp {{ number_format($payment->nominal, 0, ',', '.') }}</td>
                    <td>
                        <span class="badge bg-{{ $payment->status == 'approved' ? 'success' : ($payment->status == 'pending' ? 'warning' : 'danger') }}">
                            {{ ucfirst($payment->status) }}
                        </span>
                    </td>
                    <td>{{ \Carbon\Carbon::parse($payment->created_at)->format('d M Y') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center">Belum ada riwayat pembayaran.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
