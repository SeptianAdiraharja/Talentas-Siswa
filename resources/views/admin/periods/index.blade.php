<x-app-layout>
    <x-slot name="title">Manajemen Periode | Talenta Siswa</x-slot>

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manajemen Periode</h1>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tambah Periode Baru</h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.periods.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">Nama Periode</label>
                            <div class="input-group">
                                <input type="text" name="name" id="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    placeholder="Contoh: Ganjil 2025/2026" required>
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <small class="form-text text-muted italic">
                                Periode baru yang dibuat akan berstatus nonaktif secara default.
                            </small>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Periode</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover text-center" width="100%" cellspacing="0">
                            <thead class="thead-light">
                                <tr>
                                    <th>Periode</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($periods as $period)
                                <tr>
                                    <td class="align-middle font-weight-bold text-gray-800">{{ $period->name }}</td>
                                    <td class="align-middle">
                                        @if($period->is_active)
                                            <span class="badge badge-success px-3 py-2">
                                                <i class="fas fa-check-circle"></i> Aktif
                                            </span>
                                        @else
                                            <span class="badge badge-secondary px-3 py-2">
                                                Nonaktif
                                            </span>
                                        @endif
                                    </td>
                                    <td class="align-middle">
                                        @if(!$period->is_active)
                                            <form method="POST" action="{{ route('admin.periods.activate', $period->id) }}">
                                                @csrf
                                                <button class="btn btn-sm btn-outline-success shadow-sm"
                                                        onclick="return confirm('Aktifkan periode ini? Periode lain yang aktif akan otomatis dinonaktifkan.')">
                                                    <i class="fas fa-power-off"></i> Aktifkan
                                                </button>
                                            </form>
                                        @else
                                            <button class="btn btn-sm btn-success px-3" disabled>
                                                <i class="fas fa-flag"></i> Sedang Berjalan
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>