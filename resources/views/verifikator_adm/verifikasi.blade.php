@extends('layout.verifikator_adm')

@section('title', 'Verifikasi Berkas')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Verifikasi Berkas Pendaftaran</h3>
                <p class="text-subtitle text-muted">{{ $pendaftar->no_pendaftaran }}</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('verifikator_adm.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Verifikasi</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Detail Pendaftaran</h5>
                    @if(in_array($pendaftar->status, ['SUBMIT', '0']))
                        <span class="badge bg-warning">Menunggu Verifikasi</span>
                    @elseif($pendaftar->status == 'ADM_PASS')
                        <span class="badge bg-success">Selesai Diverifikasi</span>
                    @elseif($pendaftar->status == 'ADM_REJECT')
                        <span class="badge bg-danger">Ditolak</span>
                    @else
                        <span class="badge bg-secondary">{{ $pendaftar->status }}</span>
                    @endif
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="text-primary mb-3">Data Siswa</h6>
                            <table class="table table-sm">
                                <tr>
                                    <td width="40%">Nama</td>
                                    <td>: <strong>{{ $pendaftar->dataSiswa->nama ?? '-' }}</strong></td>
                                </tr>
                                <tr>
                                    <td>NIK</td>
                                    <td>: {{ $pendaftar->dataSiswa->nik ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td>NISN</td>
                                    <td>: {{ $pendaftar->dataSiswa->nisn ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Jenis Kelamin</td>
                                    <td>: {{ $pendaftar->dataSiswa->jk == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                </tr>
                                <tr>
                                    <td>Tempat, Tgl Lahir</td>
                                    <td>: {{ $pendaftar->dataSiswa->tmp_lahir ?? '-' }}, {{ $pendaftar->dataSiswa->tgl_lahir ? \Carbon\Carbon::parse($pendaftar->dataSiswa->tgl_lahir)->format('d M Y') : '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>: {{ $pendaftar->dataSiswa->alamat ?? '-' }}</td>
                                </tr>
                            </table>

                            <h6 class="text-primary mb-3 mt-4">Data Orang Tua</h6>
                            <table class="table table-sm">
                                <tr>
                                    <td width="40%">Nama Ayah</td>
                                    <td>: {{ $pendaftar->dataOrtu->nama_ayah ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Pekerjaan Ayah</td>
                                    <td>: {{ $pendaftar->dataOrtu->pekerjaan_ayah ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td>HP Ayah</td>
                                    <td>: {{ $pendaftar->dataOrtu->hp_ayah ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Nama Ibu</td>
                                    <td>: {{ $pendaftar->dataOrtu->nama_ibu ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Pekerjaan Ibu</td>
                                    <td>: {{ $pendaftar->dataOrtu->pekerjaan_ibu ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td>HP Ibu</td>
                                    <td>: {{ $pendaftar->dataOrtu->hp_ibu ?? '-' }}</td>
                                </tr>
                                @if($pendaftar->dataOrtu->wali_nama)
                                <tr>
                                    <td>Nama Wali</td>
                                    <td>: {{ $pendaftar->dataOrtu->wali_nama ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td>HP Wali</td>
                                    <td>: {{ $pendaftar->dataOrtu->wali_hp ?? '-' }}</td>
                                </tr>
                                @endif
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-primary mb-3">Data Pendaftaran</h6>
                            <table class="table table-sm">
                                <tr>
                                    <td width="40%">No. Pendaftaran</td>
                                    <td>: <strong>{{ $pendaftar->no_pendaftaran }}</strong></td>
                                </tr>
                                <tr>
                                    <td>Jurusan</td>
                                    <td>: {{ $pendaftar->jurusan->nama ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Gelombang</td>
                                    <td>: {{ $pendaftar->gelombang->nama ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Tanggal Daftar</td>
                                    <td>: {{ \Carbon\Carbon::parse($pendaftar->tanggal_daftar)->format('d M Y H:i') }}</td>
                                </tr>
                                @if($pendaftar->status == 'ADM_PASS' && $pendaftar->tgl_verifikasi_adm)
                                <tr>
                                    <td>Tanggal Verifikasi</td>
                                    <td>: {{ \Carbon\Carbon::parse($pendaftar->tgl_verifikasi_adm)->format('d M Y H:i') }}</td>
                                </tr>
                                @endif
                            </table>

                            <h6 class="text-primary mb-3 mt-4">Asal Sekolah</h6>
                            <table class="table table-sm">
                                <tr>
                                    <td width="40%">NPSN</td>
                                    <td>: {{ $pendaftar->asalSekolah->npsn ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Nama Sekolah</td>
                                    <td>: {{ $pendaftar->asalSekolah->nama_sekolah ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Kabupaten</td>
                                    <td>: {{ $pendaftar->asalSekolah->kabupaten ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Nilai Rata-rata</td>
                                    <td>: {{ $pendaftar->asalSekolah->nilai_rata ?? '-' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header">
                    <h5 class="mb-0">Berkas yang Diupload</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Jenis Berkas</th>
                                    <th>Nama File</th>
                                    <th>Ukuran</th>
                                    <th width="15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pendaftar->berkas as $index => $berkas)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td><span class="badge bg-info">{{ $berkas->jenis }}</span></td>
                                    <td>{{ $berkas->nama_file }}</td>
                                    <td>{{ number_format($berkas->ukuran_kb, 0) }} KB</td>
                                    <td>
                                        <a href="{{ asset('storage/' . $berkas->url) }}" target="_blank" class="btn btn-sm btn-primary">
                                            <i class="bi bi-eye"></i> Lihat
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">Belum ada berkas diupload</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

           @if(in_array($pendaftar->status, ['SUBMIT', '0', 'SUBMITTED', 'MENUNGGU', 'PENDING']) || 
    $pendaftar->status == null || 
    $pendaftar->status == '' ||
    !in_array($pendaftar->status, ['ADM_PASS', 'ADM_REJECT', 'LULUS', 'DITOLAK']))

@endif

            <div class="card mt-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ route('verifikator_adm.dashboard') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                        
                        @if(in_array($pendaftar->status, ['SUBMIT', '0', 'SUBMITTED', 'MENUNGGU', 'PENDING']) || 
                            $pendaftar->status == null || 
                            $pendaftar->status == '' ||
                            !in_array($pendaftar->status, ['ADM_PASS', 'ADM_REJECT', 'LULUS', 'DITOLAK']))
                        <div class="d-flex gap-2">
                            <form action="{{ route('verifikator_adm.verifikasi_formulir.selesai', $pendaftar->id) }}" method="POST" class="d-inline">
                                @csrf
                                <input type="hidden" name="status" value="ADM_PASS">
                                <button type="submit" class="btn btn-success" onclick="return confirm('Setujui verifikasi berkas ini?')">
                                    <i class="bi bi-check-circle"></i> Disetujui
                                </button>
                            </form>
                            
                            <form action="{{ route('verifikator_adm.verifikasi_formulir.selesai', $pendaftar->id) }}" method="POST" class="d-inline">
                                @csrf
                                <input type="hidden" name="status" value="ADM_REJECT">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Tolak verifikasi berkas ini?')">
                                    <i class="bi bi-x-circle"></i> Tidak Disetujui
                                </button>
                            </form>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
