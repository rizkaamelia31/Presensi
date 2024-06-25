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
                  <th>Profil Mahasiswa</th>
                  <th>Nama Mahasiswa</th>
                  <th>Keterangan</th>
                </tr>
              </thead>
              <tbody class="table-border-bottom-0">
                @foreach($mahasiswa as $mhs)
                  <tr>
                    <td>{{$loop->iteration}}</td>
                    <td><img src="{{ asset('images/' . $mhs->gambar) }}" width="50" alt="Gambar Mahasiswa"></td>
                    {{-- <img src="{{ Auth::user()->mahasiswa->gambar ? asset('images/' . Auth::user()->mahasiswa->gambar) : '/assets/img/IMG_20231102_114830.jpg' }}" class="rounded-circle" width="50" height="50" style="object-fit:cover"/> --}}
              
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
