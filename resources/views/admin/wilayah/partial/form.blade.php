<div class="modal fade" id="formWilayahModal" tabindex="-1" aria-labelledby="formWilayahModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="wilayahForm" method="POST" action="{{ route('admin.wilayah.store') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="formWilayahModalLabel">Tambah Wilayah</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="mb-3">
                        <label for="type" class="form-label">Tipe Wilayah</label>
                        <select name="type" class="form-select @error('type') is-invalid @enderror" required>
                            <option value="">Pilih Tipe</option>
                            <option value="province" {{ old('type') == 'province' ? 'selected' : '' }}>Provinsi</option>
                            <option value="regency" {{ old('type') == 'regency' ? 'selected' : '' }}>Kabupaten/Kota</option>
                            <option value="district" {{ old('type') == 'district' ? 'selected' : '' }}>Kecamatan</option>
                            <option value="village" {{ old('type') == 'village' ? 'selected' : '' }}>Kelurahan/Desa</option>
                        </select>
                        @error('type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3" id="parent-div" style="display: none;">
                        <label for="parent_id" class="form-label">Parent</label>
                        <select name="parent_id" class="form-select @error('parent_id') is-invalid @enderror">
                            <option value="">Pilih...</option>
                        </select>
                        @error('parent_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Wilayah</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               name="name" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>