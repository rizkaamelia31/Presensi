@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h1>Daftar Penilaian</h1>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <a class="btn btn-primary" href="{{ route('penilaian.create') }}">Tambah Penilaian</a>

    <table class="table table-bordered mt-3">
        <tr>
            <th>No</th>
            <th>Mahasiswa</th>
            <th>Kriteria Penilaian</th>
            <th>Nilai</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($penilaian as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->mhs_id }}</td>
            <td>{{ $item->kriteriaPenilaian->nama_kriteria }}</td>
            <td>{{ $item->nilai }}</td>
            <td>
                <form action="{{ route('penilaian.destroy', $item->id) }}" method="POST">

                    <a class="btn btn-primary" href="{{ route('penilaian.edit', $item->id) }}">Edit</a>

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
