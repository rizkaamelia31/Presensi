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
                  <th>Foto</th>
                  <th>NIM</th>
                  <th>Nama Mahasiswa</th>
                  <th>Laporan Akhir</th>
                </tr>
              </thead>
              <tbody class="table-border-bottom-0">
                @foreach($mahasiswa as $index => $mhs)
                <tr>
                  <td><strong>{{ $loop->iteration }}</strong></td>
                  <td>
                    <img src="{{ asset('images/' . $mhs->user->foto) }}" class="rounded-circle" width="50" height="50" style="object-fit:cover" alt="Foto Mahasiswa">
                  </td>
                  <td><p>{{ $mhs->nim }}</p></td>
                  <td><p>{{ $mhs->user->name }}</p></td>
                  <td>
                    <a href="{{ asset('pdf/' . $mhs->laporan_akhir) }}">
                      <img src="{{ asset('assets/img/pdf.png') }}" alt="PDF Icon">
                    </a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
    </div>
  </div>
</div>
@endsection
