@extends('admin.template')

@section('title', 'Data Anggota Iuran')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Anggota Iuran</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama Anggota</th>
                                    <th>Email</th>
                                    <th>Kategori Iuran</th>
                                    <th>Jenis Pembayaran</th>
                                    <th>Nominal</th>
                                    <th>Petugas</th>
                                    <th>Status Pembayaran</th>
                                    <th>Total Dibayar</th>
                                    <th>Tanggal Bergabung</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($members as $member)
                                <tr>
                                    <td>{{ $member->id }}</td>
                                    <td>{{ $member->member_name }}</td>
                                    <td>{{ $member->member_email }}</td>
                                    <td>{{ $member->duesCategory->name ?? 'N/A' }}</td>
                                    <td>{{ $member->duesCategory->payment_type ?? 'N/A' }}</td>
                                    <td>Rp {{ number_format($member->duesCategory->nominal ?? 0, 0, ',', '.') }}</td>
                                    <td>{{ $member->officer->officer_name ?? 'Tidak ada petugas' }}</td>
                                    <td>
                                        <span class="badge badge-{{ $member->payment_status == 'Lunas' ? 'success' : ($member->payment_status == 'Sebagian' ? 'warning' : 'danger') }}">
                                            {{ $member->payment_status }}
                                        </span>
                                    </td>
                                    <td>Rp {{ number_format($member->total_payments, 0, ',', '.') }}</td>
                                    <td>{{ $member->created_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <a href="{{ route('admin.members.payments', $member->id) }}" class="btn btn-sm btn-info">
                                            Lihat Pembayaran
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="11" class="text-center">Tidak ada data anggota iuran</td>
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


