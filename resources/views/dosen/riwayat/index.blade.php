@extends('layouts.dashboard')

@section('content')
<div class="container py-5">
    <h1>Data Mahasiswa</h1>
    
    <!-- Form Filter -->
    <form id="filterForm" class="mb-3">
        <div class="form-group">
            <label for="magang_batch">Filter Berdasarkan Magang Batch:</label>
            <select name="magang_batch" id="magang_batch" class="form-control">
                @foreach ($magang_batches as $magang_batch)
                    <option value="{{ $magang_batch }}">{{ $magang_batch }}</option>
                @endforeach
            </select>
        </div>
    </form>
    
    <div class="card p-3">
        <div class="row">
            <div class="col">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Email</th>
                            <th scope="col">Perusahaan</th>
                            <th>Magang batch</th>
                        </tr>
                    </thead>
                    <tbody id="mahasiswaContainer">
                        @foreach ($mahasiswa as $item)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$item->user->name}}</td>
                            <td>{{$item->user->email}}</td>
                            <td>{{$item->perusahaan->nama_perusahaan}}</td>
                            <td>{{$item->magang_batch}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#magang_batch').change(function() {
            var magang_batch = $(this).val();
            $.ajax({
                url: '{{ route("riwayat.index") }}',
                type: 'GET',
                data: {
                    magang_batch: magang_batch
                },
                success: function(response) {
                    $('#mahasiswaContainer').empty();
                    response.forEach(function(mhs, index) {
                        var userName = mhs.user ? mhs.user.name : 'N/A';
                        var userEmail = mhs.user ? mhs.user.email : 'N/A';
                        var companyName = mhs.perusahaan ? mhs.perusahaan.nama_perusahaan : 'N/A';
                        
                        $('#mahasiswaContainer').append(
                            '<tr>' +
                                '<td>' + (index + 1) + '</td>' +
                                '<td>' + userName + '</td>' +
                                '<td>' + userEmail + '</td>' +
                                '<td>' + companyName + '</td>' +
                                '<td>' + mhs.magang_batch + '</td>' +
                            '</tr>'
                        );
                    });
                }
            });
        });
    });
</script>
@endsection
