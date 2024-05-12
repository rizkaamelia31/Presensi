@extends('layouts.dashboard')
@section('content')


<div class=" pt-5">
  <div class="row">
    <div class="col-md-12">
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
      <h3>
          Logbook Harian
      </h3>
     
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-4">
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
            <form action="{{ route('mahasiswa.logbook.store') }}" method="post" id="logbookForm">
              @csrf
              <textarea name="deskripsi" class="form-control" id="deskripsi" cols="30" rows="10"></textarea>
              <button type="button" class="btn btn-primary float-end my-2" onclick="confirmSubmit()">Submit</button>
          </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="col-md-8 mt-3">
    <div class="card">
      <h5 class="card-header ">Data Logbook {{Auth::user()->name}}</h5>
      <div class="accordion" id="accordionExample">
        @foreach ($logbook->groupBy(function($date) {
          return Carbon\Carbon::parse($date->created_at)->format('W');
        }) as $week => $logbooks)
        @php
          $startOfWeek = $logbooks->first()->created_at->startOfWeek();
          $endOfWeek = $logbooks->first()->created_at->endOfWeek();
        @endphp
        <div class="card ">
          <div class="card-header " id="heading{{$week}}">
            <h2 class="mb-0">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$week}}" aria-expanded="false" aria-controls="collapse{{$week}}">
                {{ $startOfWeek->isoFormat('D MMMM') }} - {{ $endOfWeek->isoFormat('D MMMM') }}
              </button>
            </h2>
          </div>
          <div id="collapse{{$week}}" class="collapse" aria-labelledby="heading{{$week}}" data-bs-parent="#accordionExample">
            <div class="card-body">
              @foreach ($logbooks as $item)
              <div class="logbook-item p-3 my-2 shadow" style="border: 1px solid #AEAEAE;border-radius:16px">
                <span class="text-muted fw-semibold">{{ \Carbon\Carbon::parse($item->created_at)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</span>
                <p class="text-muted">{{$item->deskripsi}}</p>
              </div>
              @endforeach
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</div>



<script>
  function confirmSubmit() {
      if (confirm('Apakah Anda yakin ingin mengirim logbook?')) {
          document.getElementById('logbookForm').submit();
      }
  }
</script>

@endsection
