<x-app-layout>
    <x-slot name="title">Hasil Ranking | Talenta Siswa</x-slot>

    <div class="d-sm-flex align-items-center justify-content-center mb-4 text-center">
        <div>
            <h1 class="h3 mb-0 text-gray-800 font-weight-bold">Peringkat Talenta Siswa</h1>
            <div class="badge badge-primary px-3 py-2 mt-2 shadow-sm">
                <i class="fas fa-calendar-alt mr-1"></i> Periode: {{ $period->name }}
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-white">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-trophy mr-2"></i>Daftar Peringkat Teratas</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover text-center" width="100%" cellspacing="0">
                    <thead class="bg-light">
                        <tr>
                            <th width="80">Rank</th>
                            <th class="text-left">Nama Siswa</th>
                            <th>Nilai Akhir (V)</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $userRank = null;
                            $userData = null;

                            // Cari posisi user di seluruh data results
                            foreach ($results as $index => $res) {
                                if ($res['student']->id == $authStudentId) {
                                    $userRank = $index + 1;
                                    $userData = $res;
                                    break;
                                }
                            }
                        @endphp

                        {{-- Tampilkan TOP 3 --}}
                        @foreach (array_slice($results, 0, 3) as $i => $row)
                        @php $isMe = $authStudentId == $row['student']->id; @endphp
                        <tr class="{{ $isMe ? 'table-success' : '' }}">
                            <td class="align-middle font-weight-bold">
                                @if($i == 0)
                                    <span class="text-warning" style="font-size: 1.2rem;"><i class="fas fa-crown"></i> 1</span>
                                @elseif($i == 1)
                                    <span class="text-secondary"><i class="fas fa-medal"></i> 2</span>
                                @elseif($i == 2)
                                    <span class="text-danger"><i class="fas fa-medal"></i> 3</span>
                                @endif
                            </td>
                            <td class="align-middle text-left {{ $isMe ? 'font-weight-bold' : '' }}">
                                {{ $row['student']->user->name }} @if($isMe) <span class="badge badge-success ml-2">Anda</span> @endif
                            </td>
                            <td class="align-middle font-weight-bold">{{ $row['value'] }}</td>
                            <td class="align-middle">
                                <span class="badge badge-pill {{ $row['value'] >= 0.8 ? 'badge-success' : 'badge-info' }}">
                                    {{ $row['value'] >= 0.8 ? 'Sangat Berbakat' : 'Berbakat' }}
                                </span>
                            </td>
                        </tr>
                        @endforeach

                        {{-- Tampilkan Baris User jika di luar peringkat 3 --}}
                        @if($userRank > 3)
                        <tr>
                            <td colspan="4" class="py-1 bg-light text-muted small"><i class="fas fa-ellipsis-h"></i></td>
                        </tr>
                        <tr class="table-success border-top shadow-sm">
                            <td class="align-middle font-weight-bold text-success" style="font-size: 1.1rem;">
                                {{ $userRank }}
                            </td>
                            <td class="align-middle text-left font-weight-bold">
                                {{ $userData['student']->user->name }} <span class="badge badge-success ml-2">Anda</span>
                            </td>
                            <td class="align-middle font-weight-bold">{{ $userData['value'] }}</td>
                            <td class="align-middle">
                                <span class="badge badge-pill {{ $userData['value'] >= 0.6 ? 'badge-info' : 'badge-secondary' }}">
                                    {{ $userData['value'] >= 0.6 ? 'Berbakat' : 'Potensial' }}
                                </span>
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>