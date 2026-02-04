<x-app-layout>
    <x-slot name="title">Edit Kriteria | Talenta Siswa</x-slot>

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Kriteria SAW</h1>
        <a href="{{ route('criteria.index') }}" class="btn btn-secondary btn-sm shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
        </a>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Edit Kriteria: {{ $criterion->name }}</h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('criteria.update', $criterion->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name" class="font-weight-bold">Nama Kriteria</label>
                            <input type="text" name="name" id="name"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $criterion->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="type" class="font-weight-bold">Tipe (Benefit/Cost)</label>
                            <select name="type" id="type" class="form-control @error('type') is-invalid @enderror">
                                <option value="benefit" {{ old('type', $criterion->type) == 'benefit' ? 'selected' : '' }}>Benefit</option>
                                <option value="cost" {{ old('type', $criterion->type) == 'cost' ? 'selected' : '' }}>Cost</option>
                            </select>
                            @error('type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="weight" class="font-weight-bold">Bobot (0 - 1)</label>
                            <div class="input-group">
                                <input type="number" step="0.001" name="weight" id="weight"
                                    class="form-control @error('weight') is-invalid @enderror"
                                    value="{{ old('weight', $criterion->weight) }}" required>
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-weight-hanging"></i></span>
                                </div>
                                @error('weight')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <small class="form-text text-muted">
                                * Total akumulasi bobot kriteria lain saat ini (selain ini) adalah:
                                <strong>{{ number_format(\App\Models\Criterion::where('id', '!=', $criterion->id)->sum('weight'), 3) }}</strong>
                            </small>
                        </div>

                        <hr>

                        <div class="text-right">
                            <button type="submit" class="btn btn-warning px-4 shadow-sm text-dark font-weight-bold">
                                <i class="fas fa-save fa-sm"></i> Update Kriteria
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>