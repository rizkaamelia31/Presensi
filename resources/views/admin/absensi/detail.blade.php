@extends('layouts.dashboard')
@section('content')
<div class="container py-5">
  <div class="row vh-100">
    <div class="co-md-12">
        <h3>
            Detail Presensi
        </h3>
        <a href="{{ route('admin.absensi.index') }}"> < Kembali</a>
        <div class="container py-3">
        <p><img src="/assets/img/kupu.jpg" class="rounded-circle" width="50" height="50" style="object-fit:cover"/> Rizka Amelia - 203200117</></p>
        <div class="table-responsive text-nowrap card">
            <table class="table text-center">
              <thead >
                <tr >
                  <th>No</th>
                  <th>Hari</th>
                  <th>Tanggal</th>
                  <th>Hadir</th>
                  <th>Tidak Hadir</th>

                </tr>
              </thead>
              <tbody class="table-border-bottom-0">
                <tr>
                  <td><strong>1</strong></td>
                  <td><p>Senin</p>
                  <td><p>16 Januari 2024</p></td>
                  <td><img src="/assets/img/correct.png" class="rounded-circle" width="30" height="30" style="object-fit:cover"/></td>
                  <td><img src="/assets/img/line.png" class="rounded-circle" width="30" height="30" style="object-fit:cover"/></td>
                </tr>
              </tbody>
            </table>
          </div>
        
    </div>
</div>
    
   
   
@endsection