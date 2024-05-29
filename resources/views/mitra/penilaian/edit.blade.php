@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Penilaian</h1>

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

    <form action="{{ route('penilaian.update', $penilaian->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="mhs_id">Mahasiswa:</label>
            <select name="mhs_id" class="form-control">
                @foreach ($mahasiswa as $mhs)
                    <option value="{{ $mhs->id }}" {{ $penilaian->mhs_id == $mhs->id ? 'selected' : '' }}>{{ $mhs->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="kriteria_penilaian_id">Kriteria Penilaian:</label>
            <select name="kriteria_penilaian_id" class="form-control">
                @foreach ($kriteriaPenilaian as $kriteria)
                    <option value="{{ $kriteria->id }}" {{ $penilaian->kriteria_penilaian_id == $kriteria->id ? 'selected' : '' }}>{{ $kriteria->nama_kriteria }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="nilai">Nilai:</label>
            <input type="number" name="nilai" class="form-control" min="0" max="100" step="0.01" value="{{ $penilaian->nilai }}">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
