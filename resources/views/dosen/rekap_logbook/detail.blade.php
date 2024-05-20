@extends('layouts.dashboard')
@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="co-md-12">
                <a href="{{ route('dosen.rekap_logbook.index') }}" class="btn btn-outline-primary btn-sm"> <i
                        class="bi bi-arrow-left-short"></i> Kembali</a>
                <h3 class="mt-4">
                    Detail Logbook
                </h3>
                <div class=" py-3">
                    <div class="d-flex gap-4 align-items-center">
                        <img src="{{ asset('images/' . $mahasiswa->gambar) }}" class="rounded-circle me-3" width="50"
                            height="50" style="object-fit: cover;">
                        <span>{{ $mahasiswa->user->name }}</span>
                    </div>
                    </p>
                    <div class="accordion" id="accordionExample">
                     @foreach ($logbook as $item)
                     <div class="accordion-item">
                      <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                          {{ $item->created_at->format('H:i') }}
                        </button>
                      </h2>
                      <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">{{$item->deskripsi}}
                        </div>
                      </div>
                    </div>
                     @endforeach
                    </div>


                </div>
            </div>
        @endsection
