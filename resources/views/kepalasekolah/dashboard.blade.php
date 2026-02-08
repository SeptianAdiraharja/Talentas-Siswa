<x-app-layout>
    {{-- Cek apakah variabel $stats tersedia --}}
    @if(isset($stats))
    <div class="row">
        <div class="col-md-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Siswa Terdata</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['total_siswa'] }}</div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Sangat Berbakat (V >= 0.8)</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['berprestasi_tinggi'] }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Preview 3 Besar Siswa - Periode {{ $period->name }}</h6>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Rank</th>
                                <th>Nama Siswa</th>
                                <th>Nilai Preferensi (V)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($stats['top_3'] as $index => $row)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $row['student']->user->name }}</td>
                                <td><span class="badge badge-info">{{ $row['value'] }}</span></td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center">Belum ada data nilai pada periode ini.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <a href="{{ route('kepalasekolah.ranking') }}" class="btn btn-primary btn-sm">Lihat Semua Ranking</a>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="alert alert-warning">Data statistik tidak tersedia.</div>
    @endif
</x-app-layout>