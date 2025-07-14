@extends('layouts.admin')

@section('title', 'Edit Laboratorium')

@section('content')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header" style="background-color: #00796B; color: white;">
            <h4 class="mb-0">Edit Laboratorium</h4>
        </div>
        <div class="card-body">

            {{-- Flash Message Sukses --}}
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            {{-- Flash Message Error --}}
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            {{-- Validation Error --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Terjadi kesalahan:</strong>
                    <ul>
                        @foreach ($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.laboratorium.update', $lab->id_lab) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Nama Lab --}}
                <div class="mb-3">
                    <label for="nama_lab" class="form-label">Nama Laboratorium</label>
                    <input type="text" name="nama_lab" class="form-control" value="{{ old('nama_lab', $lab->nama_lab) }}" required>
                </div>

                {{-- Lokasi --}}
                <div class="mb-3">
                    <label for="lokasi" class="form-label">Lokasi</label>
                    <input type="text" name="lokasi" class="form-control" value="{{ old('lokasi', $lab->lokasi) }}" required>
                </div>

                {{-- Kapasitas --}}
                <div class="mb-3">
                    <label for="kapasitas" class="form-label">Kapasitas</label>
                    <input type="number" name="kapasitas" class="form-control" value="{{ old('kapasitas', $lab->kapasitas) }}" required>
                </div>

                {{-- Status --}}
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" class="form-select" required>
                        <option value="tersedia" {{ old('status', $lab->status) == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                        <option value="dipakai" {{ old('status', $lab->status) == 'dipakai' ? 'selected' : '' }}>Tidak Tersedia</option>
                    </select>
                </div>

                {{-- Gambar --}}
                <div class="mb-3">
                    <label for="gambar_lab" class="form-label">Ganti Gambar</label>
                    <input type="file" name="gambar_lab" class="form-control" accept="image/*" onchange="previewImage(event)">
                    @if ($lab->gambar_lab)
                        <img src="{{ asset('storage/' . $lab->gambar_lab) }}" id="preview" class="img-thumbnail mt-2" style="max-height: 200px;">
                    @else
                        <img id="preview" class="img-thumbnail mt-2" style="display:none; max-height: 200px;">
                    @endif
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.laboratorium.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn text-white" style="background-color: #00796B;">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function previewImage(event) {
    const preview = document.getElementById('preview');
    const input = event.target;
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
