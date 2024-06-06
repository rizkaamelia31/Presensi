<!-- resources/views/jobdescs/create.blade.php -->

@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (Auth()->user()->role_id == 3)
        
    <div class="card p-3 my-3">
        <h3>Buat Job Description</h3>
    <form action="{{ route('jobdescs.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="mhs_id" class="form-label">Pilih Mahasiswa</label>
            <select class="form-select" id="mhs_id" name="mhs_id">
                @foreach ($mahasiswas as $mahasiswa)
                    <option value="{{ $mahasiswa->id }}">{{ $mahasiswa->user->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="file_job" class="form-label">File Job Description (PDF)</label>
            <input type="file" class="form-control" id="file_job" name="file_job">
            @error('file_job')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
    </div>
    @endif

  <div class="card p-3 mt-3">
    <h2>Data Job Description</h2>
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Mahasiswa</th>
                <th>File Job Description</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($jobdescs as $key => $jobdesc)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $jobdesc->mahasiswa->user->name }}</td>
                    <td>
                        <a href="{{ asset('jobdescs/' . $jobdesc->file_job) }}" target="_blank">
                            Lihat PDF
                        </a>
                        
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
  </div>
</div>
@endsection
