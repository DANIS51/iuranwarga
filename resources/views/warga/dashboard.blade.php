@extends('template')

@section('content')
<div class="container-fluid px-4">
    <h1 class="h2 mb-4">Dashboard Warga</h1>

    <div class="row mb-4">
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5>Total Iuran Dibayar</h5>
                    <h3 class="text-success">Rp {{ number_format($totalPaid, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5>Total Iuran Pending</h5>
                    <h3 class="text-warning">Rp {{ number_format($totalPending, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5>Total Iuran Keseluruhan</h5>
                    <h3 class="text-primary">Rp {{ number_format($totalDues, 0, ',', '.') }}</h3>
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
                    <th>Bulan</th>
                    <th>Status</th>
                    <th>Tanggal Dibuat</th>
                </tr>
            </thead>
            <tbody>
                @forelse($duesMembers as $duesMember)
                <tr>
                    <td>{{ $duesMember->duesCategory->name ?? '-' }}</td>
                    <td>Rp {{ number_format($duesMember->duesCategory->nominal ?? 0, 0, ',', '.') }}</td>
                    <td>{{ $duesMember->bulan ?? '-' }}</td>
                    <td>
                        @if($duesMember->status == 'paid')
                            <span class="badge bg-success">Dibayar</span>
                        @elseif($duesMember->status == 'pending')
                            <span class="badge bg-warning">Pending</span>
                        @else
                            <span class="badge bg-secondary">{{ ucfirst($duesMember->status) }}</span>
                        @endif
                    </td>
                    <td>{{ \Carbon\Carbon::parse($duesMember->created_at)->format('d M Y') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Belum ada iuran yang ditetapkan.</td>
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
                        @if($payment->status == 'approved')
                            <span class="badge bg-success">Disetujui</span>
                        @elseif($payment->status == 'pending')
                            <span class="badge bg-warning">Menunggu</span>
                        @elseif($payment->status == 'rejected')
                            <span class="badge bg-danger">Ditolak</span>
                        @else
                            <span class="badge bg-secondary">{{ ucfirst($payment->status) }}</span>
                        @endif
                    </td>
                    <td>{{ \Carbon\Carbon::parse($payment->created_at)->format('d M Y') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center">Belum ada pembayaran.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
