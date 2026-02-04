<x-app-layout>
    <x-slot name="title">Nilai Saya | Talenta Siswa</x-slot>

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Nilai Bakat</h1>
        <div class="badge badge-primary px-3 py-2 shadow-sm">
            <i class="fas fa-calendar-alt mr-1"></i> Periode: {{ $period->name }}
        </div>
    </div>

    <div class="card shadow mb-4 border-left-info">
        <div class="card-body py-3">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Nama Mahasiswa</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $student->user->name }}</div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-user-graduate fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Rincian Penilaian</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-center" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th width="50">No</th>
                            <th>Kriteria</th>
                            <th>Jenis</th>
                            <th>Bobot</th>
                            <th>Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($scores as $index => $score)
                            <tr>
                                <td class="align-middle">{{ $index + 1 }}</td>
                                <td class="align-middle text-left font-weight-bold text-gray-800">
                                    {{ $score->criterion->name }}
                                </td>
                                <td class="align-middle text-capitalize">
                                    <span class="badge {{ $score->criterion->type == 'benefit' ? 'badge-success' : 'badge-warning text-dark' }}">
                                        {{ $score->criterion->type }}
                                    </span>
                                </td>
                                <td class="align-middle">{{ $score->criterion->weight }}</td>
                                <td class="align-middle font-weight-bold text-primary" style="font-size: 1.1rem;">
                                    {{ $score->value }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-4 text-muted italic">
                                    <i class="fas fa-info-circle mr-1"></i> Nilai belum tersedia untuk periode ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                <div class="alert alert-secondary border-0 small py-2 shadow-sm">
                    <i class="fas fa-lock mr-1"></i>
                    <strong>Informasi:</strong> Nilai bersifat permanen dan diinput langsung oleh guru pembimbing.
                </div>
            </div>
        </div>
    </div>
</x-app-layout>