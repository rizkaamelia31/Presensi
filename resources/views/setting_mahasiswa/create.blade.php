@extends('layouts.dashboard')

@section('content')
<div class="mt-4">
    <h1>Set Dosen untuk Mahasiswa</h1>
 <div class="card shadow-border-0">
    <div class="card-body">
        <form action="{{ route('setting_mahasiswa.store') }}" method="POST">
            @csrf
            <input type="hidden" name="mhs_id" value="{{ $mahasiswa->id }}">
            <div class="form-group">
                <label for="mhs_id">Nama Mahasiswa:</label>
                <input type="text" name="" class="form-control" readonly value="{{  $mahasiswa->user->name  }}" id="">
              </div>
            <div class="form-group">
                <label for="dosen_id">Pilih Dosen:</label>
                <select name="dosen_id[]" id="dosen_id" class="form-control select2" multiple="multiple">
                    @foreach($dosens as $dsn)
                        <option value="{{ $dsn->id }}">{{ $dsn->user->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-success btn-sm">Tambah Dosen</button>
        </form>
    </div>
 </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
@endsection
