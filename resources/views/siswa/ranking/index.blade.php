<x-app-layout>
    <x-slot name="title">Hasil Ranking | Talenta Siswa</x-slot>

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Peringkat Talenta Siswa</h1>
        <div class="badge badge-info px-3 py-2 shadow-sm">
            <i class="fas fa-calendar-alt mr-1"></i> Periode: {{ $period->name }}
        </div>
    </div>

    <div class="alert alert-white shadow-sm border-left-primary">
        <i class="fas fa-info-circle text-primary mr-2"></i>
        Daftar berikut menampilkan hasil perhitungan bakat siswa menggunakan metode <strong>Simple Additive Weighting (SAW)</strong>. Baris berwarna hijau menunjukkan posisi Anda.
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Hasil Akhir Perankingan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-center" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th width="80">Rank</th>
                            <th>Nama Siswa</th>
                            <th>Nilai Akhir (V)</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($results as $i => $row)
                        @php
                            // Cek apakah baris ini adalah milik siswa yang sedang login
                            $isMe = auth()->user()->student->id == $row['student']->id;
                        @endphp
                        <tr class="{{ $isMe ? 'table-success' : '' }}">
                            <td class="align-middle font-weight-bold">
                                @if($i == 0)
                                    <span class="text-warning"><i class="fas fa-medal"></i> 1</span>
                                @else
                                    {{ $i + 1 }}
                                @endif
                            </td>
                            <td class="align-middle text-left {{ $isMe ? 'font-weight-bold' : '' }}">
                                {{ $row['student']->user->name }}
                                @if($isMe) (Anda) @endif
                            </td>
                            <td class="align-middle text-primary font-weight-bold">
                                {{ $row['value'] }}
                            </td>
                            <td class="align-middle">
                                @if($row['value'] >= 0.8)
                                    <span class="badge badge-success">Sangat Berbakat</span>
                                @elseif($row['value'] >= 0.6)
                                    <span class="badge badge-info">Berbakat</span>
                                @else
                                    <span class="badge badge-secondary">Potensial</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>