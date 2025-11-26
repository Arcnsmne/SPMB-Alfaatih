@extends('layout.calonsiswa')

@section('content')
<div class="page-content">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body text-center py-5">
                    <div class="mb-4">
                        <i class="bi bi-x-circle text-danger" style="font-size: 5rem;"></i>
                    </div>
                    <h3 class="mb-3">{{ $title }}</h3>
                    <p class="text-muted mb-4">{{ $message }}</p>
                    <a href="{{ route('calon_siswa.dashboard') }}" class="btn btn-primary">
                        <i class="bi bi-house-door me-2"></i>Kembali ke Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection