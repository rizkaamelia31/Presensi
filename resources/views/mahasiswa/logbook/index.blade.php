@php
    use Carbon\Carbon;
    $startDate = Carbon::now();
    $endDate = Carbon::now()->addDays(4); // Mengambil tanggal hari ini dan 4 hari ke depan
@endphp

@for ($date = $startDate; $date->lte($endDate); $date->addDay())
    @php $formattedDate = $date->format('Y-m-d'); @endphp
    @extends('layouts.dashboard')
    @section('content')
        <!-- Accordion -->
        <h5 class="mt-4">Logbook Harian ({{ $formattedDate }})</h5>
        <div class="row">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="col-md mb-4 mb-md-0">
                <div class="col-md-2">
                    <div class="mb-3">
                        <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example">
                            <option selected>Tahun</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                </div>


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
                                Isi Logbook
                            </button>
                        </h2>

                        <div
                            id="accordionOne"
                            class="accordion-collapse collapse show"
                            data-bs-parent="#accordionExample"
                        >
                            <div class="accordion-body">
                                <div>
                                    <form method="POST" action="{{ route('logbook.store') }}">
                                        @csrf

                                        <div class="form-group">
                                            <textarea id="deskripsi" placeholder="*isi dengan kegiatan anda hari ini!!" class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" required></textarea>
                                            @error('deskripsi')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                        <input type="hidden" name="mhs_id" value="{{Auth::user()->id}}">

                                        <div class="form-group mb-0">
                                            <button type="submit" class="btn btn-primary float-end my-3">
                                                submit
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Accordion -->
    @endsection
@endfor
