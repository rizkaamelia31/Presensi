@extends('layouts.dashboard')
@section('content')

    <div class=" pt-5">
        <div class="row">
            <div class="col-md-12">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('error'))
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
                        <button type="button" class="accordion-button" data-bs-toggle="collapse"
                            data-bs-target="#accordionOne" aria-expanded="true" aria-controls="accordionOne">
                            {{ $hariIni }}
                        </button>
                    </h2>
                    <div id="accordionOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <form action="{{ route('mahasiswa.logbook.store') }}" method="post" id="logbookForm"
                                enctype="multipart/form-data">
                                @csrf
                                <textarea name="deskripsi" class="form-control" id="deskripsi" cols="30" rows="10"></textarea>
                                <input type="file" name="lampiran" class="form-control my-2">
                                <button type="button" class="btn btn-primary float-end my-2"
                                    onclick="confirmSubmit()">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8 mt-3">
            <div class="card">
                <h5 class="card-header ">Data Logbook {{ Auth::user()->name }}</h5>
                <div class="accordion" id="accordionExample">
                    @foreach ($logbook->groupBy(function ($date) {
            return Carbon\Carbon::parse($date->created_at)->format('W');
        }) as $week => $logbooks)
                        @php
                            $startOfWeek = $logbooks->first()->created_at->startOfWeek();
                            $endOfWeek = $logbooks->first()->created_at->endOfWeek();
                        @endphp
                        <div class="card ">
                            <div class="card-header " id="heading{{ $week }}">
                                <h2 class="mb-0">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse{{ $week }}" aria-expanded="false"
                                        aria-controls="collapse{{ $week }}">
                                        {{ $startOfWeek->isoFormat('D MMMM') }} - {{ $endOfWeek->isoFormat('D MMMM') }}
                                    </button>
                                </h2>
                            </div>
                            <div id="collapse{{ $week }}" class="collapse"
                                aria-labelledby="heading{{ $week }}" data-bs-parent="#accordionExample">
                                <div class="card-body">
                                    @foreach ($logbooks as $item)
                                        <div class="logbook-item p-3 my-2 shadow position-relative"
                                            style="border: 1px solid #AEAEAE;border-radius:16px">
                                            <span
                                                class="text-muted fw-semibold">{{ \Carbon\Carbon::parse($item->created_at)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</span>
                                            <p class="text-muted">{{ $item->deskripsi }}</p>

                                            @if ($item->lampiran)
                                                @php
                                                    $fileExtension = pathinfo($item->lampiran, PATHINFO_EXTENSION);
                                                @endphp

                                                @if (in_array($fileExtension, ['jpeg', 'png', 'jpg', 'gif', 'svg']))
                                                    <a href="{{ asset('lampiran/' . $item->lampiran) }}" target="_blank">
                                                        <img src="{{ asset('lampiran/' . $item->lampiran) }}"
                                                            class="img-fluid my-2" width="50">
                                                    </a>
                                                @else
                                                    <div class="embed-container position-relative"
                                                        style="width: 100px; height: 100px;">
                                                        <embed src="{{ asset('lampiran/' . $item->lampiran) }}"
                                                            type="application/{{ $fileExtension }}" width="100"
                                                            height="100" class="my-2">
                                                        <a href="{{ asset('lampiran/' . $item->lampiran) }}" target="_blank"
                                                            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; display: block;"></a>
                                                    </div>
                                                @endif
                                            @endif

                                            @if ($item->status == 'Menunggu Persetujuan')
                                                <span
                                                    class="badge bg-warning position-absolute top-0 end-0">{{ $item->status }}</span>
                                                <a href="" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">Edit</a>
                                            @elseif ($item->status == 'Disetujui')
                                                <span
                                                    class="badge bg-success position-absolute top-0 end-0">{{ $item->status }}</span>
                                            @else
                                                <span
                                                    class="badge bg-secondary position-absolute top-0 end-0">{{ $item->status }}</span>
                                            @endif
                                        </div>
                                        <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="editModal{{ $item->id }}Label" aria-hidden="true">
                                          <div class="modal-dialog" role="document">
                                              <div class="modal-content">
                                                  <div class="modal-header">
                                                      <h5 class="modal-title" id="editModal{{ $item->id }}Label">Edit Logbook</h5>
                                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                      </button>
                                                  </div>
                                                  <div class="modal-body">
                                                      <form action="" method="POST" enctype="multipart/form-data">
                                                          @csrf
                                                          @method('PUT')
                                                          <div class="form-group">
                                                              <label for="deskripsi">Deskripsi</label>
                                                              <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3">{{ $item->deskripsi }}</textarea>
                                                          </div>
                                                          <div class="form-group mt-3">
                                                              <label for="lampiran">Unggah Lampiran</label>
                                                              <input type="file" class="form-control" id="lampiran" name="lampiran">
                                                          </div>
                                                      </form>
                                                  </div>
                                                  <div class="modal-footer">
                                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                      <button type="button" class="btn btn-primary" id="saveChanges{{ $item->id }}">Save changes</button>
                                                  </div>
                                              </div>
                                          </div>
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
