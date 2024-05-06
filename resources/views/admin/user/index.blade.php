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
            <td>J{{$item->name}}</td>
            <td>{{$item->email}}</td>
            <td>{{$item->role->name}}</td>
            <td>
                <button class="btn btn-primary">Edit</button>
                <button class="btn btn-danger">Delete</button>
            </td>
        </tr>
           @endforeach
            <!-- Tambahkan baris lain sesuai dengan data yang ingin ditampilkan -->
        </tbody>
    </table>
   </div>
</div>
@endsection
