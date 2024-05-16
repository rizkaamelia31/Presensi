@extends('layouts.dashboard')

@section('content')
<div class="container py-5">
  <div class="row vh-100">
    <div class="co-md-12">
        <button class="btn btn-primary">Kembali</button>
        <div class="card-body">
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
            
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            
            <div class="row d-flex ">
                <div class="col-md-4">
                    <div class="card p-3 ">
                        <div class="text-center mb-4">
                            <img src="{{asset('images/'. $mahasiswa->gambar )}}" width="100" alt="" style="border-radius:50%; width:200px;height:200px;">
                            <h3 class="mt-4 mb-0">{{$mahasiswa->user->name}}</h3>
                            <span class="text-muted">{{ \Carbon\Carbon::parse($mahasiswa->tanggal_lahir)->translatedFormat('d F Y') }}</span>
                        </div>
                        {{-- <p class="m-0">Email : {{$mahasiswa->user->email}}</p>
                        <p class="m-0">Magang Batch : {{$mahasiswa->magang_batch}}</p>
                        <p class="m-0">Nama Perusahaan : {{$mahasiswa->perusahaan->nama_perusahaan}}</p>
                        <p class="m-0">Nama Supervisor : {{$mahasiswa->nama_supervisor}}</p>
                        <p class="m-0">No Hp Supervisor : {{$mahasiswa->no_hp_supervisor}}</p> --}}
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('update-profile') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}">
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}">
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password">
                                </div>
                                <div class="mb-3">
                                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="{{ $mahasiswa->tanggal_lahir }}">
                                </div>
                                <div class="mb-3">
                                    <label for="magang_batch" class="form-label">Magang Batch</label>
                                    <input type="text" class="form-control" id="magang_batch" name="magang_batch" value="{{ $mahasiswa->magang_batch }}">
                                  
                                </div>
                                <div class="mb-3">
                                    <label for="perusahaan_id" class="form-label">Nama Perusahaan</label>
                                    <select class="form-select" id="perusahaan_id" name="perusahaan_id">
                                        <option value="">Pilih Perusahaan</option>
                                        @foreach($perusahaanList as $perusahaan)
                                            <option value="{{ $perusahaan->id }}" @if($mahasiswa->perusahaan_id == $perusahaan->id) selected @endif>{{ $perusahaan->nama_perusahaan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="gambar" class="form-label">Gambar</label>
                                    <input type="file" class="form-control" id="gambar" name="gambar" onchange="previewImage(event)">
                                    <img id="gambar-preview" src="{{asset('images/'. $mahasiswa->gambar )}}" alt="" style="max-width: 200px; max-height: 200px;">
                                </div>
                                
                                <div class="mb-3">
                                    <label for="nama_supervisor" class="form-label">Nama Supervisor</label>
                                    <input type="text" class="form-control" id="nama_supervisor" name="nama_supervisor" value="{{ $mahasiswa->nama_supervisor }}">
                                </div>
                                <div class="mb-3">
                                    <label for="no_hp_supervisor" class="form-label">Nomor HP Supervisor</label>
                                    <input type="text" class="form-control" id="no_hp_supervisor" name="no_hp_supervisor" value="{{ $mahasiswa->no_hp_supervisor }}">
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>

<script>
    function previewImage(event) {
        const input = event.target;
        const file = input.files[0];
        const reader = new FileReader();

        reader.onload = function() {
            const imgElement = document.getElementById('gambar-preview');
            imgElement.src = reader.result;
        }

        reader.readAsDataURL(file);
    }
</script>

@endsection
