@extends('layouts.dashboard')

@section('content')
<div class="container">
    <a href="{{ route('penilaian.index') }}" class="btn btn-outline-primary">
        <i class="bi bi-arrow-left-short"></i> Kembali
    </a>
    <h2 class="mt-1 fw-semibold">Rincian Penilaian: {{ $mahasiswa->user->name }}</h2>

    @if (Auth::user()->role_id == 3 || Auth::user()->role_id == 4)
    <div class="mt-3">
        <div class="card p-3">
            <h3>External</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kriteria</th>
                        <th>Bobot</th>
                        <th>Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalExternal = 0;
                    @endphp
                    @foreach ($mahasiswa->penilaians as $penilaian)
                        @if ($penilaian->kriteriaPenilaian->jenis === 'eksternal')
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $penilaian->kriteriaPenilaian->nama_kriteria }}</td>
                                <td>{{ number_format($penilaian->kriteriaPenilaian->bobot, 0, '', '') }}%</td>
                                <td>{{ number_format($penilaian->nilai, 0, '', '') }}</td> {{-- Nilai dikali bobot di sini, di-format tanpa desimal --}}
                                @php
                                    $totalExternal += $penilaian->nilai * ($penilaian->kriteriaPenilaian->bobot / 100); // Nilai dikali bobot di sini
                                @endphp
                            </tr>
                        @endif
                    @endforeach
                    <tr>
                        <td colspan="3" class="text-end">Total External</td>
                        <td>{{ number_format($totalExternal, 0, '', '') }}</td> {{-- Total External juga di-format tanpa desimal --}}
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    @if (Auth::user()->role_id == 4) <!-- Role Dosen -->
    <div class="mt-3">
        <div class="card p-3">
            <h3>Internal</h3>
            <table class="table table-bordered">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Kriteria</th>
                        <th>Bobot</th>
                        <th>Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalInternal = 0;
                    @endphp
                    @foreach ($mahasiswa->penilaians as $penilaian)
                        @if ($penilaian->kriteriaPenilaian->jenis === 'internal')
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $penilaian->kriteriaPenilaian->nama_kriteria }}</td>
                                <td>{{ number_format($penilaian->kriteriaPenilaian->bobot, 0, '', '') }}%</td>
                                <td>{{ number_format($penilaian->nilai, 0, '', '') }}</td> {{-- Nilai dikali bobot di sini, di-format tanpa desimal --}}
                                @php
                                    $totalInternal += $penilaian->nilai * ($penilaian->kriteriaPenilaian->bobot / 100); // Nilai dikali bobot di sini
                                @endphp
                            </tr>
                        @endif
                    @endforeach
                    <tr>
                        <td colspan="3" class="text-end">Total Internal</td>
                        <td>{{ number_format($totalInternal, 0, '', '') }}</td> {{-- Total Internal juga di-format tanpa desimal --}}
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="my-3 p-3 card">
        @php
            $totalNilaiAkhir = ($totalInternal * 0.3) + ($totalExternal * 0.7); // Menghitung total nilai akhir dengan bobot 30% internal dan 70% eksternal
        @endphp
        <p class="text-danger text-small m-0"*>Nilai internal 30% + Eksternal 70%</p>
        <h3 class="fw-semibold">Total Nilai Akhir Mahasiswa = {{ $totalNilaiAkhir }}</h3> {{-- Total nilai akhir di-format tanpa desimal --}}
    </div>
    @endif

   
    @endif

</div>
@endsection
