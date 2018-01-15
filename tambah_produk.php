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
		function generate()
			{
			    var text = "PD";
			    var possible = "0123456789";

			    for( var i=0; i < 7; i++ )
			        text += possible.charAt(Math.floor(Math.random() * possible.length));

			    return text;
			}


		$(document).ready(function(){
			$('.toggle-sidebar').click(function(){
				$('.wrapper').toggleClass('toggled');
			})

			var gen=generate()
			$('input[name=kodeproduk').val(gen)
			
			$.ajax({
				url:'function/prosestambahproduk.php',
				data:{getkategori:true},
				dataType:'html',
				success:function(data){
					$('.kategori').html(data);
				}
			})
			$('.btn-generate').click(function(){
				var gen=generate()
				$('input[name=kodeproduk').val(gen)
			})
			$('.tambahdata').validate({
				submitHandler:function(form){
					 $.ajax({
			            url:'function/prosestambahproduk.php',
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
					kodeproduk:{
						required:true,
						remote:{
							url: "function/validasi.php",
							type: "post",
							data: {
								kodeproduk: function() {
            					return $( "input[name=kodeproduk]" ).val();
          						}
							}
						}
					},
					namaproduk:{
						required:true
					},
					stok:{
						number:true
					},
					hargamodal:{
						required:true,
						number:true
					},
					hargajual:{
						required:true,
						number:true
					}
				},
				messages:{
					kodeproduk:{
						required:'wajib diisi',
						remote:'kode produk tidak tersedia'
					},
					namaproduk:{
						required:'wajib diisi'
					},
					hargamodal:{
						required:'wajib diisi',
						number:'harus berupa angka'
					},
					hargajual:{
						required:'wajib diisi',
						number:'harus berupa angka'
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
			<div class="form-row">
			<h4 class="">Tambah Produk</h4>
	 		<form class="tambahdata">

	 			<div class="form-group row">
	 				<label for="kodeproduk" class="col-form-control col-sm-2">Kode produk</label>
	 				<div class="col-sm-offset-1 col-sm-7">
	 				<input type="text" name="kodeproduk" class="form-control kodeproduk" placeholder="b001" >
	 				</div>
	 				<div class="col-sm-2">
	 					<button type="button" class="btn btn-secondary btn-generate">Generate</button>
	 				</div>
	 			</div>

	 			<div class="form-group row">
	 				<label for="namaproduk" class="col-form-control col-sm-2">Nama produk</label>
	 				<div class="col-sm-offset-1 col-sm-9">
	 					<input type="text" name="namaproduk" class="form-control" placeholder="Baju polos" >	
	 				</div>
	 			</div>

	 			<div class="form-group row">
	 				<label for="size" class="col-form-control col-sm-2">Size</label>
	 				<div class="col-sm-offset-1 col-sm-9">
	 					<input type="text" name="size" class="form-control" placeholder="40/S/M/L" >	
	 				</div>
	 			</div>

	 			<div class="form-group row">
	 				<label for="kategori" class="col-form-control col-sm-2">Kategori</label>
	 				<div class="col-sm-offset-1 col-sm-2">
	 					<select name="kategori" class="form-control kategori"> 
	 						
	 					</select>	
	 				</div>
	 			</div>

	 			<div class="form-group row">
	 				<label for="hargamodal" class="col-form-control col-sm-2">Harga Modal</label>
	 				<label for="hargamodal" class="col-form-control col-sm-offset-1 col-sm-1">Rp. </label>
	 				<div class="col-sm-4">
	 					<input type="number" name="hargamodal" class="form-control" placeholder="100000">	
	 				</div>
	 			</div>
	 			<div class="form-group row">
	 				<label for="hargajual" class="col-form-control col-sm-2">Harga Jual</label>
	 				<label for="hargajual" class="col-form-control col-sm-offset-1 col-sm-1">Rp. </label>
	 				<div class="col-sm-4">
	 					<input type="number" name="hargajual" class="form-control" placeholder="100000">	
	 				</div>
	 			</div>
	 			<div class="form-group row">
	 				<label for="diskon" class="col-form-control col-sm-2">Diskon</label>
	 					<div class="col-sm-offset-1 col-sm-2">
	 					<select name="diskon" class="form-control"> 
	 						<?php 
	 							for($i=0;$i<=100;$i+=5){
									$diskon=0.01*$i;
									echo "<option value='$diskon'>$i %</option>";
								}
	 						 ?>
	 					</select>	
	 				</div>	
	 			</div>

	 			<div class="form-group row">
	 				<label for="stok" class="col-form-control col-sm-2">Stok</label>
	 				<div class="col-sm-offset-1 col-sm-9">
	 					<input type="number" name="stok" class="form-control" value="0">	
	 				</div>
	 			</div>

	 			<div class="form-group row">
	 				<label for="Deskripsi" class="col-form-control col-sm-2">Deskripsi</label>
	 				<div class="col-sm-offset-1 col-sm-9">
	 					<textarea name="deskripsi" class="form-control" rows="5" value='haha'></textarea>
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

</body>
</html>

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
