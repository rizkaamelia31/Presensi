@extends('layouts.dashboard')
@section('content')
<div class="container">
    <h2>Tambah Data Pengguna</h2>
    <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Nama:</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email">
        </div>
        <div class="form-group">
            <label for="role_id">Roles:</label>
            <select class="form-control" id="role_id" name="role_id">
                <option value="">Pilih roles</option>
                @foreach ($roles as $item)
                <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group" id="dosen-fields" style="display: none;">
            <label for="nidn">NIDN:</label>
            <input type="text" class="form-control" id="nidn" name="nidn">
            <label for="perusahaan_id">Perusahaan:</label>
            <input type="text" class="form-control" id="perusahaan_id" name="perusahaan_id">
            <label for="gambar_dosen">Gambar Dosen:</label>
            <input type="file" class="form-control" id="gambar_dosen" name="gambar_dosen">
        </div>

        <div class="form-group" id="mahasiswa-fields" style="display: none;">
            <label for="tanggal_lahir">Tanggal Lahir:</label>
            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir">
            <label for="magang_batch">Magang Batch:</label>
            <input type="text" class="form-control" id="magang_batch" name="magang_batch">
            <label for="nama_supervisor">Nama Supervisor:</label>
            <input type="text" class="form-control" id="nama_supervisor" name="nama_supervisor">
            <label for="no_hp_supervisor">No hp supervisor</label>
            <input type="text" class="form-control" id="no_hp_supervisor" name="no_hp_supervisor">
            <label for="perusahaan_id_mhs">Perusahaan:</label>
            <select class="form-control" id="perusahaan_id_mhs" name="perusahaan_id_mhs">
                <option value="">Pilih Perusahaan</option>
                @foreach ($perusahaan as $perusahaanItem)
                <option value="{{ $perusahaanItem->id }}">{{ $perusahaanItem->nama_perusahaan }}</option>
                @endforeach
            </select>
            <label for="gambar_mahasiswa">Gambar Mahasiswa:</label>
            <input type="file" class="form-control" id="gambar_mahasiswa" name="gambar_mahasiswa">
        </div>
        
        <div class="form-group" id="mitra-fields" style="display: none;">
            <label for="nama_perusahaan">Nama Perusahaan:</label>
            <input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan">
            <label for="alamat">Alamat:</label>
            <textarea class="form-control" id="alamat" name="alamat"></textarea>
        </div>
        
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
<script>
    document.getElementById('role_id').addEventListener('change', function() {
        var selectedRole = this.value;
        var dosenFields = document.getElementById('dosen-fields');
        var mahasiswaFields = document.getElementById('mahasiswa-fields');
        var mitraFields = document.getElementById('mitra-fields');

        if (selectedRole == '2') { // ID untuk peran 'Dosen'
            dosenFields.style.display = 'block';
            mahasiswaFields.style.display = 'none';
            mitraFields.style.display = 'none';
        } else if (selectedRole == '1') { // ID untuk peran 'Mahasiswa'
            dosenFields.style.display = 'none';
            mahasiswaFields.style.display = 'block';
            mitraFields.style.display = 'none';
        } else if (selectedRole == '3') { // ID untuk peran 'Mitra'
            dosenFields.style.display = 'none';
            mahasiswaFields.style.display = 'none';
            mitraFields.style.display = 'block';
        }  else if (selectedRole == '4') { // ID untuk peran 'Mitra'
            dosenFields.style.display = 'block';
            mahasiswaFields.style.display = 'none';
            mitraFields.style.display = 'block';
        }else {
            dosenFields.style.display = 'none';
            mahasiswaFields.style.display = 'none';
            mitraFields.style.display = 'none';
        }
    });
</script>
@endsection
