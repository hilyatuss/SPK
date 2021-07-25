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
			<div class="form-group mr-1">
				<!-- <a class="btn btn-primary" href="{{ route('kriteria.create') }}"><i class="fa fa-plus"></i> Tambah</a> -->
				<a class="btn btn-primary" href="#" data-toggle="modal" data-target="#modal-add"><i class="fa fa-plus"></i> Tambah</a>
			</div>
			<div class="form-group mr-1" {{ is_hidden('kriteria.cetak') }}>
				<a class="btn btn-default" href="{{ route('kriteria.cetak') }}" target="_blank"><span class="fa fa-print"></span> Cetak</a>
			</div>
		</form>
	</div>
	<div class="card-body p-0 table-responsive">
		<table class="table table-bordered table-hover">
			<thead>
				<th width = "3px">No</th>
				<th width = "7px">Kode</th>
				<th>Nama kriteria</th>
				<th><center>Range</center></th>
				<th><center>Atribut</center></th>
				<th><center>Bobot</center></th>
				<th><center>Aksi</center></th>
			</thead>
			@foreach($rows as $key => $row)
			<tr>
				<td>{{ ($rows->currentPage() - 1) * $limit + $key + 1}}</td>
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
				<td><center>
					<!-- <a class="btn btn-xs btn-info" href="{{ route('kriteria.edit', $row) }}" {{ is_hidden('kriteria.edit') }}><i class="fa fa-edit"></i> Ubah</a> -->
					<a class="btn btn-xs btn-info" href="{{ route('kriteria.edit', $row->kode_kriteria) }}" data-toggle="modal" data-target="#modal-edit-{{ $row->kode_kriteria }}" {{ is_hidden('kriteria.edit') }}><i class="fa fa-edit"></i> Ubah</a>
					<form action="{{ route('kriteria.destroy', $row) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Hapus Data?')" {{ is_hidden('kriteria.destroy') }}>
						{{ csrf_field() }}
						{{ method_field('DELETE') }}
						<button type="submit" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Hapus</button>
					</form></center>
				</td>
			</tr>
			@endforeach

			<!-- Modal Edit -->
			@foreach ($rows as $row)
				<div class="modal fade" id="modal-edit-{{ $row->kode_kriteria }}"  tabindex="-1">
					<div class="modal-dialog modal-xl" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title">Edit Data Kriteria</h4>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span></button>
							</div>
							<div class="modal-body">
								<!-- form start -->
								<form action="{{ route('kriteria.update', $row->kode_kriteria) }}" method="post">
									<div class="card">
										<div class="card-body">
											<div class="row">
												<div class="col-md-6">
													{{show_error($errors)}}
													{{ csrf_field() }}
													{{ method_field('PUT') }}
													<div class="form-group">
														<label>Kode kriteria <span class="text-danger">*</span></label>
														<input class="form-control" type="text" name="kode_kriteria" value="{{ old('kode_kriteria', $row->kode_kriteria) }}" readonly>
													</div>
													<div class="form-group">
														<label>Nama kriteria <span class="text-danger">*</span></label>
														<input autocomplete="off" class="form-control" type="text" name="nama_kriteria" value="{{ old('nama_kriteria', $row->nama_kriteria) }}" required>
													</div>
													<div class="form-group">
														<label>Atribut <span class="text-danger">*</span></label>
														<select class="form-control" name="atribut" id="atribut" value="{{ old('atribut', $row->atribut) }}" required>
															<option value selected="selected">-- Pilih Atribut --</option>
															<?= get_atribut_option(old('atribut', $row->atribut)) ?>
														</select>
													</div>
													<div class="form-group">
														<label>Bobot <span class="text-danger">*</span></label>
														<input class="form-control" type="text" name="bobot" value="{{ old('bobot', $row->bobot) }}" required>
													</div>
													<div class="form-group">
														<label>Range <span class="text-danger">*</span></label>
														<?php
															$range = DB::table('tb_range')->where('kode_kriteria', '=', $row->kode_kriteria)->get();
															$toEnd = count($range);
															foreach($range as $col){
																if (0 == --$toEnd) { ?>
																	<div class="input-group control-group after-add-more2" style="margin-top:10px">
																		<input type="text" autocomplete="off" name="range[]" value="{{ old('range', $col->range) }}" class="form-control" placeholder="Masukkan Data Range" value="{{ old('range') }}">
																		<div class="input-group-btn"> 
																			<button class="btn btn-danger remove2" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
																			<button class="btn btn-success add-more2" type="button"><i class="glyphicon glyphicon-plus"></i> Add</button>
																		</div>
																	</div>
														<?php }else{?>
																	<div class="input-group control-group after-add-more2" style="margin-top:10px">
																		<input type="text" autocomplete="off" name="range[]" value="{{ old('range', $col->range) }}" class="form-control" placeholder="Masukkan Data Range" value="{{ old('range') }}">
																		<div class="input-group-btn"> 
																			<button class="btn btn-danger remove2" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
																		</div>
																	</div>
															<?php }
															} 
														?>
														<div class="last"></div>
													</div>
													<script type="text/javascript">
														$(document).ready(function() {
															$(".add-more2").click(function(){ 
																var html = '<div class="input-group control-group after-add-more2" style="margin-top:10px">'+
																		'<input type="text" autocomplete="off" name="range[]" value="" class="form-control" placeholder="Masukkan Data Range" >' +
																		'<div class="input-group-btn"> ' +
																			'<button class="btn btn-danger remove2" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>' +
																			'<button class="btn btn-success add-more2" type="button"><i class="glyphicon glyphicon-plus"></i> Add</button>' +
																		'</div>' +
																	'</div>'+
																'</div>';
																$(".last").before(html);
															});
															$("body").on("click",".remove2",function(){ 
																$(this).parents(".control-group").remove();
															});
														});
													</script>
												</div>
											</div>
										</div>
										<div class="card-footer">
											<button class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
											<a class="btn btn-danger" href="{{URL('kriteria')}}"><i class="fa fa-backward"></i> Kembali</a>
										</div>
									</div>
								</form>
							</div>
						</div>
						<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
				</div>
			@endforeach

		</table>
	</div>
	@if ($rows->hasPages())
	<div class="card-footer">
		{{ $rows->links() }}
	</div>
	@endif
</div>

<!-- Modal -->
<div class="modal fade show" id="modal-add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Data Kriteria</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  	<form action="{{ URL('kriteria') }}" method="POST">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-md-6">
							{{ show_error($errors) }}
							{{ csrf_field() }}
							<div class="form-group">
								<label>Kode <span class="text-danger">*</span></label>
								<input class="form-control" type="text" name="kode_kriteria" value="{{ old('kode_kriteria', kode_oto('kode_kriteria', 'tb_kriteria', 'C', 2)) }}" readonly/>
							</div>
							<div class="form-group">
								<label>Nama kriteria <span class="text-danger">*</span></label>
								<input class="form-control" autocomplete="off" type="text" name="nama_kriteria" value="{{ old('nama_kriteria') }}" required />
							</div>
							<div class="form-group">
								<label>Atribut <span class="text-danger">*</span></label>
								<select class="form-control @error('atribut') is-invalid @enderror" name="atribut" required>
									<option value selected="selected">-- Pilih Atribut --</option>
									<?= get_atribut_option(old('atribut')) ?>
								</select>
							</div>
							<div class="form-group">
								<label>Bobot <span class="text-danger">*</span></label>
								<input class="form-control" autocomplete="off" type="text" name="bobot" value="{{ old('bobot') }}" required />
							</div>
						</div>	
						<div class="col-md-6">
							<div class="form-group">
								<label>Range </label>
								<div class="input-group control-group after-add-more">
									<input type="text" autocomplete="off" name="range[]" class="form-control" placeholder="Masukkan Data Range" value="{{ old('range') }}">
									<div class="input-group-btn"> 
										<button class="btn btn-success add-more" type="button"><i class="glyphicon glyphicon-plus"></i> Add</button>
									</div>
								</div>
								<!-- Copy Fields -->
								<div class="copy invisible">
								<div class="control-group input-group" style="margin-top:10px">
									<input type="text" autocomplete="off" name="range[]" class="form-control" placeholder="Masukkan Data Range">
									<div class="input-group-btn"> 
										<button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
									</div>
								</div>		
							</div>
							<script type="text/javascript">
								$(document).ready(function() {
									$(".add-more").click(function(){ 
										var html = $(".copy").html();
										$(".copy").before(html);
									});
									$("body").on("click",".remove",function(){ 
										$(this).parents(".control-group").remove();
									});
								});
							</script>
						</div>
					</div>
				</div>
				<div class="card-footer">
					<button class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
					<a class="btn btn-danger" href="{{ route('kriteria.index') }}"><i class="fa fa-backward"></i> Kembali</a>
				</div>
			</div>		
		</form>
	  </div>
    </div>
  </div>
</div>

@endsection