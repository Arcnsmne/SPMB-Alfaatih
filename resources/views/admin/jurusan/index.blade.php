@extends('layout.admin')

@section('content')
<div class="main-content container-fluid">
    {{-- Header --}}
    <div class="page-title mb-4 d-flex justify-content-between align-items-center">
        <h3>Data Jurusan</h3>

        <button type="button" class="btn btn-primary"
                data-bs-toggle="modal"
                data-bs-target="#formJurusanModal"
                onclick="clearForm()">
            <i class="fas fa-plus"></i> Tambah Jurusan
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

    {{-- Tabel --}}
    <section class="section">
        <div class="card">
            <div class="card-body">
                <table class="table table-striped" id="table-jurusan">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Nama Jurusan</th>
                            <th>Kuota</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($jurusans as $jurusan)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $jurusan->kode }}</td>
                            <td>{{ $jurusan->nama }}</td>
                            <td>{{ $jurusan->kuota }}</td>
                            <td class="text-center">
                                {{-- Tombol Edit --}}
                                <button type="button" class="btn btn-sm btn-info me-1"
                                        onclick='editJurusan(@json($jurusan))'>
                                    <i class="fas fa-edit"></i> Edit
                                </button>

                                {{-- Tombol Hapus --}}
                                <form action="{{ route('admin.jurusan.destroy', $jurusan->id) }}"
                                      method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Yakin ingin menghapus jurusan ini?')">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">Belum ada data jurusan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>

{{-- Modal Form --}}
@include('admin.jurusan.partial.form')
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('formJurusanModal');
    const form = document.getElementById('jurusanForm');
    const modalTitle = document.getElementById('formJurusanModalLabel');

    window.clearForm = function() {
        form.reset();
        modalTitle.innerText = 'Tambah Jurusan';
        form.action = "{{ route('admin.jurusan.store') }}";

        const methodInput = form.querySelector('input[name="_method"]');
        if (methodInput) methodInput.remove();
    }

    window.editJurusan = function(jurusan) {
        modalTitle.innerText = 'Edit Data Jurusan';
        form.action = "/admin/jurusan/" + jurusan.id;

        if (!form.querySelector('input[name="_method"]')) {
            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'PUT';
            form.appendChild(methodInput);
        }

        form.querySelector('input[name="kode"]').value = jurusan.kode ?? '';
        form.querySelector('input[name="nama"]').value = jurusan.nama ?? '';
        form.querySelector('input[name="kuota"]').value = jurusan.kuota ?? '';

        const bsModal = new bootstrap.Modal(modal);
        bsModal.show();
    }
    
    @if ($errors->any())
        // Tampilkan modal jika ada error validasi
        const bsModal = new bootstrap.Modal(modal);
        bsModal.show();
    @endif
});
</script>
@endpush
