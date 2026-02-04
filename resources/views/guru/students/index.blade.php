<x-app-layout>
    <x-slot name="title">Data Siswa | Guru</x-slot>

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Daftar Siswa</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Siswa untuk Input Nilai</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-center" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th width="50">No</th>
                            <th>NIS</th>
                            <th>Nama Siswa</th>
                            <th>Kelas</th>
                            <th width="150">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($students as $i => $student)
                        <tr>
                            <td class="align-middle">{{ $i + 1 }}</td>
                            <td class="align-middle font-weight-bold">{{ $student->nis }}</td>
                            <td class="align-middle text-left">
                                {{-- Mengambil nama dari relasi user --}}
                                {{ $student->user->name ?? 'Tanpa Nama' }}
                            </td>
                            <td class="align-middle">{{ $student->kelas }}</td>
                            <td class="align-middle">
                                <a href="{{ route('guru.scores.edit', $student->id) }}"
                                    class="btn btn-sm btn-warning">
                                    Edit Nilai
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">Belum ada data siswa yang terdaftar.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center my-3">
        {{ $students->links('pagination::bootstrap-5') }}
    </div>
</x-app-layout>