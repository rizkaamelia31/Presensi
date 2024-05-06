@extends('layouts.dashboard')
@section('content')
<div class="container py-5">
  <div class="row vh-100">
    <div class="co-md-12">
        <h3>
            Rekap Presensi
        </h3>
        <div class="table-responsive text-nowrap card">
            <table class="table text-center">
              <thead >
                <tr >
                  <th>No</th>
                  <th>Foto</th>
                  <th>NIM</th>
                  <th>Nama Mahasiswa</th>
                  <th>Jumlah hadir</th>
                  <th>Jumlah Tidak hadir</th>
                  <th>Keterangan</th>

                </tr>
              </thead>
              <tbody class="table-border-bottom-0">
                <tr>
                  <td><strong>1</strong></td>
                  <td><img src="/assets/img/kupu.jpg" class="rounded-circle" width="50" height="50" style="object-fit:cover"/></td>
                  <td><p>203200117</p></td>
                  <td><p>Rizka</p></td>
                  <td><p>21</p></td>
                  <td><p>2</p></td>
                  <td><a href="{{ route('dosen.detail_absensi.index') }}" class="btn btn-primary">lihat detail</a></td>
                </tr>
              </tbody>
            </table>
          </div>
        
    </div>
</div>
    
   
   
@endsection