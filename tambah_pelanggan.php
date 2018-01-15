<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="fonts/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="style.css">
	
	<script src="js/jquery.min.js"></script>
	<script src="js/jquery-validate.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	
	<script type="text/javascript">
		$(document).ready(function(){
			$('.toggle-sidebar').click(function(){
				$('.wrapper').toggleClass('toggled');
			})
			
			$('.tambahdata').validate({
				submitHandler:function(form){
					 $.ajax({
			            url:'function/prosespelanggan.php',
			            type:'post',
			            data:$(form).serialize()+"&tambahdata=true",
			            success: function(data){
			               $('.modal-info .info-body').html(data);
			               $('.modal-info').modal('show');
			               $('.tambahdata').trigger('reset')
			            }
			        });
				},
				rules:{
					
					namapelanggan:{
						required:true
					},
					alamat:{
						required:true
					},
					notelp:{
						number:true
					}
				},
				messages:{
					
					namapelanggan:{
						required:'wajib diisi'
					},
					notelp:{
						required:'wajib diisi',
						number:'harus berupa angka'
					},
					alamat:{
						required:'wajib diisi'
					}
				}		
			})

			
				
		})
	</script>
	
</head>

<body>

<div class="wrapper">
	<div class="sidebar-wrapper">
			<?php include ('templates/sidebar.php'); ?>
	</div>
	<div class="header-wrapper">
		<?php include ('templates/header.php'); ?>
	</div>
 	<div class="page-wrapper">	
		<div class="container-fluid">
			<div class='form-row'>
			<h4>Tambah Pelanggan</h4>
	 		
			<form class="tambahdata">

			 	<div class="form-group row">
			 		<label for="namapelanggan" class="col-form-label col-sm-3">Nama Pelanggan</label>
			 		<div class="col-sm-6">
			 			<input type="text" name="namapelanggan" class="form-control"  >
			 		</div>
			 	</div>
				<div class="form-group row">
				 	<label for="alamat" class="col-form-label col-sm-3">Alamat</label>
				 	<div class="col-sm-6">
				 		<textarea name="alamat" class="form-control" rows="5" ></textarea>
				 	</div>
				 </div>

				 <div class="form-group row">
				 	<label for="notelp" class="col-form-label col-sm-3">No Telp</label>
				 	<div class="col-sm-6">
				 		<input type="text" name="notelp" class="form-control"  >	
				 	</div>
				 </div>

				 <div class="form-group row">
				 	<label for="akun" class="col-form-label col-sm-3">Akun</label>
				 	<div class="col-sm-6">
				 		<input type="text" name="akun" class="form-control" >	
				 	</div>
				</div>
				 			
				 		

				<div class="form-group row">
	 				<div class="offset-sm-9 col-sm-1">
	 					<input type='reset' class="btn btn-danger" value="Reset">
	 					
	 				</div>
	 				<div class="col-sm-1">
	 					<input type='submit' class="btn btn-info" value="Submit">
	 				</div>
	 			</div>
			 			
			</form>
			</div> 
		</div>
 	</div>
</div>



	<div class="modal fade modal-info" role="dialog">
	 		<div class="modal-dialog ">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal">&times;</button>
			        <h4 class="modal-title">Informasi</h4>
			      </div>
			      <div class="modal-body info-body">
			        
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
			      </div>
			    </div>
 			</div>
 	</div>

</body>
</html>