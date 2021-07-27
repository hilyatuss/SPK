@extends('layout.app')
@section('title', $title)
@section('content')
{{ show_msg() }}
<div class="col-md-6">
	<div class="card card-row card-default">
		<div class="card-header bg-primary">
			<h3 class="card-title">
				Periode Beasiswa
			</h3>
		</div>
		<div class="card-body">
			<div class="card-body">
				<p>
					Dimulai : {{ $periode->mulai }}
				</p>
				<p>
					Selesai : {{ $periode->selesai }}
				</p>
			</div>
			<?php
				$date_now = date("Y-m-d"); 

				if ($date_now > $periode->selesai && $date_now < $periode->mulai) {
					echo "
					<div class='col-md-4 right'>
						<button type='button' class='btn btn-primary'  data-toggle='modal' data-target='#modal-add' disabled>
							Daftar Beasiswa
						</button>
					</div>
					";
				}else{
					echo "
						<div class='col-md-4 right'>
							<button type='button' class='btn btn-primary'  data-toggle='modal' data-target='#modal-add'>
								Daftar Beasiswa
							</button>
						</div>
						";
				}
			?>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade show" id="modal-add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Daftar Beasiswa Bidikmisi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <form action="{{ URL('mahasiswa') }}" enctype="multipart/form-data" method="POST">
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-md-5">
						{{ show_error($errors) }}
						{{ csrf_field() }}
						<div class="form-group">
							<label>NIM <span class="text-danger">*</span></label>
							<input class="form-control" autocomplete="off" type="text" name="nim" value="{{ old('nim') }}" required />	
							@error('nim')
								<div class="invalid-feedback">{{ $message }}</div>
							@enderror						
						</div>
						<div class="form-group">
							<label>Nama Lengkap<span class="text-danger">*</span></label>
							<input class="form-control" autocomplete="off" type="text" name="nama_alternatif" value="{{ $user->nama_user }}" readonly />
						</div>
						<div class="form-group">
							<label>Jenis Kelamin<span class="text-danger">*</span></label>
							<select class="form-control @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin" required>
								<option value selected="selected">-- Pilih Jenis Kelamin --</option>
								<option value="Laki-laki">Laki-laki</option>
								<option value="Perempuan">Perempuan</option>
							</select>
							@error('jenis_kelamin')
								<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>
						<div class="form-group">
							<label>Program Studi <span class="text-danger">*</span></label>
							<select class="form-control @error('prodi') is-invalid @enderror" name="prodi" required>
								<option value selected="selected">-- Pilih Program Studi --</option>
								<option value="Teknik Komputer Kontrol">Teknik Komputer Kontrol</option>
								<option value="Teknik Listrik">Teknik Listrik</option>
								<option value="Mesin Otomotif">Mesin Otomotif</option>
								<option value="Teknologi Informasi">Teknologi Informasi</option>
								<option value="Teknik Perkeretaapian">Teknik Perkeretaapian</option>
								<option value="Komputerisasi Akuntansi">Komputerisasi Akuntansi</option>
								<option value="Akuntansi">Akuntansi</option>
								<option value="Administrasi Bisnis">Administrasi Bisnis</option>
								<option value="Bahasa Inggris">Bahasa Inggris</option>
							</select>
							@error('prodi')
								<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>
						<div class="form-group">
							<label>Semester <span class="text-danger">*</span></label>
							<select class="form-control @error('semester') is-invalid @enderror" name="semester" required>
								<option value selected="selected">-- Pilih Semester --</option>
								<option value="1">1</option>
								<option value="2">2</option>
							</select>
							@error('semester')
								<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>
					</div>
					<div class="col-md-7">
						@foreach ($kriterias as $key => $row)
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label>{{ $row->nama_kriteria }}</label>
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
							<div class="col-sm-6">
								<div class="form-group">
									<label style="color:white">{{ $row->nama_kriteria }}</label>
									<input type="file" class="form-control" name="file[{{ $row->kode_kriteria }}]" style="margin-bottom: 30px;" for="file[]" required multiple>
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
    </div>
  </div>
</div>

@endsection
