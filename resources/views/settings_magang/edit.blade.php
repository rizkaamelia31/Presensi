@extends('layouts.dashboard')

@section('content')
<div class="container py-5">
    <h2>Edit Magang Setting</h2>
    <form action="{{ route('settings_magang.update', $settingMagang->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="magang_batch" class="form-label">Magang Batch</label>
            <input type="text" class="form-control" id="magang_batch" name="magang_batch" value="{{ $settingMagang->magang_batch }}" required>
        </div>
        <div class="mb-3">
            <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
            <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" value="{{ $settingMagang->tanggal_mulai }}" required>
        </div>
        <div class="mb-3">
            <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
            <input type="date" class="form-control" id="tanggal_selesai" name="tanggal_selesai" value="{{ $settingMagang->tanggal_selesai }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
