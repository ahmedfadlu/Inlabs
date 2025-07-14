@extends('layouts.admin')

@section('title', 'Tambah Laboratorium')

@section('content')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header" style="background-color: #00796B; color: white;">
            <h4 class="mb-0">Tambah Laboratorium</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.laboratorium.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="nama_lab" class="form-label">Nama Laboratorium</label>
                    <input type="text" name="nama_lab" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="lokasi" class="form-label">Lokasi</label>
                    <input type="text" name="lokasi" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="kapasitas" class="form-label">Kapasitas</label>
                    <input type="number" name="kapasitas" class="form-control" min="1" required>
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" class="form-select" required>
                        <option value="tersedia">Tersedia</option>
                        <option value="dipakai">Tidak Tersedia</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="gambar_lab" class="form-label">Upload Gambar</label>
                    <input type="file" name="gambar_lab" class="form-control" accept="image/*" onchange="previewImage(event)">
                    <img id="preview" class="img-thumbnail mt-2" style="display:none; max-height: 200px;">
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.laboratorium.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn text-white" style="background-color: #00796B;">Simpan</button>
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
