@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h2 class="fw-semibold my-5 text-center ">Daftar Mahasiswa</h2>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="card p-3">
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Mahasiswa</th>
                    <th width="280px">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($mahasiswa as $mhs)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $mhs->user->name }}</td>
                        <td>
                            {{-- @if($mhs->penilaians->isEmpty())
                                <a class="btn btn-primary" href="{{ route('penilaian.createWithId', $mhs->id) }}">Beri Nilai</a>
                            @else
                                <a class="btn btn-warning" href="{{ route('penilaian.edit', $mhs->id) }}">Edit Nilai</a>
                                <a class="btn btn-secondary" href="{{ route('penilaian.detail', $mhs->id) }}">Lihat Detail</a>
                            @endif --}}
                            <a class="btn btn-primary" href="{{ route('penilaian.createWithId', $mhs->id) }}">Beri Nilai</a>
                            <a class="btn btn-secondary" href="{{ route('penilaian.detail', $mhs->id) }}">Lihat Detail</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
