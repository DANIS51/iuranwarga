@extends('officer.template')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Pembayaran</h3>
                    <div class="card-tools">
                        <a href="{{ route('officer.payments.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Tambah Pembayaran
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Warga</th>
                                    <th>Kategori Iuran</th>
                                    <th>Nominal</th>
                                    <th>Metode Pembayaran</th>
                                    <th>Tanggal Bayar</th>
                                    <th>Status</th>
                                    <th>Petugas</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($payments as $index => $payment)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $payment->user->name ?? 'N/A' }}</td>
                                    <td>{{ $payment->duesCategory->name ?? 'N/A' }}</td>
                                    <td>Rp {{ number_format($payment->nominal, 0, ',', '.') }}</td>
                                    <td>
                                        <span class="badge bg-{{
                                            $payment->payment_method == 'cash' ? 'success' :
                                            ($payment->payment_method == 'transfer' ? 'primary' :
                                            ($payment->payment_method == 'qris' ? 'warning' : 'secondary'))
                                        }}">
                                            {{ ucfirst($payment->payment_method ?? 'Cash') }}
                                        </span>
                                    </td>

                                    <td>{{ $payment->payment_date ? \Carbon\Carbon::parse($payment->payment_date)->format('d/m/Y') : '-' }}</td>
                                    <td>
                                        <span class="badge bg-{{ $payment->status == 'approved' ? 'success' : ($payment->status == 'rejected' ? 'danger' : 'warning') }}">
                                            {{ ucfirst($payment->status ?? 'Pending') }}
                                        </span>
                                    </td>
                                    <td>{{ $payment->officer ? $payment->officer->user->name : 'N/A' }}</td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            @if($payment->status == 'pending')
                                                <form action="{{ route('officer.payments.approve', $payment->id) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success btn-sm">
                                                        <i class="fas fa-check">Setujui</i>
                                                    </button>
                                                </form>
                                                <form action="{{ route('officer.payments.reject', $payment->id) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menolak pembayaran ini?')">
                                                        <i class="fas fa-times">Tolak</i>
                                                    </button>
                                                </form>
                                            @else
                                                <span class="text-muted">Sudah diproses</span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="9" class="text-center">Belum ada pembayaran</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
