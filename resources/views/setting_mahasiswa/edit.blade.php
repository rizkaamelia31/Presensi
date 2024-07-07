@extends('layouts.dashboard')

@section('content')
<div class="my-4">
    <h1>{{ isset($mahasiswa->dosenPenilai) ? 'Edit Dosen Penilai' : 'Set Dosen' }} untuk Mahasiswa</h1>
   <div class="card shadow border-0">
    <div class="card-body">
        <form action="{{ isset($mahasiswa->dosenPenilai) ? route('setting_mahasiswa.update', $mahasiswa->id) : route('setting_mahasiswa.store') }}" method="POST">
            @csrf
            @if(isset($mahasiswa->dosenPenilai))
                @method('PUT')
            @endif
          <div class="form-group">
            <label for="mhs_id">Nama Mahasiswa:</label>
            <input type="text" name="" class="form-control" readonly value="{{  $mahasiswa->user->name  }}" id="">
          </div>
            <input type="hidden" name="mhs_id" value="{{ $mahasiswa->id }}">
            <div class="form-group">
                <label for="dosen_id">Pilih Dosen:</label>
                <select name="dosen_id[]" id="dosen_id" class="form-control select2" multiple="multiple">
                    @foreach($dosens as $dsn)
                        <option value="{{ $dsn->id }}" @if($mahasiswa->dosenPenilai->contains($dsn->id)) selected @endif>{{ $dsn->user->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary mt-3">{{ isset($mahasiswa->dosenPenilai) ? 'Update Dosen' : 'Tambah Dosen' }}</button>
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
