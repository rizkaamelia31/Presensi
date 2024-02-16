@extends('layouts.dashboard')
@section('content')
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
    
   
   
@endsection