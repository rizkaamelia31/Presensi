@extends('layouts.dashboard')
@section('content')
<style>
  .logbook-description {
    white-space: pre-wrap;
    text-align: left;     
    word-wrap: break-word; 
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

        <!-- Filter Form -->
        <form method="GET" action="{{ route('mitra.logbook.index') }}">
            <div class="row mb-4">
                <div class="col-md-4">
                    <select name="magang_batch" class="form-select">
                        <option value="">Pilih Batch Magang</option>
                        @foreach($batches as $availableBatch)
                            <option value="{{ $availableBatch }}" {{ request('magang_batch') == $availableBatch ? 'selected' : '' }}>{{ $availableBatch }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
        </form>

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
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
    </div>
  </div>
</div>
@endsection
