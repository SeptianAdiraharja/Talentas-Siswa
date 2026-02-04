<x-app-layout>
    <x-slot name="title">Hasil Ranking Talenta Siswa | Talenta Siswa</x-slot>

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Hasil Ranking Talenta Siswa</h1>
        <div class="badge badge-primary px-3 py-2 shadow-sm">
            <i class="fas fa-calendar-alt mr-1"></i> Periode: {{ $period->name }}
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card border-left-success shadow mb-4">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Status Perhitungan</div>
                            <div class="h6 mb-0 font-weight-bold text-gray-800">
                                Perankingan otomatis berdasarkan bobot kriteria yang telah ditentukan.
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calculator fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Urutan Talenta Siswa</h6>
            <button class="btn btn-sm btn-info shadow-sm" onclick="window.print()">
                <i class="fas fa-print fa-sm text-white-50"></i> Cetak Laporan
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="rankingTable" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr class="text-center">
                            <th width="80">Ranking</th>
                            <th>Nama Siswa</th>
                            <th>NIS</th>
                            <th>Nilai Preferensi (V)</th>
                            <th>Label</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($results as $i => $row)
                        <tr>
                            <td class="text-center align-middle">
                                @if($i == 0)
                                    <span class="badge badge-warning p-2" style="font-size: 1rem;">
                                        <i class="fas fa-trophy"></i> 1
                                    </span>
                                @else
                                    <span class="font-weight-bold">{{ $i + 1 }}</span>
                                @endif
                            </td>
                            <td class="align-middle font-weight-bold text-gray-800">
                                {{ $row['student']->user->name }}
                            </td>
                            <td class="align-middle text-center">
                                {{ $row['student']->nis }}
                            </td>
                            <td class="align-middle text-center">
                                <div class="progress progress-sm mr-2 mb-1">
                                    <div class="progress-bar bg-primary" role="progressbar"
                                         style="width: {{ $row['value'] * 100 }}%"
                                         aria-valuenow="{{ $row['value'] }}" aria-valuemin="0" aria-valuemax="1"></div>
                                </div>
                                <span class="text-primary font-weight-bold">{{ $row['value'] }}</span>
                            </td>
                            <td class="text-center align-middle">
                                @if($row['value'] >= 0.8)
                                    <span class="badge badge-success">Sangat Berbakat</span>
                                @elseif($row['value'] >= 0.6)
                                    <span class="badge badge-info">Berbakat</span>
                                @else
                                    <span class="badge badge-secondary">Potensial</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">Belum ada data nilai pada periode ini.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-center my-3">
        {{ $students->links('pagination::bootstrap-5') }}
    </div>
</x-app-layout>