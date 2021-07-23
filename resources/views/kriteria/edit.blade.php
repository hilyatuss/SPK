@extends('layout.app')
@section('title', $title)
@section('content')
<form action="{{ route('kriteria.update', $row) }}" method="post">
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
						<input autocomplete="off" class="form-control" type="text" name="nama_kriteria" value="{{ old('nama_kriteria', $row->nama_kriteria) }}">
					</div>
					<div class="form-group">
						<label>Atribut <span class="text-danger">*</span></label>
						<select class="form-control" name="atribut">
							<?= get_atribut_option(old('atribut', $row->atribut)) ?>
						</select>
					</div>
					<div class="form-group">
						<label>Bobot <span class="text-danger">*</span></label>
						<input class="form-control" type="text" name="bobot" value="{{ old('bobot', $row->bobot) }}" />
					</div>
					<div class="form-group">
						<label>Range <span class="text-danger">*</span></label>
						<div class="input-group control-group after-add-more">
							<input type="text" autocomplete="off" name="range[]" value="{{ old('range', $row->range) }}" class="form-control" placeholder="Masukkan Data Range" value="{{ old('range') }}">
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
							$(".after-add-more").after(html);
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
			<a class="btn btn-danger" href="{{URL('kriteria')}}"><i class="fa fa-backward"></i> Kembali</a>
		</div>
	</div>
</form>
@endsection