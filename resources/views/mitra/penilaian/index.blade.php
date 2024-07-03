@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <h2 class="fw-semibold my-5 text-center">Daftar Mahasiswa</h2>

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        <div class="card p-3">
            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Mahasiswa</th>
                        <th width="280px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mahasiswa as $mhs)
                        @php
                            $role_id = Auth::user()->role_id;
                            $today = now()->startOfDay();
                            $penilaianDisabled = false;

                            $settingsMagang = \App\Models\SettingMagang::where('magang_batch', $mhs->magang_batch)->first();
                            // Check if the role is 4 (Dosen) and fetch dosen_id
                            if ($role_id == 4) {
                                $dosen_id = Auth::user()->dosen->id;

                                // Check if there is already internal assessment given by this dosen for this mahasiswa
                                $penilaian_internal = $mhs->penilaians
                                    ->filter(function ($penilaian) use ($dosen_id) {
                                        return $penilaian->kriteriaPenilaian->jenis === 'internal' &&
                                            $penilaian->dosen_id === $dosen_id;
                                    })
                                    ->isNotEmpty();

                                // Disable editing or giving internal assessment if today is after the tanggal_selesai
                                if ($settingsMagang->tanggal_selesai && $today > $settingsMagang->tanggal_selesai) {
                                    $penilaianDisabled = true;
                                }
                            }

                            // Check if there is already external assessment given for this mahasiswa
                            $penilaian_eksternal = $mhs->penilaians
                                ->filter(function ($penilaian) {
                                    return $penilaian->kriteriaPenilaian->jenis === 'eksternal';
                                })
                                ->isNotEmpty();
                        @endphp

                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $mhs->user->name }}</td>
                            <td>
                                @if ($role_id == 4)
                                    @if ($penilaian_internal && !$penilaianDisabled)
                                        <a class="btn btn-warning"
                                            href="{{ route('penilaian.editPenilaian', ['mhs_id' => $mhs->id, 'type' => 'internal']) }}">Edit
                                            Nilai Internal</a>
                                    @elseif (!$penilaianDisabled)
                                        <a class="btn btn-primary"
                                            href="{{ route('penilaian.createWithId', ['mhs_id' => $mhs->id, 'type' => 'internal']) }}">Beri
                                            Nilai Internal</a>
                                    @endif
                                @elseif ($role_id == 3)
                                    @if ($penilaian_eksternal)
                                        <a class="btn btn-warning"
                                            href="{{ route('penilaian.editPenilaian', ['mhs_id' => $mhs->id, 'type' => 'eksternal']) }}">Edit
                                            Nilai Eksternal</a>
                                    @else
                                        <a class="btn btn-primary"
                                            href="{{ route('penilaian.createWithId', ['mhs_id' => $mhs->id, 'type' => 'eksternal']) }}">Beri
                                            Nilai Eksternal</a>
                                    @endif
                                @endif

                                <a class="btn btn-secondary"
                                    href="{{ route('penilaian.detail', $mhs->id) }}">Lihat Detail</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
