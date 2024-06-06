@extends('layouts.dashboard')
@section('content')
<div class="container py-5">
  <div class="row vh-100">
    <div class="col-md-12">
        <h3>Rekap Laporan Akhir</h3>
        <div class="table-responsive text-nowrap card">
            <table class="table text-center">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Mahasiswa</th>
                  <th>Laporan Akhir</th>
                  <th>Tanggal</th>
                </tr>
              </thead>
              <tbody class="table-border-bottom-0">
                @foreach ($laporanAkhir as $laporan)
                <tr>
                  <td>{{$loop->iteration}}</td>
                    <td>{{ $laporan->mahasiswa->user->name }}</td>
                    <td><a href="{{ asset($laporan->laporan_akhir) }}" target="_blank">Lihat PDF</a></td>
                    <td>{{ \Carbon\Carbon::parse($laporan->created_at)->translatedFormat('l, d F Y H:i') }}</td>

                </tr>
            @endforeach
            
              </tbody>
            </table>
          </div>
    </div>
  </div>
</div>
@endsection
