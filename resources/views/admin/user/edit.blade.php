@extends('layouts.dashboard')
@section('content')
<div class="container mt-5">
    <div class="card p-3">
        <h3>Edit Data Pengguna</h3>
        <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Nama:</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="role_id">Roles:</label>
                        <select class="form-control" id="role_id" name="role_id">
                            <option value="">Pilih roles</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="password">Password (Kosongkan jika tidak ingin mengubah):</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                </div>
            </div>

           @if ($user->dosen)
           <div id="dosen-fields" >
            <h5>Dosen Information</h5>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nidn">NIDN:</label>
                        <input type="text" class="form-control" id="nidn" name="nidn" value="{{ old('nidn', $user->dosen->nidn ?? '') }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="gambar_dosen">Gambar Dosen:</label>
                        <input type="file" class="form-control" id="gambar_dosen" name="gambar_dosen">
                    </div>
                </div>
            </div>
        </div>
           @endif

           @if ($user->mahasiswa)
           <div id="mahasiswa-fields" >
            <h5>Mahasiswa Information</h5>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tanggal_lahir">Tanggal Lahir:</label>
                        <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir', $user->mahasiswa->tanggal_lahir ?? '') }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="magang_batch">Magang Batch:</label>
                        <input type="text" class="form-control" id="magang_batch" name="magang_batch" value="{{ old('magang_batch', $user->mahasiswa->magang_batch ?? '') }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nama_supervisor">Nama Supervisor:</label>
                        <input type="text" class="form-control" id="nama_supervisor" name="nama_supervisor" value="{{ old('nama_supervisor', $user->mahasiswa->nama_supervisor ?? '') }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="no_hp_supervisor">No HP Supervisor:</label>
                        <input type="text" class="form-control" id="no_hp_supervisor" name="no_hp_supervisor" value="{{ old('no_hp_supervisor', $user->mahasiswa->no_hp_supervisor ?? '') }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nim">NIM:</label>
                        <input type="text" class="form-control" id="nim" name="nim" value="{{ old('nim', $user->mahasiswa->nim ?? '') }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="angkatan">Angkatan:</label>
                        <input type="text" class="form-control" id="angkatan" name="angkatan" value="{{ old('angkatan', $user->mahasiswa->angkatan ?? '') }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="perusahaan_id_mhs">Perusahaan:</label>
                        <select class="form-control" id="perusahaan_id_mhs" name="perusahaan_id_mhs">
                            <option value="">Pilih Perusahaan</option>
                            @foreach ($perusahaan as $perusahaanItem)
                                <option value="{{ $perusahaanItem->id }}" {{ $user->mahasiswa->perusahaan->id == $perusahaanItem->id ? 'selected' : '' }}>{{ $perusahaanItem->nama_perusahaan }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="dosen_id">Dosen:</label>
                        <select class="form-control" id="dosen_id" name="dosen_id">
                            <option value="">Pilih Dosen</option>
                            @foreach ($dosen as $dosenItem)
                                <option value="{{ $dosenItem->id }}" {{ $user->mahasiswa->dosen_id == $dosenItem->id ? 'selected' : '' }}>{{ $dosenItem->user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="gambar_mahasiswa">Gambar Mahasiswa:</label>
                <input type="file" class="form-control" id="gambar_mahasiswa" name="gambar_mahasiswa">
            </div>
        </div>
           @endif

           @if ($user->perusahaan)
           <div id="mitra-fields" >
            <div class="form-group">
                <label for="nama_perusahaan">Nama Perusahaan:</label>
                <input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan" value="{{ old('nama_perusahaan', $user->perusahaan->nama_perusahaan ?? '') }}">
            </div>
            <div class="form-group">
                <label for="alamat">Alamat:</label>
                <textarea class="form-control" id="alamat" name="alamat">{{ old('alamat', $user->perusahaan->alamat ?? '') }}</textarea>
            </div>
        </div>
           @endif

            <button type="submit" class="btn btn-primary mt-2">Simpan</button>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const roleField = document.getElementById('role_id');
        const dosenFields = document.getElementById('dosen-fields');
        const mahasiswaFields = document.getElementById('mahasiswa-fields');
        const mitraFields = document.getElementById('mitra-fields');

        const toggleFields = (role) => {
            dosenFields.style.display = role === '4' ? 'block' : 'none';
            mahasiswaFields.style.display = role === '1' ? 'block' : 'none';
            mitraFields.style.display = role === '3' ? 'block' : 'none';
        };

        roleField.addEventListener('change', function () {
            toggleFields(this.value);
        });

        toggleFields(roleField.value);
    });
</script>
@endsection
