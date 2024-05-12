@extends('layouts.dashboard')

@section('content')
<div class="container py-5">
  <div class="row vh-100">
    <div class="co-md-12">
        <h3>
            Profil {{ Auth::user()->name }}
        </h3>
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
            
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('update-profile') }}">
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
                            <label for="perusahaan_id" class="form-label">Perusahaan ID</label>
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
                            <img id="gambar-preview" src="" alt="" style="max-width: 200px; max-height: 200px;">
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
