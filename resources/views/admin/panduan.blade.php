<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Panduan Operasional Tata Usaha (TU)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="mb-8 border-b pb-4">
                        <p class="text-lg">Berdasarkan hak akses Anda sebagai <strong>TU</strong>, berikut adalah alur kerja sistematis yang harus dilakukan untuk mengelola data talenta siswa:</p>
                    </div>

                    <div class="row mb-5 align-items-center">
                        <div class="col-md-6">
                            <h4 class="text-primary font-weight-bold">1. Login & Autentikasi</h4>
                            <p>Langkah pertama adalah mengakses halaman login dan memasukkan kredensial akun TU Anda. Sistem akan memverifikasi peran Anda untuk membuka fitur manajemen data.</p>
                        </div>
                        <div class="col-md-6">
                            <div class="card shadow-sm">
                                <img src="{{ asset('images/admin/login.png') }}" class="card-img-top" alt="Halaman Login">
                                <div class="card-body py-2 bg-light text-center">
                                    <small class="text-muted">Pastikan URL menunjukkan domain sekolah yang benar.</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-5 align-items-center">
                        <div class="col-md-6 order-md-2">
                            <h4 class="text-primary font-weight-bold">2. Kelola Data User</h4>
                            <p>Melalui menu <strong>Manajemen User</strong>, Anda bertanggung jawab mendaftarkan Guru, Siswa, dan Kepala Sekolah. Tanpa akun yang dibuat oleh TU, pengguna lain tidak dapat masuk ke sistem.</p>
                        </div>
                        <div class="col-md-6 order-md-1">
                            <div class="card shadow-sm">
                                <img src="{{ asset('images/admin/user.png') }}" class="card-img-top" alt="Manajemen User">
                                <div class="card-body py-2 bg-light text-center">
                                    <small class="text-muted">Gunakan fitur 'Import' jika ingin mendaftarkan banyak siswa sekaligus.</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-5 align-items-center">
                        <div class="col-md-6">
                            <h4 class="text-primary font-weight-bold">3. Kelola Kriteria & Bobot</h4>
                            <p>Sistem menggunakan metode SAW. Anda harus menentukan kriteria (Benefit/Cost) dan bobot masing-masing. Perubahan bobot di sini akan secara otomatis memperbarui seluruh hasil kalkulasi ranking.</p>
                        </div>
                        <div class="col-md-6">
                            <div class="card shadow-sm">
                                <img src="{{ asset('images/admin/talenta.png') }}" class="card-img-top" alt="Manajemen Kriteria">
                                <div class="card-body py-2 bg-light text-center">
                                    <small class="text-muted">Total bobot biasanya berjumlah 1 (atau 100%).</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-5 align-items-center">
                        <div class="col-md-6 order-md-2">
                            <h4 class="text-primary font-weight-bold">4. Aktivasi Periode</h4>
                            <p>Siswa tidak akan muncul di halaman Guru jika periode belum diaktifkan. TU harus membuat periode baru (contoh: Ganjil 2026) dan mengubah statusnya menjadi <strong>Aktif</strong>.</p>
                        </div>
                        <div class="col-md-6 order-md-1">
                            <div class="card shadow-sm">
                                <img src="{{ asset('images/admin/periode.png') }}" class="card-img-top" alt="Aktivasi Periode">
                                <div class="card-body py-2 bg-light text-center">
                                    <small class="text-muted">Hanya satu periode yang boleh aktif dalam satu waktu.</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-5 align-items-center border-top pt-4">
                        <div class="col-md-6">
                            <h4 class="text-danger font-weight-bold">5 & 6. Ranking & Cetak Laporan</h4>
                            <p>Setelah Guru selesai menginput nilai, Anda dapat memantau ranking. Langkah terakhir adalah mengunduh <strong>Laporan PDF</strong> untuk diserahkan sebagai arsip resmi kepada Kepala Sekolah.</p>
                        </div>
                        <div class="col-md-6">
                            <div class="card shadow-sm">
                                <img src="{{ asset('images/admin/pdf.png') }}" class="card-img-top" alt="Cetak PDF">
                                <div class="card-body py-2 bg-light text-center">
                                    <small class="text-muted">Laporan PDF mencakup nilai akhir dan peringkat siswa.</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-info shadow-sm">
                        <h5 class="alert-heading font-weight-bold"><i class="fas fa-info-circle"></i> Tips Penting:</h5>
                        <p class="mb-0">Selalu pastikan data kriteria sudah final sebelum periode diaktifkan untuk menghindari inkonsistensi data penilaian guru.</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>