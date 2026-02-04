<x-app-layout>
    <x-slot name="title">Manajemen Kriteria Talenta Siswa | Talenta Siswa</x-slot>

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manajemen Kriteria Talenta Siswa</h1>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-info border-left-info shadow">
                Total Bobot Saat Ini: <strong>{{ number_format($totalWeight, 3) }}</strong>
            </div>

            @if($totalWeight < 1)
                <div class="alert alert-warning border-left-warning shadow">
                    <i class="fas fa-exclamation-triangle"></i>
                    Total bobot belum 1. Perhitungan Talenta Siswa belum bisa dijalankan secara akurat.
                </div>
            @endif
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Kriteria</h6>
            <a href="{{ route('criteria.create') }}" class="btn btn-primary btn-sm shadow-sm">
                <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Kriteria
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-center" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th>Nama Kriteria</th>
                            <th>Tipe</th>
                            <th>Bobot</th>
                            <th width="150">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($criteria as $c)
                        <tr>
                            <td class="align-middle text-left font-weight-bold">{{ $c->name }}</td>
                            <td class="align-middle">
                                <span class="badge {{ $c->type == 'benefit' ? 'badge-success' : 'badge-danger' }} px-3 py-2">
                                    {{ ucfirst($c->type) }}
                                </span>
                            </td>
                            <td class="align-middle">{{ $c->weight }}</td>
                            <td class="align-middle">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('criteria.edit', $c->id) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('criteria.destroy', $c->id) }}" method="POST" class="d-inline ml-1">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus kriteria ini?')">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">Belum ada data kriteria.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>