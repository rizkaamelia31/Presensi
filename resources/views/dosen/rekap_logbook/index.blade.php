@extends('layouts.dashboard')
@section('content')
<div class="container py-5">
  <div class="row vh-100">
    <div class="col-md-12">
        <h3>Rekap Logbook {{$hariIni}}</h3>
        <div class="table-responsive text-nowrap card">
            <table class="table text-center">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Gambar</th>
                  <th>Nama Mahasiswa</th>
                  <th>Jumlah Hadir</th>
                  <th>Jumlah Tidak Hadir</th>
                  <th>Keterangan</th>
                </tr>
              </thead>
              <tbody class="table-border-bottom-0">
                @foreach($logbookData as $index => $data)
                  <tr>
                    <td><strong>{{ $loop->iteration }}</strong></td>
                    <td><img src="{{ asset('images/' . $data['gambar']) }}" width="50" alt="Gambar Mahasiswa"></td>
                    <td><p>{{ $data['nama'] }}</p></td>
                    <td><p>{{ $data['jumlah_hadir'] }}</p></td>
                    <td><p>{{ $data['jumlah_tidak_hadir'] }}</p></td>
                    <td><a href="{{ route('dosen.rekap_logbook.detail', $data['id']) }}" class="btn btn-primary">Lihat Detail</a></td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
    </div>
  </div>
</div>
@endsection
