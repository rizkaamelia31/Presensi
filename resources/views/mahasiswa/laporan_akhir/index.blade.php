@extends('layouts.dashboard')
@section('content')
<div class="container py-5">
    <div class="row">
        @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

      
        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <img src="{{asset('images/'. $mahasiswa->gambar)}}" class="rounded-circle me-3" width="50" height="50"
                        style="object-fit: cover;">
                    <div>
                        <p class="mb-0">{{ Auth::user()->name }}</p>
                        <div class="text-start">
                            {{ $mahasiswa->perusahaan->nama_perusahaan }}
                        </div>
                    </div>
                </div>
            </div>
        </div>


        @if($laporanAkhir)
        <div class="alert alert-success mt-3 p-5" role="alert">
            Laporan akhir sudah diupload. Terima kasih! 😊
        </div>
        @else
        <div class="card p-3 mt-3">
            <form action="{{ route('mahasiswa.upload.laporan') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3 mt-4">
                    <label for="laporan_akhir" class="form-label">Upload Laporan Akhir</label>
                    <input class="form-control" type="file" id="laporan_akhir" name="laporan_akhir">
                    <button type="submit" class="btn btn-primary mt-3 float-end">Submit</button>
                </div>
            </form>
        </div>
        @endif

    </div>
</div>
@endsection
