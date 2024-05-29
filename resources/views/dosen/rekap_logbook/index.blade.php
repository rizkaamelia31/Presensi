@extends('layouts.dashboard')
@section('content')
<div class="container py-5">
  <div class="row vh-100">
    <div class="col-md-12">
        <h3>Rekap Logbook</h3>
        <div class="table-responsive text-nowrap card">
            <table class="table text-center">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Gambar</th>
                  <th>Nama Mahasiswa</th>
                  <th>Keterangan</th>
                </tr>
              </thead>
              <tbody class="table-border-bottom-0">
                @foreach($mahasiswa as $mhs)
                  <tr>
                    <td>{{1}}</td>
                    <td><img src="{{ asset('images/bear wallpaper pc mac 네이버 아이콘 곰.png' . $mhs->user->gambar) }}" width="50" alt="Gambar Mahasiswa"></td>
                    <td>{{$mhs->user->name}}</td>
                    <td><a href="{{ route('dosen.rekap_logbook.detail', $mhs->id) }}" class="btn btn-primary">Lihat Detail</a></td>

                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
    </div>
  </div>
</div>
@endsection
