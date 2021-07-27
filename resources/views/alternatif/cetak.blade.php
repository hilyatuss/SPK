@extends('layout.print')
@section('title', $title)
@section('content')
<table class="table table-bordered table-hover">
	<thead>
		<th width = "3px">No</th>
		<th width = "7px">NIM</th>
		<th>Nama alternatif</th>
		<th><center>Jenis Kelamin</center></th>
		<th><center>Program Studi</center></th>
		<th><center>Semester</center></th>
	</thead>
	<?php $no = 1 ?>
	@foreach($rows as $key => $row)
	<tr>
		<td>{{ $no++ }}</td>
		<td>{{ $row->nim }}</td>
		<td>{{ $row->nama_user }}</td>
		<td><center>{{ $row->jenis_kelamin }}</center></td>
		<td><center>{{ $row->prodi }}</center></td>
		<td><center>{{ $row->semester }}</center></td>
	</tr>
	@endforeach
</table>
@endsection