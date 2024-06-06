@extends('layouts.dashboard')
@section('content')
@if (Auth::user()->role_id == 2)
<div class="py-4">
  <div class="row">
    <div class="col-md-12 mb-2">
      <div class="card p-3">
        <div class="d-flex align-items-center gap-3">
          <div class="">
            <h4 class="m-0">Beranda</h4>
            <p>Selamat Datang kembali, {{ Auth::user()->name }} !</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endif

@if (Auth::user()->role_id == 1)
<div class="py-4">
  <div class="row">
    <div class="col-md-12 mb-2">
      <div class="card p-3">
        <div class="d-flex align-items-center gap-3">
          <div>
            <img src="{{ Auth::user()->gambar ? asset('storage/' . Auth::user()->gambar) : '/assets/img/IMG_20231102_114830.jpg' }}" class="rounded-circle" width="50" height="50" style="object-fit:cover"/>
          </div>
          <div class="">
            <h4 class="m-0">Beranda</h4>
            <p>Selamat Datang kembali, {{ Auth::user()->name }} !</p>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card text-center mb-4">
        <div class="card-body">
          <h5 class="card-title">Total Logbook Yang Telah Disetujui</h5>
          <p class="card-text">{{$logbookCountApprove}} Logbook</p>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card text-center mb-4">
        <div class="card-body">
          <h5 class="card-title">Total Logbook Yang Belum Disetujui</h5>
          <p class="card-text">{{$logbooksPendingApproval}} Logbook</p>
        </div>
      </div>
    </div>
  </div>
</div>
@endif

@if (Auth::user()->role_id == 4)
<div class="py-4">
  <div class="row">
    <div class="col-md-12 mb-2">
      <div class="d-flex align-items-center gap-3">
        <div class="col-md-12">
          <h5 id="currentDate"></h5>
        </div>
      </div>
    </div>
    <div class="">
      <h4 class="m-0">Beranda</h4>
      <p>Selamat Datang kembali, {{ Auth::user()->name }} !</p>
    </div>
  </div>
  <div class="row">
    <div class="col-md-3">
      <div class="card text-center mb-4">
        <div class="card-body">
          <h5 class="card-title">Magang Batch</h5>
          <p class="card-text">Periode Ganjil</p>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card text-center mb-4">
        <div class="card-body">
          <h5 class="card-title">Total Mitra</h5>
          <p class="card-text">4 Mitra</p>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card text-center mb-4">
        <div class="card-body">
          <h5 class="card-title">Logbook Harian</h5>
          <p class="card-text">5 mahasiswa belum mengisi logbook</p>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card text-center mb-4">
        <div class="card-body">
          <h5 class="card-title">Total Mahasiswa Magang</h5>
          <p class="card-text">100 Mahasiswa</p>
        </div>
      </div>
    </div>
  </div>
</div>
@endif

@if (Auth::user()->role_id == 3)
<div class="py-4">
  <div class="row">
    <div class="col-md-12 mb-2">
      <div class="card p-3">
        <div class="d-flex align-items-center gap-3">
          <div>
            <img src="{{ Auth::user()->gambar ? asset('storage/' . Auth::user()->gambar) : '/assets/img/IMG_20231102_114830.jpg' }}" class="rounded-circle" width="50" height="50" style="object-fit:cover"/>
          </div>
          <div class="">
            <h4 class="m-0">Beranda</h4>
            <p>Selamat Datang kembali, {{ Auth::user()->name }} !</p>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card text-center mb-4">
        <div class="card-body">
          <h5 class="card-title">Total Logbook Yang Belum Disetujui</h5>
          <p class="card-text">{{$logbookCountApprove}} Logbook</p>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card text-center mb-4">
        <div class="card-body">
          <h5 class="card-title">Total Logbook Yang Belum Disetujui</h5>
          <p class="card-text">{{$logbooksPendingApproval}} Logbook</p>
        </div>
      </div>
    </div>
  </div>
</div>
@endif

<script>
document.addEventListener('DOMContentLoaded', function() {
  function getCurrentDate() {
    const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
    const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    
    const now = new Date();
    const dayName = days[now.getDay()];
    const day = now.getDate();
    const month = months[now.getMonth()];
    const year = now.getFullYear();
    
    return `${dayName}, ${day} ${month} ${year}`;
  }
  
  document.getElementById('currentDate').textContent = getCurrentDate();
});
</script>
@endsection
