@extends('layouts.dashboard')
@section('content')
<div class="container">
    <h2 class="fw-semibold my-3">Data Pengguna</h2>
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
   <div class="card p-3">
    <div class="col-md-3">
        <a href="{{route('users.create')}}" class="btn btn-primary mb-3">Tambah</a>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Roles</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
           @foreach ($users as $item)
           <tr>
            <td>{{$item->name}}</td>
            <td>{{$item->email}}</td>
            <td>{{$item->role->name}}</td>
            <td>
                <a href="{{route('users.edit',$item->id)}}" class="btn btn-primary btn-sm">Edit</a>

                <form action="{{route('users.destroy',$item->id)}}" method="post" class="d-inline">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Akun Ini?')">Delete</button>
                </form>
            </td>

        </tr>
           @endforeach
            <!-- Tambahkan baris lain sesuai dengan data yang ingin ditampilkan -->
        </tbody>
    </table>
   </div>
</div>
@endsection
