<x-app-layout>
    <x-slot name="title">Edit User | Talenta Siswa</x-slot>

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Pengguna</h1>
        <a href="{{ route('users.index') }}" class="btn btn-secondary btn-sm shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
        </a>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Edit: {{ $user->name }}</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name">Nama Lengkap</label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Alamat Email</label>
                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="role_id">Role / Peran</label>
                            <select name="role_id" id="role_id" class="form-control @error('role_id') is-invalid @enderror" required>
                                <option value="">-- Pilih Role --</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}"
                                        data-name="{{ $role->name }}"
                                        {{ old('role_id', $user->role_id) == $role->id ? 'selected' : '' }}>
                                        {{ ucfirst($role->name) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('role_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        @php
                            $isSiswa = ($user->role && $user->role->name === 'siswa');
                            $studentData = $user->student; // Asumsi relasi hasOne ke model Student
                        @endphp

                        <div id="student-fields" style="display: {{ $isSiswa ? 'block' : 'none' }};">
                            <hr>
                            <div class="alert alert-info small">
                                Data NIS dan Kelas hanya dapat diubah melalui menu Data Siswa atau tambahkan logika update di Controller.
                            </div>
                            <div class="form-group">
                                <label for="nis">NIS (Nomor Induk Siswa)</label>
                                <input type="text" name="nis" id="nis" class="form-control" value="{{ $studentData ? $studentData->nis : '' }}" readonly>
                                <small class="text-muted italic">*Read-only pada halaman Edit User</small>
                            </div>
                        </div>

                        <div class="mt-4 text-right">
                            <button type="submit" class="btn btn-warning px-4 shadow-sm">
                                <i class="fas fa-save fa-sm"></i> Perbarui Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('role_id').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const roleName = selectedOption.getAttribute('data-name');
            const studentFields = document.getElementById('student-fields');

            if (roleName === 'siswa') {
                studentFields.style.display = 'block';
            } else {
                studentFields.style.display = 'none';
            }
        });
    </script>
</x-app-layout>