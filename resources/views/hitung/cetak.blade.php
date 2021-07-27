@extends('layout.print')
@section('title', $title)
@section('content')
<table class="table table-bordered table-hover">
    <thead>
        <th>Rank</th>
        <th>Nama</th>
        <th>Jenis Kelamin</th>
        <th>Program Studi</th>
        <th>Semester</th>
        <th>Total Akhir</th>
    </thead>
    @foreach($rows as $row)
    <tr>
        <td>{{ $row->rank }}</td>
        <td>{{ $row->nama_user }}</td>
        <td>{{ $row->jenis_kelamin }}</td>
        <td>{{ $row->prodi }}</td>
        <td>{{ $row->semester }}</td>
        <td>{{ round($row->total, 4) }}</td>
    </tr>
    @endforeach
</table>
@endsection