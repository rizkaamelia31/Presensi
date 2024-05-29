@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h1>Kriteria Penilaian</h1>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <a class="btn btn-primary" href="{{ route('kriteria-penilaian.create') }}">Tambah Kriteria</a>

    <table class="table table-bordered mt-3">
        <tr>
            <th>No</th>
            <th>Nama Kriteria</th>
            <th>Bobot</th>
            <th>Jenis</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($kriteriaPenilaian as $kriteria)
        <tr>
            <td>{{ $loop->iteration}}</td>
            <td>{{ $kriteria->nama_kriteria }}</td>
            <td>{{ number_format($kriteria->bobot, 0, '', '') }}%</td>

            <td>{{ ucfirst($kriteria->jenis) }}</td>
            <td>
                <form action="{{ route('kriteria-penilaian.destroy',$kriteria->id) }}" method="POST">

                    <a class="btn btn-primary" href="{{ route('kriteria-penilaian.edit',$kriteria->id) }}">Edit</a>

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
