@extends('layouts.admin')

@section('title', 'Tambah Jadwal')

@section('content')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header" style="background-color: #00796B; color: white;">
            <h4 class="mb-0">Tambah Jadwal Laboratorium</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.jadwal.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="id_lab" class="form-label">Laboratorium</label>
                    <select name="id_lab" class="form-select" required>
                        <option value="">-- Pilih Laboratorium --</option>
                        @foreach ($laboratoriums as $lab)
                            <option value="{{ $lab->id_lab }}">{{ $lab->nama_lab }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="hari" class="form-label">Hari</label>
                    <input type="text" name="hari" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="jam_mulai" class="form-label">Jam Mulai</label>
                    <input type="time" name="jam_mulai" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="jam_selesai" class="form-label">Jam Selesai</label>
                    <input type="time" name="jam_selesai" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="kegiatan" class="form-label">Kegiatan</label>
                    <input type="text" name="kegiatan" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="dosen_pengampu" class="form-label">Dosen Pengampu</label>
                    <input type="text" name="dosen_pengampu" class="form-control" required>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.jadwal.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn text-white" style="background-color: #00796B;">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
