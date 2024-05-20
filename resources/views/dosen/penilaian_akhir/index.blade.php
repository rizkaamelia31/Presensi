<!-- resources/views/penilaian_akhir/create.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Bobot Penilaian</title>
</head>
<body>
    <h1>Input Bobot Penilaian</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('penilaian_akhir.store') }}" method="POST">
        @csrf
        <div>
            <label for="criteria1">Kriteria 1</label>
            <input type="number" name="criteria1" id="criteria1" value="{{ old('criteria1') }}" required>
        </div>
        <div>
            <label for="criteria2">Kriteria 2</label>
            <input type="number" name="criteria2" id="criteria2" value="{{ old('criteria2') }}" required>
        </div>
        <div>
            <label for="criteria3">Kriteria 3</label>
            <input type="number" name="criteria3" id="criteria3" value="{{ old('criteria3') }}" required>
        </div>
        <div>
            <label for="criteria4">Kriteria 4</label>
            <input type="number" name="criteria4" id="criteria4" value="{{ old('criteria4') }}" required>
        </div>
        <div>
            <label for="criteria5">Kriteria 5</label>
            <input type="number" name="criteria5" id="criteria5" value="{{ old('criteria5') }}" required>
        </div>
        <div>
            <label for="criteria6">Kriteria 6</label>
            <input type="number" name="criteria6" id="criteria6" value="{{ old('criteria6') }}" required>
        </div>
        <div>
            <label for="criteria7">Kriteria 7</label>
            <input type="number" name="criteria7" id="criteria7" value="{{ old('criteria7') }}" required>
        </div>
        <div>
            <button type="submit">Simpan</button>
        </div>
    </form>
</body>
</html>
