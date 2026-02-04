<x-app-layout>
    <x-slot name="title">Dashboard Guru | Talenta Siswa</x-slot>

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Ringkasan Guru</h1>
        @if($periodeAktif)
            <span class="badge badge-success shadow-sm px-3 py-2">
                <i class="fas fa-calendar-check mr-1"></i> Periode Aktif: {{ $periodeAktif->name }}
            </span>
        @endif
    </div>

    <div class="row">
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Siswa Terdaftar</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalSiswa }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Status Penilaian
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $sudahDinilai }}/{{ $totalSiswa }}</div>
                                </div>
                                <div class="col">
                                    @php
                                        $persen = $totalSiswa > 0 ? ($sudahDinilai / $totalSiswa) * 100 : 0;
                                    @endphp
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar"
                                            style="width: {{ $persen }}%" aria-valuenow="{{ $persen }}" aria-valuemin="0"
                                            aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Lihat Hasil SAW</div>
                            <a href="{{ route('guru.ranking') }}" class="btn btn-warning btn-sm font-weight-bold text-dark mt-2 shadow-sm">
                                <i class="fas fa-trophy mr-1"></i> Buka Ranking
                            </a>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-star fa-2x text-gray-300"></i>
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
                    <h6 class="m-0 font-weight-bold text-primary">Panduan Singkat Guru</h6>
                </div>
                <div class="card-body">
                    <p>Selamat datang, <strong>{{ auth()->user()->name }}</strong>. Sebagai Guru, Anda memiliki tanggung jawab untuk:</p>
                    <div class="row mt-4 text-center">
                        <div class="col-md-6 mb-3">
                            <div class="p-4 border rounded bg-light">
                                <i class="fas fa-user-edit fa-3x text-primary mb-3"></i>
                                <h5>1. Input Nilai</h5>
                                <p class="small text-muted">Klik menu "Data Siswa" untuk menginputkan nilai bakat mahasiswa berdasarkan kriteria yang ada.</p>
                                <a href="{{ route('guru.students') }}" class="btn btn-outline-primary btn-sm">Mulai Menilai</a>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="p-4 border rounded bg-light">
                                <i class="fas fa-chart-bar fa-3x text-success mb-3"></i>
                                <h5>2. Pantau Ranking</h5>
                                <p class="small text-muted">Sistem akan otomatis menghitung skor SAW setelah nilai diinput. Pantau hasilnya di menu Ranking.</p>
                                <a href="{{ route('guru.ranking') }}" class="btn btn-outline-success btn-sm">Lihat Ranking</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>