@extends('layouts.dashboard')

@section('content')
<div class="container py-5">
    <h2>Magang Settings List</h2>
    <a href="{{ route('settings_magang.create') }}" class="btn btn-primary mb-3">Create New Setting</a>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Magang Batch</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($settingsMagang as $setting)
                <tr>
                    <td>{{ $setting->magang_batch }}</td>
                    <td>{{ $setting->tanggal_mulai }}</td>
                    <td>{{ $setting->tanggal_selesai }}</td>
                    <td>
                        <a href="{{ route('settings_magang.edit', $setting->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('settings_magang.destroy', $setting->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
