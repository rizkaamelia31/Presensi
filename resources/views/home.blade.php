@extends('layouts.dashboard')
@section('content')
@if (Auth::user()->roles == 'admin')
<div class="container py-5">

  <div class="row">
      <div class="col-md-3">
          <div class="card icon-card cursor-pointer text-center mb-4">
              <div class="card-body">
                <i class="bx bxl-adobe mb-2"></i>
                <p class="icon-name text-capitalize text-truncate mb-0">adobe</p>
              </div>
            </div>
      </div>
      <div class="col-md-3">
          <div class="card icon-card cursor-pointer text-center mb-4">
              <div class="card-body">
                <i class="bx bxl-adobe mb-2"></i>
                <p class="icon-name text-capitalize text-truncate mb-0">adobe</p>
              </div>
            </div>
      </div>
      <div class="col-md-3">
          <div class="card icon-card cursor-pointer text-center mb-4">
              <div class="card-body">
                <i class="bx bxl-adobe mb-2"></i>
                <p class="icon-name text-capitalize text-truncate mb-0">adobe</p>
              </div>
            </div>
      </div>
      <div class="col-md-3">
          <div class="card icon-card cursor-pointer text-center mb-4">
              <div class="card-body">
                <i class="bx bxl-adobe mb-2"></i>
                <p class="icon-name text-capitalize text-truncate mb-0">adobe</p>
              </div>
            </div>
      </div>
  </div>

  <div class="row vh-100">
      <div class="co-md-12">
          <h3>
              Rekap mahasiswa yang tidak hadir hari ini
          </h3>
          <div class="table-responsive text-nowrap card">
              <table class="table text-center">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Foto</th>
                    <th>Nama mahasiswa</th>
                    <th>Tanggal</th>
                  </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                  <tr>
                    <td><i class="fab fa-angular fa-lg text-danger "></i> <strong>Angular Project</strong></td>
                    <td>Albert Cook</td>
                    
                  </tr>
                </tbody>
              </table>
            </div>
          
      </div>
  </div>
</div>
 
@endif

@if (Auth::user()->role_id == 1)
    <div class=" py-4">
      <div class="row">
        <div class="col-md-12 mb-2">
          <div class="card p-3">
            <div class="d-flex align-items-center gap-3">
              <div>

                <img src="/assets/img/kupu.jpg" class="rounded-circle" width="50" height="50" style="object-fit:cover"/> 
              </div>
              <div class="">
                <h4 class="m-0">Beranda</h4>
                <p>Selamat Datang kembali {{Auth::user()->name}}</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-12">
          <div class="card p-3">
            <div class="d-flex align-items-center gap-3">
              <div>

                <img src="/assets/img/kupu.jpg" class="rounded-circle" width="50" height="50" style="object-fit:cover"/> 
              </div>
              <div class="">
                <h4 class="m-0">Beranda</h4>
                <p>Selamat Datang kembali {{Auth::user()->name}}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endif






   
@endsection