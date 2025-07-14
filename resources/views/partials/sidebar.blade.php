<h4 class="text-center mb-4">Menu InLabs</h4>
<hr class="border-light">

<a href="{{ route('admin.dashboard') }}" class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">
    <i class="fas fa-tachometer-alt me-2"></i> Dashboard
</a>

<a href="{{ route('admin.laboratorium.index') }}" class="{{ request()->is('admin/laboratorium*') ? 'active' : '' }}">
    <i class="fas fa-flask me-2"></i> Laboratorium
</a>

<a href="{{ route('admin.jadwal.index') }}" class="{{ request()->is('admin/jadwal*') ? 'active' : '' }}">
    <i class="fas fa-calendar-alt me-2"></i> Jadwal
</a>


<a href="#" class="">
    <i class="fas fa-book me-2"></i> Peminjaman
</a>

<a href="#" class="">
    <i class="fas fa-exclamation-triangle me-2"></i> Pengaduan
</a>

<form action="{{ route('admin.logout') }}" method="POST" class="mt-4 px-3">
    @csrf
    <button type="submit" class="btn btn-light text-dark w-100">
        <i class="fas fa-sign-out-alt me-2"></i> Logout
    </button>
</form>
