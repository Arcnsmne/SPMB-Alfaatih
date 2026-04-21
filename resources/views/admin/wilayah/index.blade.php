@extends('layout.admin')

@section('content')
<div class="main-content container-fluid">
    <div class="page-title mb-4">
        <h3>Data Wilayah</h3>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-body">
                {{-- Tab Filter --}}
                <div class="d-flex flex-wrap gap-2 mb-3">
                    <button class="btn btn-primary active-tab" data-type="province">Provinsi</button>
                    <button class="btn btn-outline-primary" data-type="regency">Kabupaten/Kota</button>
                    <button class="btn btn-outline-primary" data-type="district">Kecamatan</button>
                    <button class="btn btn-outline-primary" data-type="village">Desa/Kelurahan</button>
                </div>

                {{-- Filter Parent (muncul sesuai level) --}}
                <div class="row g-2 mb-3" id="parent-filters">
                    <div class="col-md-3" id="filter-province-wrap" style="display:none">
                        <select id="filter-province" class="form-select">
                            <option value="">-- Semua Provinsi --</option>
                            @foreach($provinces as $p)
                            <option value="{{ $p->id }}">{{ $p->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3" id="filter-regency-wrap" style="display:none">
                        <select id="filter-regency" class="form-select" disabled>
                            <option value="">-- Semua Kabupaten --</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <input type="text" id="filter-search" class="form-control" placeholder="Cari nama...">
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-primary w-100" id="btn-search">
                            <i class="bi bi-search"></i> Cari
                        </button>
                    </div>
                </div>

                <div id="info-text" class="text-muted small mb-2"></div>

                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead id="table-head">
                            <tr>
                                <th>No</th>
                                <th>ID</th>
                                <th>Nama</th>
                            </tr>
                        </thead>
                        <tbody id="table-body">
                            <tr><td colspan="3" class="text-center text-muted py-4">Memuat data...</td></tr>
                        </tbody>
                    </table>
                </div>
                <div id="pagination" class="d-flex justify-content-center flex-wrap mt-3 gap-1"></div>
            </div>
        </div>
    </section>
</div>

<script>
let currentType = 'province';
let currentPage = 1;

const provinces = @json($provinces);

// Tab click
document.querySelectorAll('[data-type]').forEach(btn => {
    btn.addEventListener('click', function () {
        document.querySelectorAll('[data-type]').forEach(b => {
            b.classList.remove('btn-primary', 'active-tab');
            b.classList.add('btn-outline-primary');
        });
        this.classList.add('btn-primary', 'active-tab');
        this.classList.remove('btn-outline-primary');

        currentType = this.dataset.type;
        currentPage = 1;
        document.getElementById('filter-search').value = '';
        updateParentFilters();
        loadData();
    });
});

// Province filter change → load regencies
document.getElementById('filter-province').addEventListener('change', function () {
    const regencyWrap  = document.getElementById('filter-regency-wrap');
    const regencySelect = document.getElementById('filter-regency');

    if (currentType === 'district' || currentType === 'village') {
        regencySelect.innerHTML = '<option value="">Memuat...</option>';
        regencySelect.disabled = true;

        if (!this.value) {
            regencySelect.innerHTML = '<option value="">-- Semua Kabupaten --</option>';
            regencySelect.disabled = false;
            return;
        }

        fetch(`/api/regencies/${this.value}`)
            .then(r => r.json())
            .then(data => {
                regencySelect.innerHTML = '<option value="">-- Semua Kabupaten --</option>';
                data.forEach(r => regencySelect.innerHTML += `<option value="${r.id}">${r.name}</option>`);
                regencySelect.disabled = false;
            });
    }
});

document.getElementById('btn-search').addEventListener('click', () => {
    currentPage = 1;
    loadData();
});

document.getElementById('filter-search').addEventListener('keydown', e => {
    if (e.key === 'Enter') { currentPage = 1; loadData(); }
});

function updateParentFilters() {
    document.getElementById('filter-province-wrap').style.display = ['regency','district','village'].includes(currentType) ? '' : 'none';
    document.getElementById('filter-regency-wrap').style.display  = ['district','village'].includes(currentType) ? '' : 'none';

    // Reset selects
    document.getElementById('filter-province').value = '';
    document.getElementById('filter-regency').innerHTML = '<option value="">-- Semua Kabupaten --</option>';
    document.getElementById('filter-regency').disabled = true;
}

function loadData(page) {
    page = page || currentPage;
    currentPage = page;

    const search     = document.getElementById('filter-search').value;
    const provinceId = document.getElementById('filter-province').value;
    const regencyId  = document.getElementById('filter-regency').value;
    const tbody      = document.getElementById('table-body');

    // Update header sesuai tipe
    const headers = {
        province: ['No', 'ID', 'Nama'],
        regency:  ['No', 'ID', 'Provinsi', 'Nama'],
        district: ['No', 'ID', 'Provinsi', 'Kabupaten/Kota', 'Nama'],
        village:  ['No', 'ID', 'Provinsi', 'Kabupaten/Kota', 'Kecamatan', 'Nama'],
    };
    document.getElementById('table-head').innerHTML =
        '<tr>' + headers[currentType].map(h => `<th>${h}</th>`).join('') + '</tr>';
    const colspan = headers[currentType].length;

    tbody.innerHTML = `<tr><td colspan="${colspan}" class="text-center py-3">
        <div class="spinner-border spinner-border-sm me-2"></div>Memuat...
    </td></tr>`;
    document.getElementById('pagination').innerHTML = '';

    const params = new URLSearchParams({ type: currentType, search, page, province_id: provinceId, regency_id: regencyId });

    fetch(`/api/wilayah/by-level?${params}`)
        .then(r => r.json())
        .then(res => {
            document.getElementById('info-text').textContent =
                `Menampilkan ${res.data.length} dari ${res.total} data`;

            if (!res.data.length) {
                tbody.innerHTML = `<tr><td colspan="${colspan}" class="text-center text-muted py-4">Tidak ada data</td></tr>`;
                return;
            }

            const offset = (page - 1) * 50;
            tbody.innerHTML = res.data.map((r, i) => {
                let cells = `<td>${offset + i + 1}</td><td>${r.id}</td>`;
                if (currentType === 'regency')  cells += `<td>${r.parent_name ?? '-'}</td>`;
                if (currentType === 'district') cells += `<td>${r.province_name ?? '-'}</td><td>${r.parent_name ?? '-'}</td>`;
                if (currentType === 'village')  cells += `<td>${r.province_name ?? '-'}</td><td>${r.regency_name ?? '-'}</td><td>${r.parent_name ?? '-'}</td>`;
                cells += `<td>${r.name}</td>`;
                return `<tr>${cells}</tr>`;
            }).join('');

            renderPagination(res.pages, page);
        });
}

function renderPagination(totalPages, current) {
    const el = document.getElementById('pagination');
    if (totalPages <= 1) { el.innerHTML = ''; return; }

    const start = Math.max(1, current - 3);
    const end   = Math.min(totalPages, current + 3);
    let html = '';

    if (start > 1) html += `<button class="btn btn-sm btn-outline-secondary" onclick="loadData(1)">1</button><span class="px-1">...</span>`;
    for (let i = start; i <= end; i++) {
        html += `<button class="btn btn-sm ${i === current ? 'btn-primary' : 'btn-outline-secondary'}" onclick="loadData(${i})">${i}</button>`;
    }
    if (end < totalPages) html += `<span class="px-1">...</span><button class="btn btn-sm btn-outline-secondary" onclick="loadData(${totalPages})">${totalPages}</button>`;

    el.innerHTML = html;
}

// Load provinsi saat pertama buka
loadData();
</script>
@endsection
