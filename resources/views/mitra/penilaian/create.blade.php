@extends('layouts.dashboard')

@section('content')
    <div class="container py-2">
        <a href="{{ route('penilaian.index') }}" class="btn btn-outline-primary btn-sm">
            <i class="bi bi-arrow-left-short"></i> Kembali
        </a>
        <h3>Beri Nilai: {{ $mahasiswa->user->name }}</h3>

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
            @if (Auth::user()->role_id == 4)
                <input type="hidden" name="dosen_id" value="{{ $dosen_id }}">
            @endif

            <div class="row">
                @if (Auth::user()->role_id == 4)
                    <div class="col-md-6">
                        <h3>Internal</h3>
                        <h6>Silakan isi nilai penilaian dengan range antara 10 - 90</h6>
                        @foreach ($kriteriaPenilaian as $kriteria)
                            @if ($kriteria->jenis == 'internal')
                                <div class="form-group">
                                    <label>{{ $kriteria->nama_kriteria }} ({{ $kriteria->bobot }}%)</label>
                                    <input type="number" name="nilai_{{ $kriteria->id }}" class="form-control"
                                        min="0" max="100" step="0.01">
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endif
                @if (Auth::user()->role_id == 3)
                    <div class="col-md-6">
                        <h3>External</h3>
                        <h6>Silakan isi nilai penilaian dengan range antara 10 - 90</h6>
                        @foreach ($kriteriaPenilaian as $kriteria)
                            @if ($kriteria->jenis == 'eksternal')
                                <div class="form-group">
                                    <label>{{ $kriteria->nama_kriteria }} ({{ $kriteria->bobot }}%)</label>
                                    <input type="number" name="nilai_{{ $kriteria->id }}" class="form-control"
                                        min="0" max="100" step="0.01">
                                </div>
                            @endif
                        @endforeach

                    </div>
                @endif
            </div>


            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
