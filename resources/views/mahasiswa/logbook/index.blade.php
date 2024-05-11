@extends('layouts.dashboard')
@section('content')
<div class="container py-5">
  <div class="row vh-100">
    <div class="co-md-12">
        <h3>
            Logbook Harian
        </h3>
        <div class="card-body">
          @if($errors->any())
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
      @endif
      
      @if(session('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
              {{ session('success') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
      @endif
      
      @if(session('error'))
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
              {{ session('error') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
      @endif
      
     
  <div class="col-md mb-4 mb-md-0">
    <div class="accordion mt-3" id="accordionExample">
      <div class="card accordion-item active">
        <h2 class="accordion-header" id="headingOne">
          <button
            type="button"
            class="accordion-button"
            data-bs-toggle="collapse"
            data-bs-target="#accordionOne"
            aria-expanded="true"
            aria-controls="accordionOne"
          >
         {{$hariIni}}
          </button>
        </h2>
        <div
          id="accordionOne"
          class="accordion-collapse collapse show"
          data-bs-parent="#accordionExample"
        >
          <div class="accordion-body">
           <form action="{{route('mahasiswa.logbook.store')}}" method="post">
            @csrf
            <textarea name="deskripsi" class="form-control" id="" cols="30" rows="10"></textarea>
            <button type="submit" class="btn btn-primary float-end my-2">Submit</button>
           </form>
          </div>
        </div>
      </div>


    
      

      
</div>
<div class="card mt-4">
        
  <h5 class="card-header">Data Logbook {{Auth::user()->name}}</h5>
  <div>
    <table class="table">
      <thead>
        <tr>
          <th>No</th>
          <th>Deskripsi</th>
          <th>Tanggal</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @foreach ($logbook as $item)
        <tr>
          <td>{{$loop->iteration}}</td>
          <td style="max-width: 300px">{{$item->deskripsi}}</td>
          <td>{{ \Carbon\Carbon::parse($item->created_at)->locale('id')->isoFormat('dddd, D MMMM YYYY HH:mm:ss') }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

@endsection
