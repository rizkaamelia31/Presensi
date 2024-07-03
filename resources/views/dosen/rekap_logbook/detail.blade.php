@extends('layouts.dashboard')

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <a href="{{ route('dosen.rekap_logbook.index') }}" class="btn btn-outline-primary btn-sm">
                    <i class="bi bi-arrow-left-short"></i> Kembali
                </a>
                <div class="row justify-content-center mt-3 mb-2">
                    <div class="col-md-12 mb-3">
                        <div class="d-flex gap-2 align-items-center">
                            <img src="{{ asset('images/' . $mahasiswa->gambar) }}" class="rounded-circle" width="50" height="50" style="object-fit: cover;">
                            <span>{{ $mahasiswa->user->name }} - {{ $mahasiswa->perusahaan->nama_perusahaan }}</span>
                        </div>
                    </div>
                </div>

                <div class="card p-3">
                    <div class="row d-flex align-items-center">
                        <div class="col-md-4">
                            <div id="calendar"></div>
                        </div>
                        <div class="col-md-8">
                            @php
                                // Mengambil tanggal mulai dari settings_magang
                                $settingsMagang = App\Models\SettingMagang::where('magang_batch', $mahasiswa->magang_batch)->first();
                                $firstLogDate = $settingsMagang ? \Carbon\Carbon::parse($settingsMagang->tanggal_mulai)->timezone('Asia/Jakarta') : \Carbon\Carbon::now()->startOfDay();
                                
                                // Menginisialisasi variabel attendanceDates
                                $attendanceDates = $logbook
                                    ->pluck('created_at')
                                    ->map(function ($date) {
                                        return \Carbon\Carbon::parse($date)->timezone('Asia/Jakarta')->format('Y-m-d');
                                    })
                                    ->toArray();

                                // Inisialisasi array untuk kehadiran dan ketidakhadiran per bulan
                                $attendanceByMonth = [];
                                $absenceByMonth = [];
                                $totalHadir = 0;
                                $totalTidakHadir = 0;
                                $startDate = $firstLogDate->copy()->startOfMonth();
                                $endDate = \Carbon\Carbon::now('Asia/Jakarta');

                                for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
                                    $monthKey = $date->format('Y-m');
                                    if (!isset($attendanceByMonth[$monthKey])) {
                                        $attendanceByMonth[$monthKey] = 0;
                                        $absenceByMonth[$monthKey] = 0;
                                    }

                                    if (in_array($date->format('Y-m-d'), $attendanceDates)) {
                                        $attendanceByMonth[$monthKey]++;
                                        $totalHadir++;
                                    } else {
                                        if (!$date->isWeekend()) {
                                            $absenceByMonth[$monthKey]++;
                                            $totalTidakHadir++;
                                        }
                                    }
                                }
                            @endphp
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Bulan</th>
                                        <th>Jumlah Hadir</th>
                                        <th>Jumlah Tidak Hadir</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($attendanceByMonth as $month => $count)
                                        @php
                                            $monthName = \Carbon\Carbon::createFromFormat('Y-m', $month)
                                                ->locale('id')
                                                ->isoFormat('MMMM YYYY');
                                        @endphp
                                        <tr>
                                            <td>{{ $monthName }}</td>
                                            <td>{{ $count }}</td>
                                            <td>{{ $absenceByMonth[$month] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Total</th>
                                        <th>{{ $totalHadir }}</th>
                                        <th>{{ $totalTidakHadir }}</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="py-3">
                    <h4 class="text-center fw-semibold my-3">Rekap Logbook</h4>
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="month-tab" data-bs-toggle="tab" data-bs-target="#month" type="button" role="tab" aria-controls="month" aria-selected="true">Per Bulan</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="week-tab" data-bs-toggle="tab" data-bs-target="#week" type="button" role="tab" aria-controls="week" aria-selected="false">Per Minggu</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="day-tab" data-bs-toggle="tab" data-bs-target="#day" type="button" role="tab" aria-controls="day" aria-selected="false">Per Hari</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="month" role="tabpanel" aria-labelledby="month-tab">
                            <div class="accordion mt-3" id="accordionMonth">
                                @php
                                    $monthsDiff = $firstLogDate->diffInMonths($endDate);
                                @endphp

                                @for ($i = 0; $i <= $monthsDiff; $i++)
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseMonth{{ $i }}" aria-expanded="false" aria-controls="collapseMonth{{ $i }}">
                                                Bulan {{ $i + 1 }}
                                            </button>
                                        </h2>
                                        <div id="collapseMonth{{ $i }}" class="accordion-collapse collapse" data-bs-parent="#accordionMonth">
                                            <div class="accordion-body mb-2">
                                                @foreach ($logbook->filter(function ($item) use ($firstLogDate, $i) {
                                                    return optional($item->created_at)->startOfMonth()->diffInMonths($firstLogDate) == $i;
                                                }) as $item)
                                                    <div class="card p-3 mb-2">
                                                        <span class="text-muted text-small" style="font-size: 12px">
                                                        {{ optional($item->created_at)->format('d F Y') }}
                                                        </span>
                                                        {{ $item->deskripsi }}
                                                        <div class="embed-container position-relative" style="width: 100px; height: 100px;">
                                                            <embed src="{{ asset('lampiran/' . $item->lampiran) }}" width="100" height="100" class="my-2">
                                                            <a href="{{ asset('lampiran/' . $item->lampiran) }}" target="_blank" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; display: block;"></a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endfor
                            </div>
                        </div>
                        <div class="tab-pane fade" id="week" role="tabpanel" aria-labelledby="week-tab">
                            <div class="accordion mt-3" id="accordionWeek">
                                @php
                                    $weeksDiff = $firstLogDate->diffInWeeks($endDate);
                                @endphp

                                @for ($i = 0; $i <= $weeksDiff; $i++)
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseWeek{{ $i }}" aria-expanded="false" aria-controls="collapseWeek{{ $i }}">
                                                Minggu {{ $i + 1 }}
                                            </button>
                                        </h2>
                                        <div id="collapseWeek{{ $i }}" class="accordion-collapse collapse" data-bs-parent="#accordionWeek">
                                            <div class="accordion-body mb-2">
                                                @foreach ($logbook->filter(function ($item) use ($firstLogDate, $i) {
                                                    return optional($item->created_at)->startOfWeek()->diffInWeeks($firstLogDate) == $i;
                                                }) as $item)
                                                    <div class="card p-3 mb-2">
                                                        <span class="text-muted text-small" style="font-size: 12px">
                                                            {{ optional($item->created_at)->format('d F Y') }}
                                                        </span>
                                                        {{ $item->deskripsi }}
                                                        <div class="embed-container position-relative" style="width: 100px; height: 100px;">
                                                            <embed src="{{ asset('lampiran/' . $item->lampiran) }}" width="100" height="100" class="my-2">
                                                            <a href="{{ asset('lampiran/' . $item->lampiran) }}" target="_blank" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; display: block;"></a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endfor
                            </div>
                        </div>
                        <div class="tab-pane fade" id="day" role="tabpanel" aria-labelledby="day-tab">
                            <div class="mt-3">
                                @foreach ($logbook as $item)
                                    <div class="card p-3 mb-2">
                                        <span class="text-muted text-small" style="font-size: 12px">
                                            {{ optional($item->created_at)->format('d F Y') }}
                                        </span>
                                        {{ $item->deskripsi }}
                                        <div class="embed-container position-relative" style="width: 100px; height: 100px;">
                                            <embed src="{{ asset('lampiran/' . $item->lampiran) }}" width="100" height="100" class="my-2">
                                            <a href="{{ asset('lampiran/' . $item->lampiran) }}" target="_blank" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; display: block;"></a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Memuat pustaka FullCalendar -->
    <script src="https://unpkg.com/@fullcalendar/core/main.js"></script>
    <script src="https://unpkg.com/@fullcalendar/daygrid/main.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var logbooks = @json($logbook);

            var firstLogDate = new Date(Date.UTC({{ $firstLogDate->year }}, {{ $firstLogDate->month - 1 }}, {{ $firstLogDate->day }}));

            // Mendapatkan tanggal sekarang
            var now = new Date();
            now.setUTCHours(0, 0, 0, 0);

            // Menghitung selisih hari antara tanggal pertama dan sekarang
            var daysDiff = Math.round((now - firstLogDate) / (1000 * 60 * 60 * 24));

            // Menghasilkan event untuk kehadiran dan ketidakhadiran
            var events = [];
            for (var d = 0; d <= daysDiff; d++) { // Memulai dari tanggal 2 Juni 2024
                var currentDate = new Date(firstLogDate);
                currentDate.setUTCDate(currentDate.getUTCDate() + d);
                var formattedDate = currentDate.toISOString().substring(0, 10);

                if (formattedDate >= '{{ $firstLogDate->toDateString() }}') {
                    var dayOfWeek = currentDate.getUTCDay(); // Mendapatkan hari dalam seminggu (0=Sunday, 6=Saturday)
                    if (dayOfWeek !== 0 && dayOfWeek !== 6) { 
                        var attendanceDates = {!! json_encode($attendanceDates) !!};
                        if (attendanceDates.includes(formattedDate)) {
                            events.push({
                                title: '✔',
                                start: formattedDate,
                                color: 'green'
                            });
                        } else {
                            events.push({
                                title: '✖',
                                start: formattedDate,
                                color: 'red'
                            });
                        }
                    }
                }
            }

            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: events
            });
            calendar.render();
        });
    </script>
@endsection
