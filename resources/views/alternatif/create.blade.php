@extends('layout.app')
@section('title', $title)
@section('content')
<form action="{{ URL('alternatif') }}" method="POST">
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
						<label>Nama alternatif <span class="text-danger">*</span></label>
						<input class="form-control" type="text" name="nama_alternatif" value="{{ old('nama_alternatif') }}" />
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
						<label>Semester <span class="text-danger">*</span></label>
						<select class="form-control" name="semester">
							<?= get_semester_option(old('semester')) ?>
						</select>
					</div>
				</div>
			</div>
		</div>
		<div class="card-footer">
			<button class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
			<a class="btn btn-danger" href="{{ route('alternatif.index') }}"><i class="fa fa-backward"></i> Kembali</a>
		</div>
	</div>
</form>
@endsection