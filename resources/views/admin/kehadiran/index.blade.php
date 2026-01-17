@extends('layouts.app')

@section('title','Kehadiran')
@section('page-title','Kehadiran Sesi')

@section('content')
<div class="card">
    <div class="card-header">
        <strong>{{ $sesi->nama_sesi }}</strong> - {{ $sesi->kelas }}
    </div>

    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Waktu Hadir</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kehadiran as $k)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $k->mahasiswa->nim }}</td>
                    <td>{{ $k->mahasiswa->nama }}</td>
                    <td>{{ $k->waktu_hadir }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
