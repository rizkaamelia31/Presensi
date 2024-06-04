@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <a class="btn btn-secondary my-3" href="{{ route('penilaian.index') }}">Kembali</a>
        <h1>Beri Nilai: {{ $mahasiswa->user->name }}</h1>

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
            <input type="hidden" name="mhs_id" value="{{ $mahasiswa->id }}">

            <div class="row">
                @if (Auth::user()->role_id == 4)
                <div class="col-md-6">
                    <h3>Internal</h3>
                    @foreach ($kriteriaPenilaian->get('internal', []) as $kriteria)
                        <div class="form-group">
                            <label>{{ $kriteria->nama_kriteria }} ({{ $kriteria->bobot }}%)</label>
                            <input type="number" name="nilai_{{ $kriteria->id }}" class="form-control" min="0"
                                max="100" step="0.01">
                        </div>
                    @endforeach
                </div>
                @endif
                @if (Auth::user()->role_id == 3)
                    <div class="col-md-6">
                        <h3>External</h3>
                        @foreach ($kriteriaPenilaian->get('eksternal', []) as $kriteria)
                            <div class="form-group">
                                <label>{{ $kriteria->nama_kriteria }} ({{ $kriteria->bobot }}%)</label>
                                <input type="number" name="nilai_{{ $kriteria->id }}" class="form-control" min="0"
                                    max="100" step="0.01">
                            </div>
                        @endforeach

                    </div>
                @endif
            </div>


            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
