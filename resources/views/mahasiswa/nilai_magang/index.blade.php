@extends('layouts.dashboard')

@section('content')
<div class=" my-3">
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
                        <th>Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($penilaians as $key => $penilaian)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $penilaian->kriteriaPenilaian->nama_kriteria }}</td>
                            <td>{{ number_format($penilaian->kriteriaPenilaian->bobot, 0, '', '') }}%</td>
                            <td>{{ $penilaian->kriteriaPenilaian->jenis }}</td>
                            <td>{{ number_format($penilaian->nilai, 0, '', '') }}</td>
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
