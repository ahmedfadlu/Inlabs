@extends('layouts.admin')

@section('title', 'Data Laboratorium')

@section('content')
<div class="content-wrapper">
  <div class="row page-title-header">
    <div class="col-12">
      <div class="page-header">
        
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Data Laboratorium</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>

  @if (session('success'))
    <div class="alert alert-success">
      {{ session('success') }}
    </div>
  @endif

  @if (session('error'))
    <div class="alert alert-danger">
      {{ session('error') }}
    </div>
  @endif

  <div class="card">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="card-title mb-0">Data Laboratorium</h4>
        <a href="{{ route('admin.laboratorium.create') }}" class="btn btn-sm btn-primary btn-rounded">
          <i class="fa fa-plus"></i> Tambah Data
        </a>
      </div>
      <p>Berikut adalah beberapa data laboratorium yang tercatat.</p>
      <div class="table-responsive">
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th>Lab ID</th>
              <th>Nama</th>
              <th>Status</th>
              <th>Gambar</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
                        @foreach ($labs as $index => $lab)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $lab->nama_lab }}</td>
                    <td>{{ ucfirst($lab->status) }}</td>
                    <td>
                        @if($lab->gambar_lab)
                            <img src="{{ asset('storage/' . $lab->gambar_lab) }}" alt="Gambar Lab" width="100">
                        @else
                            <span class="text-muted">Tidak ada gambar</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.laboratorium.edit', $lab->id_lab) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>

                        <form action="{{ route('admin.laboratorium.destroy', $lab->id_lab) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash-alt"></i> Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach


            @if($labs->isEmpty())
              <tr>
                <td colspan="5" class="text-center">Tidak ada data laboratorium.</td>
              </tr>
            @endif
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
