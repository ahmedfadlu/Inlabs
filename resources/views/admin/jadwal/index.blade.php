@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <div class="card shadow">
        {{-- Ganti warna biru dengan warna sidebar (#00796B) --}}
        <div class="card-header text-white" style="background-color: #00796B;">
            <h4 class="mb-0">Jadwal Laboratorium</h4>
        </div>
        <div class="card-body">
            <a href="{{ route('admin.jadwal.create') }}" class="btn btn-primary mb-3">Tambah Jadwal</a>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Hari</th>
                        <th>Jam</th>
                        <th>Kegiatan</th>
                        <th>Dosen Pengampu</th>
                        <th>Laboratorium</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jadwals as $jadwal)
                    <tr>
                        <td>{{ $jadwal->hari }}</td>
                        <td>{{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}</td>
                        <td>{{ $jadwal->kegiatan }}</td>
                        <td>{{ $jadwal->dosen_pengampu }}</td>
                        <td>{{ $jadwal->laboratorium->nama_lab ?? 'Tidak Diketahui' }}</td>
                        <td>
                            <a href="{{ route('admin.jadwal.edit', $jadwal->id_jadwal) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admin.jadwal.destroy', $jadwal->id_jadwal) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Yakin hapus?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>
@endsection
