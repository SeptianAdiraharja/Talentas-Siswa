<x-app-layout>
    <x-slot name="title">Dashboard Siswa | Talenta Siswa</x-slot>

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard Siswa</h1>
        @if($periodeAktif)
            <div class="badge badge-primary px-3 py-2 shadow-sm">
                <i class="fas fa-calendar-alt mr-1"></i> Periode: {{ $periodeAktif->name }}
            </div>
        @endif
    </div>

    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="card shadow border-left-primary">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <h4 class="font-weight-bold text-primary mb-1">Selamat Datang, {{ auth()->user()->name }}!</h4>
                            <p class="text-gray-800 mb-0">NIS: <span class="badge badge-light border">{{ $student->nis ?? '-' }}</span> | Kelas: <span class="badge badge-light border">{{ $student->kelas ?? '-' }}</span></p>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-graduate fa-3x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card shadow h-100 py-2 {{ $hasScores ? 'border-left-success' : 'border-left-warning' }}">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold {{ $hasScores ? 'text-success' : 'text-warning' }} text-uppercase mb-1">
                                Status Penilaian Bakat</div>
                            <div class="h6 mb-0 font-weight-bold text-gray-800">
                                @if($hasScores)
                                    <i class="fas fa-check-circle text-success mr-1"></i> Nilai Anda sudah tersedia
                                @else
                                    <i class="fas fa-clock text-warning mr-1"></i> Menunggu penilaian dari Guru
                                @endif
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-check fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card shadow h-100 py-2 border-left-info">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Hasil Ranking Terkini</div>
                            <div class="h6 mb-0 font-weight-bold text-gray-800 text-info">
                                <a href="{{ route('siswa.ranking') }}" class="text-decoration-none">
                                    Lihat posisi saya <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-trophy fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Penggunaan</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 border-right">
                            <h6 class="font-weight-bold"><i class="fas fa-lightbulb text-warning mr-2"></i> Menu Nilai Saya</h6>
                            <p class="small text-muted">Halaman ini menampilkan rincian nilai mentah Anda untuk setiap kriteria yang diinput oleh Guru. Nilai ini bersifat <i>read-only</i>.</p>
                            <a href="{{ route('siswa.nilai') }}" class="btn btn-primary btn-sm">Buka Nilai</a>
                        </div>
                        <div class="col-md-6">
                            <h6 class="font-weight-bold"><i class="fas fa-chart-line text-info mr-2"></i> Menu Ranking</h6>
                            <p class="small text-muted">Halaman ini menampilkan hasil akhir perhitungan metode <b>Simple Additive Weighting (SAW)</b> yang menentukan urutan bakat seluruh mahasiswa.</p>
                            <a href="{{ route('siswa.ranking') }}" class="btn btn-info btn-sm">Buka Ranking</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>