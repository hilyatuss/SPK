@extends('layout.print')
@section('title', $title)
@section('content')
<table class="table table-bordered table-hover">
    <thead>
    <th width = "3px">No</th>
		<th width = "7px">Kode</th>
        <th>Nama</th>
        @foreach($kriterias as $kriteria)
        <th><center>
            {{ $kriteria->nama_kriteria }}</center>
        </th>
        @endforeach
    </thead>
    <?php $no = 1 ?>
    @foreach($rows as $key => $row)
    <tr>
        <td>{{ $no++ }}</td>
        <td>{{ $row->kode_alternatif }}</td>
        <td>{{ $row->nama_alternatif }}</td>
        @foreach($row->nilais as $nilai)
        <td><center>
            {{ $nilai->pivot->nilai }}</center>
        </td>
        @endforeach
    </tr>
    @endforeach
</table>
@endsection