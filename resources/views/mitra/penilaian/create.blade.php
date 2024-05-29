@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h1>Tambah Penilaian</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Ada masalah dengan inputan Anda.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('penilaian.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="mahasiswa_id">Mahasiswa:</label>
            <select name="mahasiswa_id" class="form-control">
                @foreach ($mahasiswa as $mhs)
                    <option value="{{ $mhs->id }}">{{ $mhs->user->name }}</option>
                @endforeach
            </select>
        </div>

        @foreach ($kriteriaPenilaian as $kriteria)
            <div class="form-group">
                <label>{{ $kriteria->nama_kriteria }} ({{ $kriteria->bobot }}%)</label>
                <input type="number" name="nilai_{{ $kriteria->id }}" class="form-control" min="0" max="100" step="0.01">
            </div>
        @endforeach

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
