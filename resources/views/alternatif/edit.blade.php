@extends('layout.app')
@section('title', $title)
@section('content')
<form action="{{ route('alternatif.update', $row) }}" method="post">
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
						<input class="form-control" type="text" name="nama_alternatif" value="{{ old('nama_alternatif', $row->nama_alternatif) }}">
					</div>
					<div class="form-group">
						<label>Jenis Kelamin <span class="text-danger">*</span></label>
						<input class="form-control" type="text" name="jenis_kelamin" value="{{ old('jenis_kelamin', $row->jenis_kelamin) }}">
					</div>
					<div class="form-group">
						<label>Program Studi <span class="text-danger">*</span></label>
						<input class="form-control" type="text" name="prodi" value="{{ old('prodi', $row->prodi) }}">
					</div>
					<div class="form-group">
						<label>Semester <span class="text-danger">*</span></label>
						<input class="form-control" type="text" name="semester" value="{{ old('semester', $row->semester) }}">
					</div>
				</div>
			</div>
		</div>
		<div class="card-footer">
			<button class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
			<a class="btn btn-danger" href="{{URL('alternatif')}}"><i class="fa fa-backward"></i> Kembali</a>
		</div>
	</div>
</form>
@endsection