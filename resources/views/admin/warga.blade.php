  @extends('admin.template')
  @section('content')
  <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Daftar Warga</h5>
                     <a href="{{ route('register') }}" class="btn btn-primary mb-3">+ Tambah Warga</a>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>No HP</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->username }}</td>
                    <td>{{ $item->nohp }}</td>
                    <td>{{ $item->address }}</td>
                    <td>
                        <a href="{{ route('admin.users.edit', Crypt::encrypt($item->id)) }}" class="btn btn-sm btn-warning me-1">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('admin.users.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data warga {{ $item->name }}?')" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">Tidak ada data warga.</td>
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
    </div>
  @endsection
  