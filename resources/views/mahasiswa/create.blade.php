@extends('layout.app')
@section('title', $title)
@section('content')
<form action="{{ URL('mahasiswa') }}" enctype="multipart/form-data" method="POST">
<div class="card">
	<div class="card-body">
		<div class="row">
			<div class="col-md-6">
				{{ show_error($errors) }}
				{{ csrf_field() }}
				<div class="form-group" hidden>
					<label>Kode <span class="text-danger">*</span></label>
					<input class="form-control" type="text" name="kode_alternatif" value="{{ old('kode_alternatif', kode_oto('kode_alternatif', 'tb_alternatif', 'A', 2)) }}" />
				</div>
				<div class="form-group">
					<label>Nama Lengkap<span class="text-danger">*</span></label>
					<input class="form-control" autocomplete="off" type="text" name="nama_alternatif" value="{{ old('nama_alternatif') }}" />
				</div>
				<div class="form-group">
					<label>Jenis Kelamin<span class="text-danger">*</span></label>
					<select class="form-control" name="jenis_kelamin">
						<?= get_jenis_kelamin_option(old('jenis_kelamin')) ?>
					</select>
				</div>
				<div class="form-group">
					<label>Program Studi <span class="text-danger">*</span></label>
					<select class="form-control" name="prodi">
						<?= get_prodi_option(old('prodi')) ?>
					</select>
				</div>
				<div class="form-group">
					<label>NIM <span class="text-danger">*</span></label>
					<input class="form-control" autocomplete="off" type="text" name="nim" value="{{ old('nim') }}" />
				</div>
				<div class="form-group">
					<label>Semester <span class="text-danger">*</span></label>
					<select class="form-control" name="semester">
						<?= get_semester_option(old('semester')) ?>
					</select>
				</div>
				@foreach ($kriterias as $key => $row)
				<div class="row">
					<div class="col-sm-12">
						<div class="form-group">
							<label>{{ $row->nama_kriteria }}<span class="text-danger">*</span></label>
							<select class="form-control" name="nilai[{{ $row->kode_kriteria }}]">
								<option></option>
								<?php
									$range = DB::table('tb_range')->where('kode_kriteria', '=', $row->kode_kriteria)->get();
								?>
								@foreach ($range as $num => $rows)
									<option value="{{ $num }}">{{ $rows->range }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-sm-12">
						<div class="form-group">
							<input type="file" class="custom-file-input" id="filename" name="filename[{{ $row->kode_kriteria }}]" style="margin-bottom: 30px;">
							<label class="custom-file-label" for="filename">Choose file</label>
						</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</div>
	<div class="card-footer">
		<button class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
		<a class="btn btn-danger" href="{{ route('home') }}"><i class="fa fa-backward"></i> Kembali</a>
	</div>
</div>
</form>
<!-- <button type="button" class="btn btn-default" data-toggle="modal" data-target="#exampleModal">
	Launch Default Modal
</button> -->
<!-- Modal -->
<!-- <div class="modal fade show" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <form action="{{ URL('mahasiswa') }}" enctype="multipart/form-data" method="POST">
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-md-6">
						{{ show_error($errors) }}
						{{ csrf_field() }}
						<div class="form-group" hidden>
							<label>Kode <span class="text-danger">*</span></label>
							<input class="form-control" type="text" name="kode_alternatif" value="{{ old('kode_alternatif', kode_oto('kode_alternatif', 'tb_alternatif', 'A', 2)) }}" />
						</div>
						<div class="form-group">
							<label>Nama Lengkap<span class="text-danger">*</span></label>
							<input class="form-control" autocomplete="off" type="text" name="nama_alternatif" value="{{ old('nama_alternatif') }}" />
						</div>
						<div class="form-group">
							<label>Jenis Kelamin<span class="text-danger">*</span></label>
							<select class="form-control" name="jenis_kelamin">
								<?= get_jenis_kelamin_option(old('jenis_kelamin')) ?>
							</select>
						</div>
						<div class="form-group">
							<label>Program Studi <span class="text-danger">*</span></label>
							<select class="form-control" name="prodi">
								<?= get_prodi_option(old('prodi')) ?>
							</select>
						</div>
						<div class="form-group">
							<label>NIM <span class="text-danger">*</span></label>
							<input class="form-control" autocomplete="off" type="text" name="nim" value="{{ old('nim') }}" />
						</div>
						<div class="form-group">
							<label>Semester <span class="text-danger">*</span></label>
							<select class="form-control" name="semester">
								<?= get_semester_option(old('semester')) ?>
							</select>
						</div>
						@foreach ($kriterias as $key => $row)
						<div class="row">
							<div class="col-sm-12">
								<div class="form-group">
									<label>{{ $row->nama_kriteria }}<span class="text-danger">*</span></label>
									<select class="form-control" name="nilai[{{ $row->kode_kriteria }}]">
										<?php
											$range = DB::table('tb_range')->where('kode_kriteria', '=', $row->kode_kriteria)->get();
										?>
										@foreach ($range as $num => $rows)
											<option value="{{ $num }}">{{ $rows->range }}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group">
									<input type="file" class="custom-file-input" id="filename" name="filename[{{ $row->kode_kriteria }}]" style="margin-bottom: 30px;">
									<label class="custom-file-label" for="filename">Choose file</label>
								</div>
							</div>
						</div>
						@endforeach
					</div>
				</div>
			</div>
			<div class="card-footer">
				<button class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
				<a class="btn btn-danger" href="{{ route('home') }}"><i class="fa fa-backward"></i> Kembali</a>
			</div>
		</div>
	  </form>
      </div>
      <div class="modal-footer">
	  	<button type="button" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
		<a class="btn btn-danger" data-dismiss="modal"><i class="fa fa-backward"></i> Kembali</a>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div> -->

@endsection
