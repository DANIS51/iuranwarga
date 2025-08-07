@extends('admin.template')

@section('content')
<div class="container-fluid px-4">
    <h1 class="h2 mb-4">Dashboard Admin</h1>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-primary bg-opacity-10 rounded p-3">
                                <i class="fas fa-users text-primary fs-4"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <p class="text-muted mb-1">Total Warga</p>
                            <h3 class="mb-0">150</h3>
                            <small class="text-success"><i class="fas fa-arrow-up"></i> +12% dari bulan lalu</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-success bg-opacity-10 rounded p-3">
                                <i class="fas fa-dollar-sign text-success fs-4"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <p class="text-muted mb-1">Total Iuran</p>
                            <h3 class="mb-0">Rp 45.2jt</h3>
                            <small class="text-success"><i class="fas fa-arrow-up"></i> +8% dari bulan lalu</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-warning bg-opacity-10 rounded p-3">
                                <i class="fas fa-clock text-warning fs-4"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <p class="text-muted mb-1">Belum Bayar</p>
                            <h3 class="mb-0">12</h3>
                            <small class="text-danger"><i class="fas fa-arrow-down"></i> -5% dari bulan lalu</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-info bg-opacity-10 rounded p-3">
                                <i class="fas fa-calendar-check text-info fs-4"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <p class="text-muted mb-1">Transaksi Bulan Ini</p>
                            <h3 class="mb-0">89</h3>
                            <small class="text-info"><i class="fas fa-arrow-up"></i> +15% dari bulan lalu</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Transactions Table -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-transparent">
                    <h5 class="mb-0">Transaksi Terbaru</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Warga</th>
                                    <th>Jenis Iuran</th>
                                    <th>Jumlah</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Budi Santoso</td>
                                    <td>Iuran Kebersihan</td>
                                    <td>Rp 50.000</td>
                                    <td>06 Agustus 2025</td>
                                    <td><span class="badge bg-success">Lunas</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-primary">Detail</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Ani Wijaya</td>
                                    <td>Iuran Keamanan</td>
                                    <td>Rp 100.000</td>
                                    <td>05 Agustus 2025</td>
                                    <td><span class="badge bg-success">Lunas</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-primary">Detail</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Dedi Kurniawan</td>
                                    <td>Iuran Sampah</td>
                                    <td>Rp 25.000</td>
                                    <td>04 Agustus 2025</td>
                                    <td><span class="badge bg-warning">Pending</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-primary">Detail</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Font Awesome for icons -->
@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endpush

@push('scripts')
<script>
    console.log('Dashboard loaded successfully');
</script>
@endpush
@endsection
