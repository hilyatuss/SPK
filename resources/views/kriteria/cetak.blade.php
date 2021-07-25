@extends('layout.print')
@section('title', $title)
@section('content')
<table class="table table-bordered table-hover">
	<thead>
		<th width = "3px">No</th>
		<th width = "7px">Kode</th>
		<th>Nama kriteria</th>
		<th><center>Range</center></th>
		<th><center>Atribut</center></th>
		<th><center>Bobot</center></th>
	</thead>
	<?php $no = 1 ?>
	@foreach($rows as $key => $row)
	<tr>
		<td>{{ $no++ }}</td>
		<td>{{ $row->kode_kriteria }}</td>
		<td>{{ $row->nama_kriteria }}</td>
		<td><center>
			<?php
				$query = DB::table('tb_range')->where('kode_kriteria', $row->kode_kriteria)->get();
				foreach($query as $col){
					echo $col->range. "<br>";
				}
			?></center>
			
		</td>
		<td><center>{{ $row->atribut }}</center></td>
		<td><center>{{ $row->bobot }}</center></td>
	</tr>
	@endforeach
</table>
@endsection