@extends('layouts.dashboard')
@section('content')
<div class="container py-5">

  @extends('layouts.dashboard')
@section('content')
<div class="container py-5">
  <div class="row vh-100">
    <div class="co-md-12">
        <h3>
            Rekap Laporan Akhir
        </h3>
        <div class="table-responsive text-nowrap card">
            <table class="table text-center">
              <thead >
                <tr >
                  <th>No</th>
                  <th>Foto</th>
                  <th>NIM</th>
                  <th>Nama Mahasiswa</th>
                  <th>Laporan Akhir</th>

                </tr>
              </thead>
              <tbody class="table-border-bottom-0">
                <tr>
                  <td><strong>1</strong></td>
                  <td><img src="/assets/img/kupu.jpg" class="rounded-circle" width="50" height="50" style="object-fit:cover"/></td>
                  <td><p>203200117</p></td>
                  <td><p>Rizka</p></td>
                  <td><a href="/assets/pdf/Formulir-Bimbingan-Skripsi.pdf"><img src="/assets/img/pdf.png"></a></td>
                </tr>
              </tbody>
            </table>
          </div>
        
    </div>
</div>
    
   
   
@endsection
    
   
   
@endsection