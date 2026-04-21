@extends('layout.calonsiswa')

@section('title', 'Profil Saya')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Profil Saya</h3>
                <p class="text-subtitle text-muted">Kelola informasi akun Anda</p>
            </div>
        </div>
    </div>

    <section class="section">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <div class="row">
            {{-- Kartu Info --}}
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body py-4">
                        <div class="mb-3">
                            <div class="rounded-circle bg-primary d-inline-flex align-items-center justify-content-center"
                                style="width:80px;height:80px;">
                                <span class="text-white fw-bold fs-2">{{ strtoupper(substr($user->nama, 0, 1)) }}</span>
                            </div>
                        </div>
                        <h5 class="mb-1">{{ $user->nama }}</h5>
                        <p class="text-muted mb-2">{{ $user->email }}</p>
                        <span class="badge bg-primary">Calon Siswa</span>
                        <span class="badge bg-{{ $user->aktif ? 'success' : 'danger' }} ms-1">
                            {{ $user->aktif ? 'Aktif' : 'Tidak Aktif' }}
                        </span>
                    </div>
                </div>
            </div>

            {{-- Form --}}
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a class="nav-link {{ session('tab') != 'password' ? 'active' : '' }}"
                                   data-bs-toggle="tab" href="#tab-info">
                                    <i class="bi bi-person me-1"></i> Informasi Akun
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ session('tab') == 'password' ? 'active' : '' }}"
                                   data-bs-toggle="tab" href="#tab-password">
                                    <i class="bi bi-lock me-1"></i> Ganti Password
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">

                            {{-- Tab Info --}}
                            <div class="tab-pane fade {{ session('tab') != 'password' ? 'show active' : '' }}" id="tab-info">
                                <form action="{{ route('profil.update') }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Nama Lengkap</label>
                                        <input type="text" name="nama"
                                            class="form-control @error('nama') is-invalid @enderror"
                                            value="{{ old('nama', $user->nama) }}" required>
                                        @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Email</label>
                                        <input type="email" name="email"
                                            class="form-control @error('email') is-invalid @enderror"
                                            value="{{ old('email', $user->email) }}" required>
                                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">No. HP</label>
                                        <input type="tel" name="hp" id="hp"
                                            class="form-control @error('hp') is-invalid @enderror"
                                            value="{{ old('hp', $user->hp) }}" maxlength="13" inputmode="numeric">
                                        @error('hp')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-save me-1"></i> Simpan Perubahan
                                    </button>
                                </form>
                            </div>

                            {{-- Tab Password --}}
                            <div class="tab-pane fade {{ session('tab') == 'password' ? 'show active' : '' }}" id="tab-password">
                                <form action="{{ route('profil.password') }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Password Lama</label>
                                        <input type="password" name="password_lama"
                                            class="form-control @error('password_lama') is-invalid @enderror" required>
                                        @error('password_lama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Password Baru</label>
                                        <input type="password" name="password"
                                            class="form-control @error('password') is-invalid @enderror" required minlength="6">
                                        @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Konfirmasi Password Baru</label>
                                        <input type="password" name="password_confirmation" class="form-control" required minlength="6">
                                    </div>
                                    <button type="submit" class="btn btn-warning">
                                        <i class="bi bi-lock me-1"></i> Ganti Password
                                    </button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
document.getElementById('hp')?.addEventListener('keydown', function(e) {
    const allowed = ['Backspace','Delete','ArrowLeft','ArrowRight','Tab','Home','End'];
    if (allowed.includes(e.key)) return;
    if (!/^[0-9]$/.test(e.key)) e.preventDefault();
});
document.getElementById('hp')?.addEventListener('input', function() {
    this.value = this.value.replace(/\D/g, '');
});
</script>
@endsection
