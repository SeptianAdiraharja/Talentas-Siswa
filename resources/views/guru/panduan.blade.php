<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Panduan Operasional Guru - Penilaian Siswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="mb-8 border-b pb-4">
                        <p class="text-lg">Berdasarkan hak akses Anda sebagai <strong>Guru</strong>, berikut adalah langkah-langkah sistematis untuk melakukan input nilai dan memantau perkembangan talenta siswa:</p>
                    </div>

                    <div class="row mb-5 align-items-center">
                        <div class="col-md-6">
                            <h4 class="text-success font-weight-bold">1. Login & Masuk Dashboard</h4>
                            <p>Setelah login, Anda akan diarahkan ke dashboard khusus guru. Di sini Anda dapat memantau statistik ringkasan, seperti jumlah siswa yang sudah dinilai dan yang belum dinilai pada periode aktif.</p>
                        </div>
                        <div class="col-md-6">
                            <div class="card shadow-sm border-left-success">
                                <img src="{{ asset('images/guru/dashboard.png') }}" class="card-img-top" alt="Dashboard Guru">
                                <div class="card-body py-2 bg-light text-center">
                                    <small class="text-muted">Pantau grafik progres penilaian Anda di halaman ini.</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-5 align-items-center">
                        <div class="col-md-6 order-md-2">
                            <h4 class="text-success font-weight-bold">2. Input Nilai Siswa</h4>
                            <p>Pilih menu <strong>Data Siswa</strong> untuk melihat daftar kelas. Klik tombol <strong>Input Nilai</strong> pada baris siswa yang bersangkutan untuk memasukkan skor berdasarkan kriteria (Benefit/Cost) yang telah ditentukan oleh TU.</p>
                        </div>
                        <div class="col-md-6 order-md-1">
                            <div class="card shadow-sm border-left-success">
                                 <img src="{{ asset('images/guru/nilai.png') }}" class="card-img-top" alt="Nilai Siswa">
                                <div class="card-body py-2 bg-light text-center">
                                    <small class="text-muted">Pastikan semua kolom kriteria terisi sebelum menyimpan.</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-5 align-items-center">
                        <div class="col-md-6">
                            <h4 class="text-success font-weight-bold">3. Lihat Matriks Normalisasi</h4>
                            <p>Sistem secara otomatis mengonversi nilai mentah Anda menggunakan metode <em>Simple Additive Weighting</em> (SAW). Anda dapat memeriksa transparansi data pada halaman Matriks untuk melihat nilai bobot setiap siswa.</p>
                        </div>
                        <div class="col-md-6">
                            <div class="card shadow-sm border-left-success">
                                 <img src="{{ asset('images/guru/normalisasi.png') }}" class="card-img-top" alt="Matriks Normalisasi">
                                <div class="card-body py-2 bg-light text-center">
                                    <small class="text-muted">Nilai normalisasi berada pada rentang 0 hingga 1.</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-5 align-items-center border-top pt-4">
                        <div class="col-md-6 order-md-2">
                            <h4 class="text-primary font-weight-bold">4. Monitoring Hasil Ranking</h4>
                            <p>Setelah seluruh proses input selesai, Anda dapat meninjau urutan perankingan pada menu <strong>Ranking</strong>. Halaman ini menampilkan peringkat siswa berdasarkan nilai preferensi (V) akhir secara otomatis.</p>
                        </div>
                        <div class="col-md-6 order-md-1">
                            <div class="card shadow-sm border-left-primary">
                                <img src="{{ asset('images/guru/ranking.png') }}" class="card-img-top" alt="Ranking Siswa">
                                <div class="card-body py-2 bg-light text-center">
                                    <small class="text-muted">Urutan peringkat ditentukan oleh akumulasi nilai bobot kriteria.</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-warning shadow-sm border-left-warning mt-4">
                        <h5 class="alert-heading font-weight-bold"><i class="fas fa-exclamation-circle"></i> Catatan Penting:</h5>
                        <p class="mb-0">Jika tombol input nilai tidak aktif atau daftar siswa kosong, silakan hubungi bagian <strong>TU</strong> untuk memastikan <strong>Aktivasi Periode</strong> sudah dilakukan.</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>