<!-- resources/views/mitra/logbook/index.blade.php -->
@extends('layouts.dashboard')
@section('content')
<div class="container py-5">
  <div class="row vh-100">
    <div class="col-md-12">
        <h3>Data Logbook Mahasiswa</h3>
        <div class="table-responsive text-nowrap card">
            <table class="table text-center">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Gambar</th>
                  <th>Nama Mahasiswa</th>
                  <th>Deskripsi Logbook</th>
                  <th>Tanggal Dibuat</th>
                </tr>
              </thead>
              <tbody class="table-border-bottom-0">
                @foreach($logbooks as $index => $logbook)
                  <tr>
                    <td><strong>{{ $loop->iteration }}</strong></td>
                    <td><img src="{{ asset('images/' . $logbook->mahasiswa->gambar) }}" width="50" alt="Gambar Mahasiswa"></td>
                    <td><p>{{ $logbook->mahasiswa->user->name }}</p></td>
                    <td><p>{{ $logbook->deskripsi }}</p></td>
                    <td><p>{{ $logbook->created_at }}</p></td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
    </div>
  </div>
</div>
@endsection
