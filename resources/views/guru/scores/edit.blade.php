<x-app-layout>
    <x-slot name="title">Edit Nilai | Guru</x-slot>

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Nilai Bakat Siswa</h1>
        <a href="{{ route('guru.students') }}" class="btn btn-secondary btn-sm shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
        </a>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Mahasiswa & Periode</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless table-sm">
                                <tr>
                                    <td width="100"><strong>Nama</strong></td>
                                    <td>: {{ $student->user->name }}</td>
                                </tr>
                                <tr>
                                    <td><strong>NIS</strong></td>
                                    <td>: {{ $student->nis }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6 text-md-right">
                            <span class="badge badge-success px-3 py-2">
                                <i class="fas fa-calendar-check mr-1"></i> Periode Aktif: {{ $period->name }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Update Penilaian Kriteria</h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('guru.scores.update', $student->id) }}">
                        @csrf
                        @method('PUT')

                        @foreach($criteria as $criterion)
                        <div class="form-group mb-4">
                            <label for="crit-{{ $criterion->id }}" class="font-weight-bold text-gray-800">
                                {{ $criterion->name }}
                                <span class="badge badge-light border ml-1 text-capitalize">{{ $criterion->type }}</span>
                            </label>

                            <div class="input-group">
                                <input type="number"
                                       step="0.01"
                                       min="0"
                                       name="scores[{{ $criterion->id }}]"
                                       id="crit-{{ $criterion->id }}"
                                       value="{{ old('scores.'.$criterion->id, $scores[$criterion->id]->value ?? '') }}"
                                       class="form-control @error('scores.'.$criterion->id) is-invalid @enderror"
                                       placeholder="Masukkan nilai"
                                       required>
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-edit text-warning"></i></span>
                                </div>
                            </div>
                            @error('scores.'.$criterion->id)
                                <div class="small text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        @endforeach

                        <hr>
                        <div class="text-right">
                            <button type="submit" class="btn btn-warning px-4 shadow-sm text-dark font-weight-bold">
                                <i class="fas fa-save fa-sm mr-1"></i> Update Nilai
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>