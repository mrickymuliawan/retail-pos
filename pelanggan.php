<!DOCTYPE html>
<?php 
	include("function/koneksi.php");
 ?>
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
			$('.sidebar-wrapper').hover(function(){
				$('.wrapper').toggleClass('toggled');
			})
			
			function load(p){
				$.ajax({
				url:'function/prosespelanggan.php',
				data:{caridata:$('input[name=caridata]').val(),
					  maxdata:$('.maxdata').val(),
					  page:p,
					  load:true},
				dataType:'json',
				success:function(data){
						$('.table-data tbody').html(data.table);
						$('.row-button').html(data.button);
						$('.row-total-data span').html(data.totaldata)
					}
				})
			}
			
			// LOAD DATA 
			load(1);

			// SEARCH DATA 
			$('.btn-cari').click(function(){ 
				load(1) 
			})

			// ATUR JUMLAH DATA YANG DITAMPILKAN
			$('.maxdata').change(function(){
				load(1)
			})

			$('.row-button').on('click','.btn-page',function(){
				load($(this).val())
			})

// ========================================================================================================//
// ========================================================================================================//
			// HAPUS DATA
			
			$('.table-data tbody').on('click','.btn-hapus',function(){
				var kode=$(this).val();
			    $('.modal-confirm').modal('show');
			    $('.btn-submit').click(function(){
			    	$.ajax({
						url:'function/prosespelanggan.php',
						data:{kodepelanggan:kode,hapusdata:true},
						success:function(data){
							 location.reload();
						}
					})
			        
			    }) 
				
			})

			//EDIT DATA
			$('.table-data tbody').on('click','.btn-edit',function(){
				
				$.ajax({
					url:'function/prosespelanggan.php',
					data: {kodepelanggan:$(this).val(),ambileditdata:true},
					dataType:'json',
					success:function(data){
						$('.modal-form-edit input[name=kodepelanggan]').val(data.kode_pelanggan);
						$('.modal-form-edit input[name=namapelanggan]').val(data.nama_pelanggan);
						$('.modal-form-edit textarea[name=alamat]').val(data.alamat);
						$('.modal-form-edit input[name=notelp]').val(data.no_telp);
						$('.modal-form-edit input[name=akun]').val(data.akun);		
			            $('.modal-form-edit').modal('show');
						
					}
				})
			})
			// VALIDASI FORM EDIT
			$('.editdata').validate({
				submitHandler:function(form){
					 $.ajax({
			            url:'function/prosespelanggan.php',
			            type:'post',
			            data:$(form).serialize()+"&editdata=true",
			            success: function(data){
			               $('.modal-info .infobody').html(data);
			               $('.modal-info').modal('show');
			               $('.modal-form-edit').modal('hide');
			               $('.btn-tutup').click(function(){
			               		location.reload();
			               }) 
			            }
			        });
				},
				rules:{
					kodepelanggan:{
						required:true
					},
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
					kodepelanggan:{
						required:'wajib diisi',
					},
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
	 	<div class="tool-row">
		 	<div class="row">
		 		<div class="col-sm-5">
				 	<div class="input-group">
						<div class="input-group-addon">
							<span class="fa fa-search "></span>
						</div>
						<input type="text" name="caridata" placeholder="Cari sesuai nama pelanggan.." class="form-control" >	
					</div>
				</div>

				<div class="col-sm-1">
					<button type="button" class="btn btn-secondary btn-cari">Search</button>
				</div>

		 		<div class="offset-sm-4 col-sm-2">
						<a href='tambah_pelanggan.php' class="btn btn-info tomboltambah">Tambah Pelanggan</a>
				</div>
		 	</div>
	 		<div class="row">
		 			
			 	

		 		<div class="offset-sm-10 col-sm-2">
				 		<select name='maxdata' class="form-control maxdata">	
							<option value='10' selected="true">10</option>
							<option value='25'>25</option>
							<option value='50'>50</option>
							<option value='100'>100</option>
						</select>
				</div>	
	
			</div>
			</div>

			<div class="table-row">
		 		<div class="row">
			 		<div class="col-sm-2 row-total-data">
			 				<h5>Total Data <span class="tag tag-info">  </span></h5>
						</div>
		 			<div class="offset-sm-8 col-sm-2 row-button">
		 				
					</div>
					
		 		</div>	

				<table class="table-data table table-striped">
					<thead>
					<tr>
						<td>Kode Pelanggan</td>
			 			<td>Nama Pelanngan</td>
			 			<td>Alamat </td>
			 			<td>No HP</td>
			 			<td>Akun</td>
			 		</tr>	
					</thead>
					<tbody></tbody>
				</table>
				<div class="row">
		 		
		 			<div class="offset-sm-10 col-sm-2 row-button">
		 				
					</div>
				
	 			</div>
	 		</div>	
	 	</div>	
 	</div>
 		
</div>


</body>
</html>



	<div class="modal fade modal-form-edit" role="dialog">
		<div class="modal-dialog ">
			<div class="modal-content">
			    <div class="modal-header">
			    	<button type="button" class="close" data-dismiss="modal">&times;</button>
			        <h4 class="modal-title">Edit Data</h4>
			    </div>
			    <form class="editdata">
				<div class="modal-body">
					

			 			<div class="form-group row">
			 				<label for="kodepelanggan" class="col-form-label col-sm-4">Kode pelanggan</label>
			 				<div class="col-sm-8">
			 					<input type="text" name="kodepelanggan" class="form-control" placeholder="b001" readonly="true">	
			 					<div class="error"></div>
			 				</div>
			 			</div>

			 			<div class="form-group row">
			 				<label for="namapelanggan" class="col-form-label col-sm-4">Nama Pelanggan</label>
			 				<div class="col-sm-8">
			 					<input type="text" name="namapelanggan" class="form-control" placeholder="Baju polos" >	
			 				</div>
			 			</div>

			 			
			 			<div class="form-group row">
			 				<label for="alamat" class="col-form-label col-sm-4">Alamat</label>
			 				<div class="col-sm-8">
			 					<textarea name="alamat" class="form-control" rows="5" value='haha'></textarea>
			 				</div>
			 			</div>

			 			<div class="form-group row">
			 				<label for="notelp" class="col-form-label col-sm-4">No Telephone</label>
			 				<div class="col-sm-8">
			 					<input type="text" name="notelp" class="form-control" placeholder="nomor handphone" >	
			 				</div>
			 			</div>

			 			<div class="form-group row">
			 				<label for="akun" class="col-form-label col-sm-4">Akun</label>
			 				<div class="col-sm-8">
			 					<input type="text" name="akun" class="form-control" placeholder="akun" >	
			 				</div>
			 			</div>
	 		 
				</div>

				<div class="modal-footer">
			      	<input type="submit" class="btn btn-info">
			        <button type="button" class="btn btn-default" data-dismiss="modal" >Close</button>
			    </div>

				</form>    
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
			      <div class="modal-body infobody">
			        
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default btn-tutup" data-dismiss="modal" >Tutup</button>
			      </div>
			    </div>
 			</div>
 	</div>
 	<div class="modal modal-confirm" role="dialog">
	 		<div class="modal-dialog modal-sm">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal">&times;</button>
			        <h4 class="modal-title">Informasi</h4>
			      </div>
			      <div class="modal-body infobody">
			        	Anda yakin?
			      </div>
			      <div class="modal-footer">
			      	<button type="button" class="btn btn-danger btn-submit">Submit</button>
			        <button type="button" class="btn btn-default cancel" data-dismiss="modal" >Cancel</button>
			        
			      </div>
			    </div>
 		</div>
 	</div>















