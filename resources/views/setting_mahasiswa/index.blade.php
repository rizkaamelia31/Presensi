@extends('layouts.dashboard')

@section('content')
<div class="my-4">
    <h1>Setting Mahasiswa</h1>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="card shadow border-0">
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Mahasiswa</th>
                        <th>Dosen Penilai</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($mahasiswa as $mhs)
                        <tr>
                            <td>{{ $mhs->user->name }}</td>
                            <td>
                                <ul>
                                    @foreach($mhs->dosenPenilai as $dosen)
                                        <li>{{ $dosen->user->name }}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>
                                @if($mhs->dosenPenilai->isEmpty())
                                    <a href="{{ route('setting_mahasiswa.create', ['mhs_id' => $mhs->id]) }}" class="btn btn-primary btn-sm">Set Dosen</a>
                                @else
                                    <a href="{{ route('setting_mahasiswa.edit', ['id' => $mhs->id]) }}" class="btn btn-warning btn-sm">Edit Dosen Penilai</a>
                                    <form action="{{ route('setting_mahasiswa.destroy', ['id' => $mhs->id]) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus dosen ini dari mahasiswa?')">Delete Dosen</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
