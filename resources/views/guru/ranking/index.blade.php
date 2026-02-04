<x-app-layout>
    <x-slot name="title">Ranking Siswa | Guru</x-slot>

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Daftar Perankingan Siswa</h1>
        <div class="badge badge-success px-3 py-2 shadow-sm">
            <i class="fas fa-calendar-check mr-1"></i> Periode Aktif: {{ $period->name }}
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-trophy mr-1"></i> Urutan Bakat Siswa (Hasil Akhir)</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-center" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th width="80">Ranking</th>
                            <th>Nama Siswa</th>
                            <th>NIS</th>
                            <th>Skor Preferensi (V)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($results as $i => $row)
                        <tr>
                            <td class="align-middle">
                                @if($i == 0)
                                    <span class="badge badge-warning p-2"><i class="fas fa-trophy"></i> 1</span>
                                @else
                                    <span class="font-weight-bold">{{ $i + 1 }}</span>
                                @endif
                            </td>
                            <td class="align-middle text-left font-weight-bold text-gray-800">
                                {{ $row['student']->user->name }}
                            </td>
                            <td class="align-middle">{{ $row['student']->nis }}</td>
                            <td class="align-middle">
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto mr-2">
                                        <div class="h6 mb-0 font-weight-bold text-primary">{{ $row['value'] }}</div>
                                    </div>
                                    <div class="col">
                                        <div class="progress progress-sm mr-2">
                                            <div class="progress-bar bg-primary" role="progressbar"
                                                style="width: {{ $row['value'] * 100 }}%"
                                                aria-valuenow="{{ $row['value'] }}" aria-valuemin="0" aria-valuemax="1"></div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center italic">Belum ada data nilai yang diproses.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

        <div class="card shadow mb-4">
        <div class="card-header py-3 bg-light">
            <h6 class="m-0 font-weight-bold text-dark"><i class="fas fa-th mr-1"></i> Matriks Normalisasi (R)</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm table-bordered text-center" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Nama Siswa</th>
                            @foreach($criteria as $c)
                                <th>{{ $c->name }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($results as $row)
                        <tr>
                            <td class="text-left font-weight-bold small">{{ $row['student']->user->name }}</td>
                            @foreach($criteria as $c)
                                <td class="text-primary font-weight-bold">
                                    {{ $row['matrix'][$c->id] ?? 0 }}
                                </td>
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-2">
                <small class="text-muted">* Nilai di atas adalah hasil pembagian nilai mentah dengan nilai Max/Min kriteria.</small>
            </div>
            
            <div class="d-flex justify-content-center my-3">
                    {{ $students->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</x-app-layout>