@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h1>Tambah Kriteria Penilaian</h1>

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

    <form action="{{ route('kriteria-penilaian.store') }}" method="POST">
        @csrf

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nama Kriteria:</strong>
                    <input type="text" name="nama_kriteria" class="form-control" placeholder="Nama Kriteria">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Bobot:</strong>
                    <input type="number" name="bobot" class="form-control" placeholder="Bobot" step="0.01" min="0" max="100">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Jenis:</strong>
                    <select name="jenis" class="form-control">
                        <option value="internal">Internal</option>
                        <option value="eksternal">Eksternal</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
</div>
@endsection
