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
  <div class="row vh-100">
    <div class="col-md-12">
        <h3>Data Logbook Mahasiswa</h3>
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
                  <th>Profil Mahasiswa</th>
                  <th>Nama Mahasiswa</th>
                  <th>Keterangan</th>
                </tr>
              </thead>
              <tbody class="table-border-bottom-0">
                @foreach($groupedLogbooks as $index => $logbook)
                  <tr>
                    <td><strong>{{ $loop->iteration }}</strong></td>
                    <td><img src="{{ asset('images/'. $logbook->first()->mahasiswa->gambar) }}" width="50" alt="Gambar Mahasiswa"></td>
                    <td><p>{{ $logbook->first()->mahasiswa->user->name }}</p></td>
                    <td><a href="{{ route('mitra.logbook.show', $logbook->first()->mhs_id) }}" class="btn btn-primary">Lihat Detail</a></td>

                    {{-- <td>
                      @if($logbook->status != 'Disetujui')
                        <form action="{{ route('logbook.confirm', $logbook->id) }}" method="POST">
                          @csrf
                          @method('PUT')
                          <button type="submit" class="btn btn-success">Konfirmasi</button>
                        </form>
                      @else
                        <button class="btn btn-secondary" disabled>Sudah Dikonfirmasi</button>
                      @endif
                    </td> --}}
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
    </div>
  </div>
</div>
@endsection
