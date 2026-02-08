<x-app-layout>
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Hasil Ranking Periode: {{ $period->name }}</h6>
            <a href="{{ route('kepalasekolah.print', $period->id) }}" class="btn btn-sm btn-danger shadow-sm">
                <i class="fas fa-file-pdf fa-sm text-white-50"></i> Cetak PDF
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr class="text-center">
                            <th>Rank</th>
                            <th>NIS</th>
                            <th>Nama Siswa</th>
                            @foreach($criteria as $c)
                                <th>{{ $c->name }}</th>
                            @endforeach
                            <th>Nilai (V)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($results as $index => $row)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td class="text-center">{{ $row['student']->nis }}</td>
                            <td>{{ $row['student']->user->name }}</td>
                            @foreach($criteria as $c)
                                <td class="text-center">{{ $row['normalized_scores'][$c->id] ?? 0 }}</td>
                            @endforeach
                            <td class="text-center font-weight-bold text-primary">{{ number_format($row['value'], 4) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>