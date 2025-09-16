@extends('officer.template')

@section('content')
<div class="container-fluid px-4">
    <h1 class="h2 mb-4">Dashboard Officer</h1>

    <div class="row mb-4">
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5>Total Pending Payments</h5>
                    <h3>{{ $totalPending }}</h3>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5>Total Approved Payments</h5>
                    <h3>{{ $totalApproved }}</h3>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5>Total Rejected Payments</h5>
                    <h3>{{ $totalRejected }}</h3>
                </div>
            </div>
        </div>
    </div>

    <h3>Pending Payments</h3>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Warga</th>
                    <th>Jenis Iuran</th>
                    <th>Nominal</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pendingPayments as $payment)
                <tr>
                    <td>{{ $payment->id }}</td>
                    <td>{{ $payment->user->name ?? '-' }}</td>
                    <td>{{ $payment->duesCategory->name ?? '-' }}</td>
                    <td>Rp {{ number_format($payment->nominal, 0, ',', '.') }}</td>
                    <td>{{ \Carbon\Carbon::parse($payment->created_at)->format('d M Y') }}</td>
                    <td>
                        <form action="{{ route('officer.payments.approve', $payment->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm">Setujui</button>
                        </form>
                        <form action="{{ route('officer.payments.reject', $payment->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">Tolak</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">Tidak ada pembayaran yang menunggu.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <h3>Recent Payments</h3>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Warga</th>
                    <th>Jenis Iuran</th>
                    <th>Nominal</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentPayments as $payment)
                <tr>
                    <td>{{ $payment->id }}</td>
                    <td>{{ $payment->user->name ?? '-' }}</td>
                    <td>{{ $payment->duesCategory->name ?? '-' }}</td>
                    <td>Rp {{ number_format($payment->nominal, 0, ',', '.') }}</td>
                    <td>{{ \Carbon\Carbon::parse($payment->updated_at)->format('d M Y') }}</td>
                    <td>{{ ucfirst($payment->status) }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">Belum ada pembayaran terbaru.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
