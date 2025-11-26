@extends('layout.admin')

@section('content')
<div class="main-content container-fluid">
    <div class="page-title mb-4">
        <h3>Profil Pengguna</h3>
        <p class="text-subtitle text-muted">Informasi akun dan pengaturan profil</p>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <div class="avatar avatar-xl mb-3">
                        <img src="{{ asset('assets/images/faces/1.jpg') }}" alt="Avatar" class="rounded-circle">
                    </div>
                    <h5>{{ $user->nama }}</h5>
                    <p class="text-muted">{{ ucfirst($user->role) }}</p>
                    <span class="badge bg-{{ $user->aktif ? 'success' : 'danger' }}">
                        {{ $user->aktif ? 'Aktif' : 'Tidak Aktif' }}
                    </span>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5>Informasi Akun</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <strong>Nama Lengkap:</strong>
                        </div>
                        <div class="col-sm-9">
                            {{ $user->nama }}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <strong>Email:</strong>
                        </div>
                        <div class="col-sm-9">
                            {{ $user->email }}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <strong>No. HP:</strong>
                        </div>
                        <div class="col-sm-9">
                            {{ $user->hp ?? 'Belum diisi' }}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <strong>Role:</strong>
                        </div>
                        <div class="col-sm-9">
                            <span class="badge bg-primary">{{ ucfirst($user->role) }}</span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <strong>Status:</strong>
                        </div>
                        <div class="col-sm-9">
                            <span class="badge bg-{{ $user->aktif ? 'success' : 'danger' }}">
                                {{ $user->aktif ? 'Aktif' : 'Tidak Aktif' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection