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
                            <img src="{{ asset('images/' . $mahasiswa->gambar) }}" class="rounded-circle" width="50"
                                height="50" style="object-fit: cover;">
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
                                $startDate = \Carbon\Carbon::create(2024, 4, 29, 0, 0, 0, 'Asia/Jakarta');
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
                  <div class="accordion" id="accordionExample">
                      @php
                          // Tanggal pertama adalah 2 Juni 2024
                          $firstLogDate = \Carbon\Carbon::create(2024, 6, 2)->startOfDay();
                          // Mendapatkan tanggal sekarang
                          $now = \Carbon\Carbon::now()->startOfDay();
                          // Menghitung selisih hari antara tanggal pertama dan sekarang
                          $daysDiff = $firstLogDate->diffInDays($now);
                          // Menghitung selisih minggu antara tanggal pertama dan sekarang
                          $weeksDiff = $firstLogDate->diffInWeeks($now);
                          // Mendapatkan array tanggal hadir
                          $attendanceDates = $logbook
                              ->pluck('created_at')
                              ->map(function ($date) {
                                  return \Carbon\Carbon::parse($date)->format('Y-m-d');
                              })
                              ->toArray();

                      @endphp

                      @for ($i = 0; $i <= $weeksDiff; $i++)
                          <div class="accordion-item">
                              <h2 class="accordion-header">
                                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                      data-bs-target="#collapse{{ $i }}" aria-expanded="false"
                                      aria-controls="collapse{{ $i }}">
                                      Week {{ $i + 1 }}
                                  </button>
                              </h2>
                              <div id="collapse{{ $i }}" class="accordion-collapse collapse"
                                  data-bs-parent="#accordionExample">
                                  <div class="accordion-body mb-2">
                                      @foreach ($logbook->filter(function ($item) use ($firstLogDate, $i) {
                                                // Filter logbook berdasarkan minggu
                                                return optional($item->created_at)->startOfWeek()->diffInWeeks($firstLogDate) == $i;
                                            }) as $item)
                                          <div class="card p-3">
                                              <span class="text-muted text-small" style="font-size: 12px">
                                                  {{ optional($item->created_at)->format('d F Y') }}
                                              </span>
                                              {{ $item->deskripsi }}
                                          </div>
                                      @endforeach
                                  </div>
                              </div>
                          </div>
                      @endfor
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

            // Tanggal pertama adalah 1 Mei 2024
            var firstLogDate = new Date(Date.UTC(2024, 3, 29, 0, 0, 0)); // bulan dimulai dari 0, jadi 4 adalah Mei

            // Mendapatkan tanggal sekarang
            var now = new Date();
            now.setUTCHours(0, 0, 0, 0);

            // Menghitung selisih hari antara tanggal pertama dan sekarang
            var daysDiff = Math.round((now - firstLogDate) / (1000 * 60 * 60 * 24));

            // Mendapatkan array tanggal hadir
            var attendanceDates = logbooks.map(function(log) {
                var logDate = new Date(log.created_at);
                return logDate.toISOString().substring(0, 10);
            });

            console.log('attendanceDates:', attendanceDates);

            // Menghasilkan event untuk kehadiran dan ketidakhadiran
            var events = [];
            for (var d = 0; d <= daysDiff; d++) { // Memulai dari tanggal 1 Mei 2024
                var currentDate = new Date(firstLogDate);
                currentDate.setUTCDate(currentDate.getUTCDate() + d);
                var formattedDate = currentDate.toISOString().substring(0, 10);

                console.log('Tanggal yang sedang diproses:', formattedDate);

                if (formattedDate >= '2024-04-29') {
                    var dayOfWeek = currentDate
                .getUTCDay(); // Mendapatkan hari dalam seminggu (0=Sunday, 6=Saturday)
                    if (dayOfWeek !== 0 && dayOfWeek !== 6) { // Mengecualikan Sabtu dan Minggu
                        console.log('Masuk ke dalam kondisi if untuk tanggal:', formattedDate);
                        if (attendanceDates.includes(formattedDate)) {
                            events.push({
                                title: '✔',
                                start: formattedDate,
                                color: 'green'
                            });
                            console.log('Event Hadir untuk tanggal:', formattedDate);
                        } else {
                            events.push({
                                title: '✖',
                                start: formattedDate,
                                color: 'red'
                            });
                            console.log('Event Tidak Hadir untuk tanggal:', formattedDate);
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
