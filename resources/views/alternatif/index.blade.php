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
			<!-- <div class="form-group mr-1" {{ is_hidden('alternatif.create') }}>
				<a class="btn btn-primary" href="{{ route('alternatif.create') }}"><i class="fa fa-plus"></i> Tambah</a>
			</div> -->
			<div class="form-group mr-1" {{ is_hidden('alternatif.cetak') }}>
				<a class="btn btn-default" href="{{ route('alternatif.cetak') }}" target="_blank"><span class="fa fa-print"></span> Cetak</a>
			</div>
		</form>
	</div>
	<div class="card-body p-0 table-responsive">
		<table class="table table-bordered table-hover">
			<thead>
			<th width = "3px">No</th>
				<th width = "7px">NIM</th>
				<th>Nama alternatif</th>
				<th><center>Jenis Kelamin</center></th>
				<th><center>Program Studi</center></th>
				<th><center>Semester</center></th>
				<th><center>Aksi</center></th>
			</thead>
			@foreach($rows as $key => $row)
			<tr>
				<td>{{ ($rows->currentPage() - 1) * $limit + $key + 1}}</td>
				<td><center>{{ $row->nim }}</center></td>
				<td>{{ $row->nama_user }}</td>
				<td><center>{{ $row->jenis_kelamin }}</center></td>
				<td><center>{{ $row->prodi }}</center></td>
				<td><center>{{ $row->semester }}</center></td>
				<td><center>

					<a class="btn btn-xs btn-info" href="{{ route('alternatif.edit', $row->nim) }}" data-toggle="modal" data-target="#modal-edit-{{ $row->nim }}" {{ is_hidden('alternatif.edit') }}><i class="fa fa-edit"></i> Ubah</a>
					<form action="{{ route('alternatif.destroy', $row->nim) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Hapus Data?')" {{ is_hidden('alternatif.destroy') }}>
						{{ csrf_field() }}
						{{ method_field('DELETE') }}
						<button type="submit" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Hapus</button>
					</form></center>
				</td>
			</tr>
			@endforeach
			
			@foreach ($rows as $row)
				<div class="modal fade" id="modal-edit-{{ $row->nim }}"  tabindex="-1">
					<div class="modal-dialog modal-l" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title">Edit Data Alternatif</h4>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span></button>
							</div>
							<div class="modal-body">
								<!-- form start -->
								<form action="{{ route('alternatif.update', $row->nim) }}" method="post">
									<div class="card">
										<div class="card-body">
											<div class="row">
												<div class="col-md-12">
													{{show_error($errors)}}
													{{ csrf_field() }}
													{{ method_field('PUT') }}
													<div class="form-group">
														<label>NIM <span class="text-danger">*</span></label>
														<input autocomplete="off" class="form-control" type="text" name="nim" value="{{ old('nim', $row->nim) }}">
													</div>
													<div class="form-group">
														<label>Nama alternatif <span class="text-danger">*</span></label>
														<input autocomplete="off" class="form-control" type="text" name="nama_alternatif" value="{{ old('nama_alternatif', $row->nama_user) }}" readonly>
													</div>
													<div class="form-group">
														<label>Jenis Kelamin<span class="text-danger">*</span></label>
														<select class="form-control" name="jenis_kelamin" id="jenis_kelamin" value="{{ old('jenis_kelamin', $row->jenis_kelamin) }}" required>
															<option value selected="selected">-- Pilih Jenis Kelamin --</option>
															<option value="Laki-laki" {{ $row->jenis_kelamin == 'Laki-laki' ? 'selected' : ' '}} >Laki-laki</option>
															<option value="Perempuan" {{ $row->jenis_kelamin == 'Perempuan' ? 'selected' : ' '}} >Perempuan</option>
														</select>
														@error('jenis_kelamin')
															<div class="invalid-feedback">{{ $message }}</div>
														@enderror
													</div>
													<div class="form-group">
														<label>Program Studi <span class="text-danger">*</span></label>
														<select class="form-control" name="prodi" id="prodi" value="{{ old('prodi', $row->prodi) }}" required>
															<option value selected="selected">-- Pilih Program Studi --</option>
															<option value="Teknik Komputer Kontrol" {{ $row->prodi == 'Teknik Komputer Kontrol' ? 'selected' : ' '}}>Teknik Komputer Kontrol</option>
															<option value="Teknik Listrik" {{ $row->prodi == 'Teknik Listrik' ? 'selected' : ' '}}>Teknik Listrik</option>
															<option value="Mesin Otomotif" {{ $row->prodi == 'Mesin Otomotif' ? 'selected' : ' '}}>Mesin Otomotif</option>
															<option value="Teknologi Informasi" {{ $row->prodi == 'Teknologi Informasi' ? 'selected' : ' '}}>Teknologi Informasi</option>
															<option value="Teknik Perkeretaapian" {{ $row->prodi == 'Teknik Perkeretaapian' ? 'selected' : ' '}}>Teknik Perkeretaapian</option>
															<option value="Komputerisasi Akuntansi" {{ $row->prodi == 'Komputerisasi Akuntansi' ? 'selected' : ' '}}>Komputerisasi Akuntansi</option>
															<option value="Akuntansi" {{ $row->prodi == 'Akuntansi' ? 'selected' : ' '}}>Akuntansi</option>
															<option value="Administrasi Bisnis" {{ $row->prodi == 'Administrasi Bisnis' ? 'selected' : ' '}}>Administrasi Bisnis</option>
															<option value="Bahasa Inggris" {{ $row->prodi == 'Bahasa Inggris' ? 'selected' : ' '}}>Bahasa Inggris</option>
														</select>
														@error('prodi')
															<div class="invalid-feedback">{{ $message }}</div>
														@enderror
													</div>
													<div class="form-group">
														<label>Semester <span class="text-danger">*</span></label>
														<select class="form-control" name="semester" id="semester" value="{{ old('semester') }}" required>
															<option value selected="selected">-- Pilih Semester --</option>
															<option value="1" {{ $row->semester == '1' ? 'selected' : ' '}} >1</option>
															<option value="2" {{ $row->semester == '2' ? 'selected' : ' '}} >2</option>
														</select>
														@error('semester')
															<div class="invalid-feedback">{{ $message }}</div>
														@enderror
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

@endsection