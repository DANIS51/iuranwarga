@extends('admin.template')

@section('title', 'Pembayaran Anggota - ' . $member->user->name)

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Pembayaran Anggota: {{ $member->user->name }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.members') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                        <a href="{{ route('admin.payments.create') }}?member={{ $member->id }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Tambah Pembayaran
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5>Informasi Anggota</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Nama:</strong></td>
                                    <td>{{ $member->user->name }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Email:</strong></td>
                                    <td>{{ $member->user->email }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Kategori Iuran:</strong></td>
                                    <td>{{ $member->duesCategory->name ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Nominal:</strong></td>
                                    <td>Rp {{ number_format($member->duesCategory->nominal ?? 0, 0, ',', '.') }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h5>Ringkasan Pembayaran</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Total Pembayaran:</strong></td>
                                    <td>{{ $payments->count() }} kali</td>
                                </tr>
                                <tr>
                                    <td><strong>Total Nominal:</strong></td>
                                    <td>Rp {{ number_format($payments->sum('nominal'), 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Status Pembayaran:</strong></td>
                                    <td>
                                        <span class="badge
                                            {{ $member->payment_status == 'Lunas' ? 'bg-success' :
                                            ($member->payment_status == 'Sebagian' ? 'bg-warning' : 'bg-danger') }}">
                                            {{ $member->payment_status }}
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tanggal Pembayaran</th>
                                    <th>Kategori</th>
                                    <th>Nominal</th>
                                    <th>Metode</th>
                                    <th>Petugas</th>
                                    <th>Status</th>
                                    <th>Catatan</th>
                                    <th>Bukti</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($payments as $payment)
                                <tr>
                                    <td>{{ $payment->id }}</td>
                                    <td>{{ $payment->payment_date ? \Carbon\Carbon::parse($payment->payment_date)->format('d/m/Y') : 'N/A' }}</td>
                                    <td>{{ $payment->duesCategory->name ?? 'N/A' }}</td>
                                    <td>Rp {{ number_format($payment->nominal, 0, ',', '.') }}</td>
                                    <td>{{ ucfirst($payment->payment_method) }}</td>
                                    <td>{{ $payment->officer->officer_name ?? 'N/A' }}</td>
                                    <td>
                                        <span class="badge {{ $payment->status == 'completed' ? 'bg-success' : 'bg-warning' }}">
                                            {{ ucfirst($payment->status) }}
                                        </span>
                                    </td>

                                    <td>{{ $payment->notes ?? '-' }}</td>
                                    <td>
                                        @if($payment->bukti_pembayaran)
                                            <a href="{{ asset('storage/' . $payment->bukti_pembayaran) }}" target="_blank" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.payments.show', $payment->id) }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-eye">Lihat</i>
                                        </a>
                                        <a href="{{ route('admin.payments.edit', $payment->id) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit">Edit</i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="10" class="text-center">Tidak ada data pembayaran untuk anggota ini</td>
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
