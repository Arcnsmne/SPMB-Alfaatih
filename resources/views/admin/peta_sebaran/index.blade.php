@extends('layout.admin')

@section('content')
<div class="main-content container-fluid">
    <div class="page-title mb-4">
        <h3>Peta Sebaran Pendaftar</h3>
        <p class="text-subtitle text-muted">Visualisasi domisili pendaftar berdasarkan koordinat geografis</p>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5>Peta Interaktif</h5>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <select id="filterJurusan" class="form-select">
                                <option value="">Semua Jurusan</option>
                                @foreach($jurusanList as $jurusan)
                                <option value="{{ $jurusan->id }}">{{ $jurusan->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <button id="refreshMap" class="btn btn-primary">Refresh Peta</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="map" style="height: 500px;"></div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5>Statistik Sebaran</h5>
                </div>
                <div class="card-body">
                    <div class="legend-box">
                        <h6><i class="bi bi-info-circle"></i> Keterangan:</h6>
                        <div class="legend-item">
                            <div class="legend-icon" style="background: linear-gradient(45deg, #007bff, #0056b3);">1</div>
                            <span>Nomor urut pendaftar di peta</span>
                        </div>
                        <div class="legend-item">
                            <i class="bi bi-cursor-fill" style="color: #007bff; margin-right: 8px;"></i>
                            <span>Klik marker untuk detail lengkap</span>
                        </div>
                        <div class="legend-item">
                            <i class="bi bi-eye-fill" style="color: #28a745; margin-right: 8px;"></i>
                            <span>Hover untuk info singkat</span>
                        </div>
                    </div>
                    
                    <div id="totalPendaftar" class="mb-3">
                        <h6>Total Pendaftar: <span class="badge bg-primary" id="totalCount">0</span></h6>
                    </div>
                    
                    <h6>Per Jurusan:</h6>
                    <div id="agregasiJurusan" class="mb-3"></div>
                    
                    <h6>Per Kecamatan:</h6>
                    <div id="agregasiKecamatan"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<style>
.custom-marker {
    background: transparent !important;
    border: none !important;
}

.marker-icon:hover {
    transform: scale(1.1);
    transition: transform 0.2s ease;
}

.legend-box {
    background: white;
    padding: 10px;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    margin-bottom: 15px;
}

.legend-item {
    display: flex;
    align-items: center;
    margin-bottom: 5px;
    font-size: 12px;
}

.legend-icon {
    width: 20px;
    height: 20px;
    border-radius: 50%;
    margin-right: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: bold;
    font-size: 10px;
}
</style>

<script>
let map;
let markers = [];

function initMap() {
    map = L.map('map').setView([-6.2088, 106.8456], 10);
    
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);
}

function loadMapData() {
    const jurusanId = document.getElementById('filterJurusan').value;
    
    fetch(`/admin/peta-sebaran/data?jurusan_id=${jurusanId}`)
        .then(response => response.json())
        .then(data => {
            markers.forEach(marker => map.removeLayer(marker));
            markers = [];
            
            data.markers.forEach((item, index) => {
                // Create custom icon with data
                const customIcon = L.divIcon({
                    className: 'custom-marker',
                    html: `
                        <div class="marker-icon" style="
                            background: linear-gradient(45deg, #007bff, #0056b3);
                            color: white;
                            border-radius: 50%;
                            width: 40px;
                            height: 40px;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            font-weight: bold;
                            font-size: 12px;
                            border: 3px solid white;
                            box-shadow: 0 2px 8px rgba(0,0,0,0.3);
                            cursor: pointer;
                        ">
                            ${index + 1}
                        </div>
                        <div class="marker-tooltip" style="
                            position: absolute;
                            top: -70px;
                            left: 50%;
                            transform: translateX(-50%);
                            background: rgba(0,0,0,0.9);
                            color: white;
                            padding: 10px 14px;
                            border-radius: 8px;
                            font-size: 11px;
                            white-space: nowrap;
                            display: none;
                            z-index: 1000;
                            box-shadow: 0 4px 12px rgba(0,0,0,0.3);
                            border: 1px solid rgba(255,255,255,0.2);
                        ">
                            <div style="font-weight: bold; margin-bottom: 2px;">${item.nama}</div>
                            <div>${item.jurusan} • ${item.kecamatan}</div>
                        </div>
                    `,
                    iconSize: [40, 40],
                    iconAnchor: [20, 40]
                });
                
                const marker = L.marker([item.lat, item.lng], { icon: customIcon })
                    .bindPopup(`
                        <div style="min-width: 220px;">
                            <h6 style="margin-bottom: 10px; color: #007bff;">
                                <i class="bi bi-person-circle"></i> ${item.nama}
                            </h6>
                            <div style="margin-bottom: 8px;">
                                <i class="bi bi-mortarboard" style="color: #28a745;"></i>
                                <strong>Jurusan:</strong> ${item.jurusan}
                            </div>
                            <div style="margin-bottom: 8px;">
                                <i class="bi bi-house" style="color: #6f42c1;"></i>
                                <strong>Alamat:</strong> ${item.alamat}
                            </div>
                            <div style="margin-bottom: 8px;">
                                <i class="bi bi-geo-alt" style="color: #dc3545;"></i>
                                <strong>Kecamatan:</strong> ${item.kecamatan}
                            </div>
                            <div style="margin-bottom: 8px;">
                                <i class="bi bi-building" style="color: #fd7e14;"></i>
                                <strong>Kabupaten:</strong> ${item.kabupaten}
                            </div>
                            <div style="margin-bottom: 8px;">
                                <i class="bi bi-map" style="color: #20c997;"></i>
                                <strong>Provinsi:</strong> ${item.provinsi}
                            </div>
                            <div style="font-size: 10px; color: #6c757d; margin-top: 8px; border-top: 1px solid #eee; padding-top: 5px;">
                                <i class="bi bi-crosshair"></i> Koordinat: ${item.lat.toFixed(6)}, ${item.lng.toFixed(6)}
                            </div>
                        </div>
                    `);
                    
                marker.addTo(map);
                markers.push(marker);
                
                // Add hover effect
                marker.on('mouseover', function(e) {
                    const tooltip = e.target._icon.querySelector('.marker-tooltip');
                    if (tooltip) tooltip.style.display = 'block';
                });
                
                marker.on('mouseout', function(e) {
                    const tooltip = e.target._icon.querySelector('.marker-tooltip');
                    if (tooltip) tooltip.style.display = 'none';
                });
            });
            
            updateAgregasi(data.agregasi);
            
            if (markers.length > 0) {
                const group = new L.featureGroup(markers);
                map.fitBounds(group.getBounds().pad(0.1));
            }
        });
}

function updateAgregasi(agregasi) {
    document.getElementById('totalCount').textContent = agregasi.total;
    
    let jurusanHtml = '';
    Object.entries(agregasi.per_jurusan).forEach(([jurusan, count]) => {
        jurusanHtml += `<div class="d-flex justify-content-between">
            <span>${jurusan}</span>
            <span class="badge bg-info">${count}</span>
        </div>`;
    });
    document.getElementById('agregasiJurusan').innerHTML = jurusanHtml;
    
    let kecamatanHtml = '';
    Object.entries(agregasi.per_kecamatan).forEach(([kecamatan, count]) => {
        kecamatanHtml += `<div class="d-flex justify-content-between">
            <span>${kecamatan}</span>
            <span class="badge bg-success">${count}</span>
        </div>`;
    });
    document.getElementById('agregasiKecamatan').innerHTML = kecamatanHtml;
}

document.addEventListener('DOMContentLoaded', function() {
    initMap();
    loadMapData();
    
    document.getElementById('refreshMap').addEventListener('click', loadMapData);
    document.getElementById('filterJurusan').addEventListener('change', loadMapData);
});
</script>
@endpush