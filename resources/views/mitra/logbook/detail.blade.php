@extends('layouts.dashboard')
@section('content')
<style>
  .logbook-description {
    white-space: pre-wrap; /* Menjaga whitespace */
    text-align: left;      /* Merapikan teks ke kiri */
    word-wrap: break-word; /* Memastikan kata tidak melampaui batas */
  }
</style>
<div class="container py-5">
  <div class="row">
    <div class="col-md-12">
        <a href="{{ route('mitra.logbook.index') }}" class="btn btn-outline-primary ">
            <i class="bi bi-arrow-left-short"></i> Kembali
        </a>
  <div class="row vh-100">
    <div class="col-md-12">
        <h3>Logbook Mahasiswa: {{ $mahasiswa->user->name }}</h3>
        @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="table-responsive text-nowrap card">
            <table class="table text-center">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Bukti</th>
                  <th>Tanggal</th>
                  <th>Isi Logbook</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody class="table-border-bottom-0">
                @foreach($logbooks as $index => $logbook)
                  <tr>
                    <td><strong>{{ $loop->iteration }}</strong></td>
                    <td><img src="{{ asset('lampiran/'. $logbook->lampiran)}}" alt="" width="100" /></td>
                    <td>{{ $logbook->created_at }}</td>
                    <td class="logbook-description">{{ $logbook->deskripsi }}</td>
                    <td>{{ $logbook->status }}</td>
                    <td>
                      @if($logbook->status != 'Disetujui')
                        <form action="{{ route('logbook.confirm', $logbook->id) }}" method="POST">
                          @csrf
                          @method('PUT')
                          <button type="submit" class="btn btn-success">Konfirmasi</button>
                        </form>
                      @else
                        <button class="btn btn-secondary" disabled>Sudah Dikonfirmasi</button>
                      @endif
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
