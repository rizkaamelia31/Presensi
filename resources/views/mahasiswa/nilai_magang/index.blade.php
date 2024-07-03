@extends('layouts.dashboard')

@section('content')
<div class="my-3">
    <div class="card p-3">
        <h1>Nilai Magang Mahasiswa</h1>
        <a href="{{ route('mahasiswa.nilai-magang.pdf') }}" class="btn btn-primary mb-3">Download PDF</a>
        @if ($penilaians->isEmpty())
            <p class="text-center">Belum ada nilai magang tersedia.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kriteria Penilaian</th>
                        <th>Bobot</th>
                        <th>Jenis</th>
                        <th>Nilai Rata-rata</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $groupedPenilaian = [];
                    @endphp

                    @foreach ($penilaians as $penilaian)
                        @php
                            $kriteria = $penilaian->kriteriaPenilaian->nama_kriteria;
                            $jenis = $penilaian->kriteriaPenilaian->jenis;
                            $bobot = $penilaian->kriteriaPenilaian->bobot;

                            if (!isset($groupedPenilaian[$kriteria])) {
                                $groupedPenilaian[$kriteria] = [
                                    'total_nilai' => 0,
                                    'count' => 0,
                                    'jenis' => $jenis,
                                    'bobot' => $bobot,
                                ];
                            }

                            $groupedPenilaian[$kriteria]['total_nilai'] += $penilaian->nilai;
                            $groupedPenilaian[$kriteria]['count'] += 1;
                        @endphp
                    @endforeach

                    @php
                        $index = 1;
                    @endphp

                    @foreach ($groupedPenilaian as $kriteria => $data)
                        @php
                            $averageNilai = $data['total_nilai'] / $data['count'];
                        @endphp
                        <tr>
                            <td>{{ $index++ }}</td>
                            <td>{{ $kriteria }}</td>
                            <td>{{ number_format($data['bobot'], 0, '', '') }}%</td>
                            <td>{{ $data['jenis'] }}</td>
                            <td>{{ number_format($averageNilai, 0, '', '') }}</td>
                        </tr>
                    @endforeach

                    <tr>
                        <td colspan="3"></td>
                        <td class="text-end">Total Nilai Akhir</td>
                        <td>{{ $totalNilaiAkhir }}</td>
                    </tr>
                </tbody>
            </table>
        @endif
    </div>
</div>
@endsection
