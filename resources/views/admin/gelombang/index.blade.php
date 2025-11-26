@extends('layout.admin')

@section('content')

<div class="main-content container-fluid">
    {{-- Header Halaman dan Tombol Tambah --}}
    <div class="page-title mb-4 d-flex justify-content-between align-items-center">
        <h3>Gelombang PPDB</h3>

        {{-- Tombol Tambah --}}
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" 
                data-bs-target="#formGelombangModal" onclick="clearForm()">
            <i class="fas fa-plus"></i> Tambah Gelombang
        </button>
    </div>

    {{-- Alert Messages --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Tabel Data Gelombang --}}
    <section class="section">
        <div class="card">
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Gelombang</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
                            <th>Tahun</th>
                            <th>Kuota</th>
                            <th>Biaya Daftar</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($gelombangs as $gelombang)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $gelombang->nama }}</td>

                            {{-- Gunakan optional() agar aman dari null --}}
                            <td>{{ optional($gelombang->tgl_mulai)->format('d M Y') }}</td>
                            <td>{{ optional($gelombang->tgl_selesai)->format('d M Y') }}</td>
                            <td>{{ $gelombang->tahun }}</td>

                            <td>{{ number_format($gelombang->kuota) }}</td>
                            <td>Rp {{ number_format($gelombang->biaya_daftar, 0, ',', '.') }}</td>

                            <td class="text-center">
                                {{-- Tombol Edit --}}
                                <button type="button" class="btn btn-sm btn-warning me-1" 
                                        onclick='editGelombang(@json($gelombang))'>
                                    <i class="bi bi-pencil-square"></i> 
                                </button>

                                {{-- Tombol Hapus --}}
                                <form action="{{ route('admin.gelombang.destroy', $gelombang->id) }}" 
                                      method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" 
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center">Data gelombang belum tersedia.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>

{{-- Modal Form (Partial) --}}
@include('admin.gelombang.partial.form') 

@endsection
@push('scripts')
<script>
    const modal = document.getElementById('formGelombangModal');
    const form = document.getElementById('gelombangForm');
    const modalTitle = document.getElementById('formGelombangModalLabel');

    function clearForm() {
        form.reset();
        modalTitle.innerText = 'Tambah Gelombang PPDB Baru';
        form.action = "{{ route('admin.gelombang.store') }}";

        const methodInput = form.querySelector('input[name="_method"]');
        if (methodInput) methodInput.remove();

    }

   function editGelombang(gelombang) {
    modalTitle.innerText = 'Edit Gelombang ' + gelombang.nama;
    
    // Gunakan route update yang benar
    form.action = "/admin/gelombang/" + gelombang.id;

    // Hapus method input yang lama jika ada
    const existingMethod = form.querySelector('input[name="_method"]');
    if (existingMethod) {
        existingMethod.remove();
    }
    
    // Tambah method PUT untuk update
    const methodInput = document.createElement('input');
    methodInput.type = 'hidden';
    methodInput.name = '_method';
    methodInput.value = 'PUT';
    form.appendChild(methodInput);

    // Isi form dengan data gelombang
    form.querySelector('input[name="nama"]').value = gelombang.nama || '';
    form.querySelector('input[name="tahun"]').value = gelombang.tahun || '';
    
    // Format tanggal untuk input date
    if (gelombang.tgl_mulai) {
        const tglMulai = new Date(gelombang.tgl_mulai);
        form.querySelector('input[name="tgl_mulai"]').value = tglMulai.toISOString().split('T')[0];
    }
    
    if (gelombang.tgl_selesai) {
        const tglSelesai = new Date(gelombang.tgl_selesai);
        form.querySelector('input[name="tgl_selesai"]').value = tglSelesai.toISOString().split('T')[0];
    }
    
    form.querySelector('input[name="kuota"]').value = gelombang.kuota || '';
    form.querySelector('input[name="biaya_daftar"]').value = gelombang.biaya_daftar || '';

    // Tampilkan modal
    const bsModal = new bootstrap.Modal(modal);
    bsModal.show();
}


    @if ($errors->any())
        document.addEventListener('DOMContentLoaded', function() {
            const bsModal = new bootstrap.Modal(modal);
            bsModal.show();
        });
    @endif
</script>
@endpush