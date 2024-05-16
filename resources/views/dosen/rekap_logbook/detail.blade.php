@extends('layouts.dashboard')
@section('content')
<div class="container py-5">
  <div class="row">
      <div class="co-md-12">
        <a href="{{ route('dosen.rekap_logbook.index') }}" class="btn btn-outline-primary btn-sm"> <i class="bi bi-arrow-left-short"></i>  Kembali</a>
        <h3 class="mt-4">
            Detail Logbook
        </h3>
        <div class=" py-3">
        <div class="d-flex gap-4 align-items-center"><img src="/assets/img/kupu.jpg" class="rounded-circle" width="50" height="50" style="object-fit:cover"/> Rizka Amelia - 203200117</div></p>
        <div class="table-responsive text-nowrap card">
            <table class="table text-center">
              <thead >
                <tr >
                  <th>No</th>
                  <th>Deskripsi</th>
                  <th>Tanggal Di Buat</th>
                  <th>Tanggal</th>
                </tr>
              </thead>
              <tbody class="table-border-bottom-0">
                <tr>
                  <td><strong>1</strong></td>
                  <td><p>Senin</p>
                  <td><p>16 Januari 2024</p></td>
                </tr>
              </tbody>
            </table>
          </div>
        
    </div>
</div>
    
   
   
@endsection