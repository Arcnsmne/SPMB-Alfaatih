@extends('layout.admin')

@section('content')
<div class="main-content container-fluid">
    <div class="page-title mb-4">
        <h3>Data Wilayah</h3>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="table-wilayah">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tipe</th>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Parent</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; @endphp
                            @foreach($provinces as $province)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td><span class="badge bg-primary">Provinsi</span></td>
                                <td>{{ $province->id }}</td>
                                <td>{{ $province->name }}</td>
                                <td>-</td>
                            </tr>
                            @endforeach
                            @foreach($regencies as $regency)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td><span class="badge bg-info">Kabupaten</span></td>
                                <td>{{ $regency->id }}</td>
                                <td>{{ $regency->name }}</td>
                                <td>{{ $regency->province->name ?? '-' }}</td>
                            </tr>
                            @endforeach
                            @foreach($districts as $district)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td><span class="badge bg-success">Kecamatan</span></td>
                                <td>{{ $district->id }}</td>
                                <td>{{ $district->name }}</td>
                                <td>{{ $district->regency->name ?? '-' }}</td>
                            </tr>
                            @endforeach
                            @foreach($villages as $village)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td><span class="badge bg-warning">Desa</span></td>
                                <td>{{ $village->id }}</td>
                                <td>{{ $village->name }}</td>
                                <td>{{ $village->district->name ?? '-' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection