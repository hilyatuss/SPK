@extends('layout.app')
@section('title', $title)
@section('content')
<form action="{{ URL('kriteria') }}" method="POST">
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-md-6">
					{{ show_error($errors) }}
					{{ csrf_field() }}
					<div class="form-group">
						<label>Kode <span class="text-danger">*</span></label>
						<input class="form-control" type="text" name="kode_kriteria" value="{{ old('kode_kriteria', kode_oto('kode_kriteria', 'tb_kriteria', 'C', 2)) }}" />
					</div>
					<div class="form-group">
						<label>Nama kriteria <span class="text-danger">*</span></label>
						<input class="form-control" autocomplete="off" type="text" name="nama_kriteria" value="{{ old('nama_kriteria') }}" />
					</div>
					<!-- <div class="form-group">
						<label>Range 1 <span class="text-danger">*</span></label>
						<input class="form-control" type="text" name="range1" value="{{ old('range1') }}" />
					</div> -->
					<!-- <div class="form-group">
						<label>Range 2 <span class="text-danger">*</span></label>
						<input class="form-control" type="text" name="range2" value="{{ old('range2') }}" />
					</div> -->
					<div class="form-group">
						<label>Atribut <span class="text-danger">*</span></label>
						<select class="form-control" name="atribut">
							<?= get_atribut_option(old('atribut')) ?>
						</select>
					</div>
					<div class="form-group">
						<label>Bobot <span class="text-danger">*</span></label>
						<input class="form-control" autocomplete="off" type="text" name="bobot" placeholder="Masukkan angka 1-5" value="{{ old('bobot') }}" />
					</div>
					<div class="form-group">
						<div class="input-group control-group after-add-more">
							<input type="text" autocomplete="off" name="range[]" class="form-control" placeholder="Enter Name Here" value="{{ old('range') }}">
							<div class="input-group-btn"> 
								<button class="btn btn-success add-more" type="button"><i class="glyphicon glyphicon-plus"></i> Add</button>
							</div>
						</div>
						<!-- Copy Fields -->
						<div class="copy invisible">
						<div class="control-group input-group" style="margin-top:10px">
							<input type="text" autocomplete="off" name="range[]" class="form-control" placeholder="Enter Name Here">
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
					<!-- <form name="add_name" id="add_name" enctype="multipart/form-data" action="home" method="post">
						@csrf
						<div class="input-group control-group after-add-more">
							<input type="text" name="name[]" placeholder="Enter your Name" class="form-control name_list" />
							<div class="input-group-btn"> 
								<button name="add" id="add" class="btn btn-success add-more" type="button"><i class="glyphicon glyphicon-plus"></i> Add</button>
							</div>
						</div>	
					</form>
					<script type="text/javascript">
						$('#add_name').submit(function(e) {
							e.preventDefault();
							var form = $(this);
							var formData = new FormData(this);
							$.ajax({
								url: form.attr('action'),
								method: "POST",
								data: formData,
								type: 'json',
								processData: false,
								contentType: false,
								success: function(data) {
									if (data.error) {
										printErrorMsg(data.error);
									} else {
										i = 1;
										$('.dynamic-added').remove();
										$('#add_name')[0].reset();
										$(".print-success-msg").find("ul").html('');
										$(".print-success-msg").css('display', 'block');
										$(".print-error-msg").css('display', 'none');
										$(".print-success-msg").find("ul").append('<li>Record Inserted Successfully.</li>');
										// location.href = "http://www.example.com/ThankYou.html"
									}
								}
							});
							return false;
						});
					</script> -->
				</div>
			</div>
		</div>
		<div class="card-footer">
			<button class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
			<a class="btn btn-danger" href="{{ route('kriteria.index') }}"><i class="fa fa-backward"></i> Kembali</a>
		</div>
	</div>				
	<script type="text/javascript">
	// $(document).ready(function(){
	// 	var maxField = 10; //Input fields increment limitation
	// 	var addButton = $('#add_button'); //Add button selector
	// 	var wrapper = $('.field_wrapper'); //Input field wrapper
	// 	var fieldHTML = '<div class="form-group add"><div class="row">';
	// 	fieldHTML=fieldHTML + '<div class="col-md-10"><input class="form-control" placeholder="Range" type="text" name="range[]" value="{{ old('range[]') }}" /></div>';
	// 	fieldHTML=fieldHTML + '<div class="col-md-2"><a href="javascript:void(0);" class="remove_button btn btn-danger">HAPUS</a></div>';
	// 	fieldHTML=fieldHTML + '</div></div>'; 
	// 	var x = 1; //Initial field counter is 1
		
	// 	//Once add button is clicked
	// 	$(addButton).click(function(){
	// 		//Check maximum number of input fields
	// 		if(x < maxField){ 
	// 			x++; //Increment field counter
	// 			$(wrapper).append(fieldHTML); //Add field html
	// 		}
	// 	});
		
	// 	//Once remove button is clicked
	// 	$(wrapper).on('click', '.remove_button', function(e){
	// 		e.preventDefault();
	// 		$(this).parent('').parent('').remove(); //Remove field html
	// 		x--; //Decrement field counter
	// 	});
	// });
	</script>
</form>
@endsection