<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Panduan Monitoring Strategis - Kepala Sekolah') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="mb-8 border-b pb-4">
                        <p class="text-lg">Berdasarkan hak akses Anda sebagai <strong>Kepala Sekolah</strong>, sistem menyediakan fitur manajerial untuk memantau kualitas prestasi siswa secara real-time guna mendukung pengambilan keputusan yang objektif:</p>
                    </div>

                    <div class="row mb-5 align-items-center">
                        <div class="col-md-6">
                            <h4 class="text-primary font-weight-bold">1. Monitoring Dashboard</h4>
                            <p>Dashboard utama memberikan ringkasan eksekutif mengenai total siswa yang terdata dan jumlah siswa yang masuk kategori "Sangat Berbakat" berdasarkan ambang batas nilai preferensi yang ditetapkan pada periode aktif.</p>
                        </div>
                        <div class="col-md-6">
                            <div class="card shadow-sm border-left-primary">

                                <div class="card-body py-2 bg-light text-center">
                                    <img src="{{ asset('images/kepalasekolah/monitoring.png') }}" class="card-img-top" alt="Ekspor Laporan">
                                    <div class="card-body py-2 bg-light text-center">
                                        <small class="text-muted">Gunakan visualisasi ini untuk meninjau distribusi talenta secara cepat.</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-5 align-items-center">
                        <div class="col-md-6 order-md-2">
                            <h4 class="text-primary font-weight-bold">2. Meninjau Hasil Ranking</h4>
                            <p>Anda dapat mengakses data perankingan lengkap yang disusun berdasarkan nilai preferensi tertinggi (V). Data ini mencakup transparansi nilai normalisasi dari seluruh kriteria yang telah divalidasi oleh sistem.</p>
                        </div>
                        <div class="col-md-6 order-md-1">
                            <div class="card shadow-sm border-left-primary">
                                <img src="{{ asset('images/kepalasekolah/ranking.png') }}" class="card-img-top" alt="Detail Ranking">
                                <div class="card-body py-2 bg-light text-center">
                                    <small class="text-muted">Data ranking diperbarui secara otomatis setelah input nilai dilakukan.</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-5 align-items-center border-top pt-4">
                        <div class="col-md-6">
                            <h4 class="text-danger font-weight-bold">3. Cetak Laporan (Export PDF)</h4>
                            <p>Fitur ekspor PDF memungkinkan Anda mengunduh laporan resmi per periode. Dokumen ini berfungsi sebagai arsip sekolah yang sah atau sebagai bahan evaluasi dalam rapat kenaikan kelas maupun pemberian beasiswa.</p>
                        </div>
                        <div class="col-md-6">
                            <div class="card shadow-sm border-left-danger">
                                <img src="{{ asset('images/kepalasekolah/pdf.png') }}" class="card-img-top" alt="Ekspor Laporan">
                                <div class="card-body py-2 bg-light text-center">
                                    <small class="text-muted">Laporan mencakup tanda tangan digital dan rincian kriteria penilaian.</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-primary shadow-sm border-left-primary mt-4">
                        <h5 class="alert-heading font-weight-bold"><i class="fas fa-info-circle"></i> Catatan Objektivitas:</h5>
                        <p class="mb-0">Seluruh data yang ditampilkan merupakan hasil perhitungan otomatis menggunakan metode <strong>Simple Additive Weighting (SAW)</strong>. Hal ini menjamin bahwa penentuan siswa berprestasi dilakukan secara transparan dan terukur tanpa campur tangan subjektivitas manual.</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>