@extends('layouts.dashboard')
@section('content')
<div class="container mt-5">
    <div class="card p-3">
       <h3>Edit Data Pengguna</h3>
    <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Nama:</label>
            <input type="text" class="form-control" id="name" name="nama" value="{{ $user->name }}">
        </div>
        <!-- Tambahkan input lainnya sesuai dengan kebutuhan -->
        <div class="form-group">
            <label for="role_id">Email:</label>
            <input type="text" class="form-control" id="name" name="email" value="{{ $user->name }}">
        </div>
        <!-- Tambahkan input lainnya sesuai dengan kebutuhan -->
        <div class="form-group">
            <label for="role_id">Roles:</label>
            <select class="form-control" id="role_id" name="role_id">
                @foreach ($roles as $role)
                <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Simpan Perubahan</button>
    </form>
   </div>
</div>
@endsection