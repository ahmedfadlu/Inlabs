@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<p class="text-muted">Berikut adalah daftar laboratorium yang terdaftar di sistem.</p>

<div class="row">
    @foreach ($labs as $lab)
        <div class="col-md-4">
            <div class="card shadow-sm mb-4">
                {{-- Tampilkan gambar --}}
                @if ($lab->gambar_lab)
                    <img src="{{ asset('storage/' . $lab->gambar_lab) }}"
                         class="card-img-top"
                         alt="Gambar {{ $lab->nama_lab }}"
                         style="max-height: 180px; object-fit: cover;">
                @else
                    <img src="{{ asset('images/no-image.png') }}"
                         class="card-img-top"
                         alt="Tidak ada gambar"
                         style="max-height: 180px; object-fit: cover;">
                @endif

                <div class="card-body">
                    <h5 class="card-title">{{ $lab->nama_lab }}</h5>

                    <p>Status:
                        @if ($lab->status == 'tersedia')
                            <span class="badge bg-success">Tersedia</span>
                        @else
                            <span class="badge bg-danger">Dipakai</span>
                        @endif
                    </p>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
