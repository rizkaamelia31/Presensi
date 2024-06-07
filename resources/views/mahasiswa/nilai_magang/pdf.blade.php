<!DOCTYPE html>
<html>
<head>
    <title>Nilai Magang Mahasiswa</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        .total-score {
            position: absolute;
            top: 10px;
            right: 10px;
            padding: 5px;
            border: 1px solid black;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <h1>Nilai Magang Mahasiswa</h1>
    <div class="total-score">
        <strong>Total Nilai Akhir:</strong> {{ $totalNilaiAkhir }}
    </div>
    <table>
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
        </tbody>
    </table>
</body>
</html>
