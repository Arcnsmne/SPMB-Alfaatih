@extends('layout.calonsiswa')

@section('title', 'Upload Berkas')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Upload Berkas</h3>
                <p class="text-subtitle text-muted">Upload dokumen persyaratan pendaftaran</p>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Upload Berkas Persyaratan</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('upload.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @php
                        $jenisOptions = [
                            'IJAZAH' => 'Ijazah/SKHUN',
                            'RAPOR' => 'Rapor Semester Akhir', 
                            'KIP' => 'Kartu Indonesia Pintar',
                            'KKS' => 'Kartu Keluarga Sejahtera',
                            'AKTA' => 'Akta Kelahiran',
                            'KK' => 'Kartu Keluarga'
                        ];
                    @endphp
                    
                    @foreach($jenisOptions as $key => $name)
                    <div class="row align-items-center mb-3">
                        <div class="col-md-4">
                            <label class="form-label">{{ $name }}</label>
                        </div>
                        <div class="col-md-8">
                            <input type="file" name="file_{{ $key }}" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
                        </div>
                    </div>
                    @endforeach
                    
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary">Upload Semua Berkas</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection