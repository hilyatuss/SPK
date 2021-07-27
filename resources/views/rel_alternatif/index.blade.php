@extends('layout.app')
@section('title', $title)
@section('content')
{{ show_msg() }}
<div class="card card-primary card-outline">
	<div class="card-header">
		<form class="form-inline">
			<div class="form-group mr-1">
				<input class="form-control" type="text" name="q" value="{{ $q }}" placeholder="Pencarian..." />
			</div>
			<div class="form-group mr-1">
				<button class="btn btn-success"><i class="fa fa-search"></i> Cari</button>
			</div>
			<div class="form-group mr-1" {{ is_hidden('rel_alternatif.cetak') }}>
				<a class="btn btn-default" href="{{ route('rel_alternatif.cetak') }}" target="_blank"><span class="fa fa-print"></span> Cetak</a>
			</div>
		</form>
	</div>
	<div class="card-body p-0 table-responsive">
		<table class="table table-bordered table-hover">
			<thead>
			<th width = "3px">No</th>
				<th width = "7px">NIM</th>
				<th>Nama alternatif</th>
				@foreach($kriterias as $kriteria)
				<th width = "100px"><center>{{ $kriteria->nama_kriteria }}</center></th>
				<!-- <th>File</th> -->
				@endforeach
				<th><center>Aksi</center></th>
			</thead>
			@foreach($rows as $key => $row)
			<tr>
				<td>{{ ($rows->currentPage() - 1) * $limit + $key + 1}}</td>
				<td>{{ $row->nim }}</td>
				<td>{{ $row->nama_user }}</td>
				@foreach($row->nilais as $nilai)
				<td>
					<center>
						{{ $nilai->pivot->nilai }}<br>
						<a href="{{ url('document').'/'.$nilai->pivot->file }}"  target="_blank"><i class="far fa-file nav-icon"></i></a>
					</center>
				</td>
				<!-- <td><a href="{{ url('document').'/'.$nilai->pivot->file }}" target="_blank">File</a></td> -->
				@endforeach
				<td>
					<center>
						<!-- <a class="btn btn-xs btn-info" href="{{ route('rel_alternatif.edit', $row) }}" {{ is_hidden('rel_alternatif.edit') }}><i class="fa fa-edit"></i> Ubah</a> -->
						<a class="btn btn-xs btn-info" href="{{ route('rel_alternatif.edit', $row) }}" data-toggle="modal" data-target="#modal-edit-nilai-alternatif" {{ is_hidden('rel_alternatif.edit') }}><i class="fa fa-edit"></i> Ubah</a>
					<center>				
				</td>
			</tr>
			@endforeach
		</table>
	</div>
	@if ($rows->hasPages())
	<div class="card-footer">
		{{ $rows->links() }}
	</div>
	@endif
</div>
<!-- 
@foreach($rows as $key => $row)
<div class="modal fade" id="modal-edit-nilai-alternatif" tabindex="-1">
    <div class="modal-dialog" style="max-width: 60%;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Data Nilai Alternatif</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body"> -->
                <!-- form start -->
				<!-- <form action="{{ route('rel_alternatif.update', $row) }}" method="post">
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-md-6">
									{{show_error($errors)}}
									{{ csrf_field() }}
									{{ method_field('PUT') }}
									<div class="form-group">
										<label>Kode alternatif <span class="text-danger">*</span></label>
										<input class="form-control" type="text" name="kode_alternatif" value="{{ old('kode_alternatif', $row->kode_alternatif) }}" readonly>
									</div>
									<div class="form-group">
										<label>Nama alternatif <span class="text-danger">*</span></label>
										<input class="form-control" type="text" name="nama_alternatif" value="{{ old('nama_alternatif', $row->nama_alternatif) }}" readonly>
									</div>
									@foreach($row->nilais as $nilai)
									<div class="form-group">
										<label> {{ $nilai->nama_kriteria }} <span class="text-danger">*</span> </label>
										<input class="form-control" type="text" name="nilai[{{ $nilai->pivot->ID }}]" value="{{ old('nilai['.$nilai->pivot->ID.']', $nilai->pivot->nilai) }}" />
									</div>
									@endforeach
								</div>
							</div>
						</div>
						<div class="card-footer">
							<button class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
							<a class="btn btn-danger" href="{{URL('alternatif')}}"><i class="fa fa-backward"></i> Kembali</a>
						</div>
					</div>
				</form>
            </div>
        </div> -->
        <!-- /.modal-content -->
    <!-- </div> -->
    <!-- /.modal-dialog -->
<!-- </div> -->
<!-- @endforeach -->
<!-- /.modal -->

@endsection