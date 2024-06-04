@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h2 class="fw-semibold my-5 text-center ">Edit Penilaian: {{ $mahasiswa->user->name }}</h2>

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

    <form action="{{ route('penilaian.update', $mahasiswa->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            @foreach ($penilaian as $nilai)
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label class="mb-1">{{ $nilai->kriteriaPenilaian->nama_kriteria }} ({{ $nilai->kriteriaPenilaian->bobot }}%)</label>
                        <input type="number" name="nilai_{{ $nilai->id }}" class="form-control" min="0" max="100" value="{{ number_format($nilai->nilai , 0, '', '') }}">
                    </div>
                </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a class="btn btn-secondary" href="{{ route('penilaian.index') }}">Kembali</a>
    </form>
</div>
@endsection