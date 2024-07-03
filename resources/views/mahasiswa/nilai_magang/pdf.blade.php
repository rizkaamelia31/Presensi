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
                <th>Nilai Rata-rata</th>
            </tr>
        </thead>
        <tbody>
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
        </tbody>
    </table>
</body>
</html>
