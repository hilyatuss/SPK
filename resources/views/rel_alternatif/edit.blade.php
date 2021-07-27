@extends('layout.app')
@section('title', $title)
@section('content')
<form action="{{ route('rel_alternatif.update', $row) }}" method="post">
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-md-6">
					{{show_error($errors)}}
					{{ csrf_field() }}
					{{ method_field('PUT') }}
					<div class="form-group">
						<label>NIM <span class="text-danger">*</span></label>
						<input class="form-control" type="text" name="nim" value="{{ old('nim', $row->nim) }}" readonly>
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
@endsection