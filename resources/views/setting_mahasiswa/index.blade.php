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
            <!-- Filter Form -->
            <form method="GET" action="{{ route('setting_mahasiswa.index') }}" class="mb-4">
                <div class="form-group">
                    <label for="magang_batch">Filter Magang Batch</label>
                    <select name="magang_batch" id="magang_batch" class="form-control">
                        <option value="">-- Select Batch --</option>
                        @foreach($batches as $batch)
                            <option value="{{ $batch }}" {{ request('magang_batch') == $batch ? 'selected' : '' }}>{{ $batch }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Filter</button>
            </form>

            <table class="table">
                <thead>
                    <tr>
                        <th>Mahasiswa</th>
                        <th>Nim</th>
                        <th>Magang Batch</th>
                        <th>Dosen Penilai</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($mahasiswa as $mhs)
                        <tr>
                            <td>{{ $mhs->user->name }}</td>
                            <td>{{ $mhs->nim }}</td>
                            <td>{{ $mhs->magang_batch }}</td>
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
