<!DOCTYPE html>
<?php 
	include("function/koneksi.php");
 ?>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="fonts/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="style.css?version=1.2">

	<script src="js/jquery.min.js"></script>
	<script src="js/jquery-validate.min.js"></script>
	<script src="js/tether.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	
	<script type="text/javascript">
		$(document).ready(function(){
			$('.sidebar-wrapper').hover(function(){
				$('.wrapper').toggleClass('toggled');
			})
			
			function load(p){
				$.ajax({
				url:'function/prosesproduk.php',
				data:{caridata:$('input[name=caridata]').val(),
					  kolom:$('select[name=carikolom]').val(),
					  kategori:$('select[name=carikategori]').val(),
					  maxdata:$('.max-data').val(),
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
			$('.max-data').change(function(){
				load(1)
			})

			$('.row-button').on('click','.btn-page',function(){
				load($(this).val())
			})
			//ambil kategori
			$.ajax({
				url:'function/prosestambahproduk.php',
				data:{getkategori:true},
				dataType:'html',
				success:function(data){
					$('.kategori').append(data);
				}
			})

// ========================================================================================================//
// ========================================================================================================//			
			$('.btn-diskon').on('click',function(){
			    $('.modal-setdiskon').modal('show');
			    $('.btn-submit').click(function(){
			    	$.ajax({
						url:'function/prosesproduk.php',
						data:{kategori:$('.modal-setdiskon select[name=carikategori]').val(),
							  diskon:$('.modal-setdiskon .diskon').val(),
							  setdiskon:true},
						success:function(data){
							 location.reload();
						}
					})
			        
			    }) 
				
			})
			// HAPUS DATA
			$('.table-data tbody').on('click','.btn-hapus',function(){
				var kodebrg=$(this).val();
			    $('.modal-confirm').modal('show');
			    $('.btn-submit').click(function(){
			    	$.ajax({
						url:'function/prosesproduk.php',
						data:{kodeproduk:kodebrg,hapusdata:true},
						success:function(data){
							 location.reload();
						}
					})
			        
			    }) 
				
			})


			//tambah stok
			$('.table-data tbody').on('click','.btn-tambahstok',function(){
				var kodebrg=$(this).val();
			    $('.modal-tambahstok').modal('show');
			    $('.btn-submit').click(function(){
			    	$.ajax({
						url:'function/prosesproduk.php',
						data:{kodeproduk:kodebrg,
							  qty:$('input[name=tambahstok]').val(),
							  tambahstok:true},
						success:function(data){
							 location.reload();
						}
					})
			        
			    }) 
				
			})



			//EDIT DATA
			$('.table-data tbody').on('click','.btn-edit',function(){
				
				$.ajax({
					url:'function/prosesproduk.php',
					data: {kodeproduk:$(this).val(),ambileditdata:true},
					dataType:'json',
					success:function(data){
						$('.modal-form-edit input[name=kodeproduk]').val(data.kode_produk);
						$('.modal-form-edit input[name=namaproduk]').val(data.nama_produk);
						$('.modal-form-edit input[name=size]').val(data.size_produk);
						$(".modal-form-edit select[name=kategori] option[value='"+data.kategori+"']").prop('selected','true');
						$('.modal-form-edit input[name=hargamodal]').val(data.harga_modal);
						$('.modal-form-edit input[name=hargajual]').val(data.harga_jual);
						$(".modal-form-edit .diskon option[value='"+data.diskon+"']").prop('selected','true');
						$('.modal-form-edit input[name=stok]').val(data.stok_produk);
						$('.modal-form-edit textarea[name=deskripsi]').val(data.deskripsi);
			            $('.modal-form-edit').modal('show');
						
					}
				})
			})
			// VALIDASI FORM EDIT
			$('.editdata').validate({
				submitHandler:function(form){
					 $.ajax({
			            url:'function/prosesproduk.php',
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
					kodeproduk:{
						required:true
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

		 	<div class="tool-row">
		 		<div class="row">
		 			<div class="col-sm-5">
				 		<div class="input-group">
							<div class="input-group-addon">
								<span class="fa fa-search "></span>
							</div>
							<input type="text" name="caridata" placeholder="Cari data.." class="form-control cari-data" >
							
						</div>
				 	</div>
			 		<div class="offset-sm-4 col-sm-1">
							<a class="btn btn-secondary btn-diskon">Diskon</a>
					</div>
					<div class="col-sm-2">
							<a href='tambah_produk.php' class="btn btn-info">Tambah Produk</a>
					</div>
			 	</div>
		 		<div class="row">
			 			
				 	
				 	<div class="col-sm-3">
						<select name='carikolom' class="form-control">
							<option value='kode_produk' selected="true">Kode Produk</option>
							<option value='nama_produk'>Nama Produk</option>
						</select>
				 	</div>
				 	<div class="col-sm-2">
						<select name='carikategori' class="form-control kategori">
							<option value='' >All</option>
						</select>
				 	</div>
				 	<div class="col-sm-1">
						<button type="button" class="btn btn-secondary btn-cari">Search</button>
				 	</div>

			 		<div class="offset-sm-4 col-sm-2">
					 		<select name='max-data' class="form-control max-data">	
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
		 		
		 				<table class="table-data table table-striped table-hover">
						 	<thead>
						 		<tr>
									<td>checkbox</td>
						 			<td>Kode produk</td>
				 					<td>Nama produk</td>
				 					<td>Size </td>
				 					<td>Harga Modal</td>
				 					<td>Harga Jual</td>
				 					<td>Kategori</td>
				 					<td>Stok produk</td>
				 					<td>Diskon</td>
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



	<div class="modal modal-form-edit" role="dialog">
		<div class="modal-dialog ">
			<div class="modal-content">
			    <div class="modal-header">
			    	<button type="button" class="close" data-dismiss="modal">&times;</button>
			        <h4 class="modal-title">Edit Data</h4>
			    </div>
			    <form class="editdata">
				<div class="modal-body">
					

			 			<div class="form-group row">
			 				<label for="kodeproduk" class="col-form-label col-sm-3">Kode produk</label>
			 				<div class="col-sm-9">
			 					<input type="text" name="kodeproduk" class="form-control" placeholder="b001" readonly="true">	
			 					<div class="error"></div>
			 				</div>
			 			</div>

			 			<div class="form-group row">
			 				<label for="namaproduk" class="col-form-label col-sm-3">Nama produk</label>
			 				<div class="col-sm-9">
			 					<input type="text" name="namaproduk" class="form-control" placeholder="Baju polos" >	
			 				</div>
			 			</div>

			 			<div class="form-group row">
			 				<label for="size" class="col-form-label col-sm-3">Size</label>
			 				<div class="col-sm-9">
			 					<input type="text" name="size" class="form-control" placeholder="40/S/M/L" >	
			 				</div>
			 			</div>

			 			<div class="form-group row">
			 				<label for="kategori" class="col-form-label col-sm-3">Kategori</label>
			 				<div class="col-sm-4">
			 					<select name="kategori" class="form-control kategori"> 
			 						
			 					</select>	
			 				</div>
			 			</div>

			 			<div class="form-group row">
			 				<label for="hargamodal" class="col-form-label col-sm-3">Harga Modal</label>
			 				<label for="hargamodal" class="col-form-label col-sm-1">Rp. </label>
			 				<div class="col-sm-4">
			 					<input type="number" name="hargamodal" class="form-control" placeholder="100000">	
			 				</div>
			 			</div>
			 			<div class="form-group row">
			 				<label for="hargajual" class="col-form-label col-sm-3">Harga Jual</label>
			 				<label for="hargajual" class="col-form-label col-sm-1">Rp. </label>
			 				<div class="col-sm-4">
			 					<input type="number" name="hargajual" class="form-control" placeholder="100000">	
			 				</div>
			 			</div>
				 			
			 			<div class="form-group row">
			 				<label for="diskon" class="col-form-label col-sm-3">Diskon</label>
			 					<div class="col-sm-4">
			 					<select name="diskon" class="form-control diskon">
			 						<?php 
			 							for($i=0;$i<=100;$i+=5){
											$diskon=0.01*$i;
											echo "<option value='$diskon'>$i</option>";
										}
			 						 ?>
			 					</select>	
			 					</div>
			 				<label for="diskon" class="col-form-label col-sm-1">%</label>	
			 			</div>

			 			<div class="form-group row">
			 				<label for="stok" class="col-form-label col-sm-3">Stok</label>
			 				<div class="col-sm-9">
			 					<input type="number" name="stok" class="form-control" value="0">	
			 				</div>
			 			</div>

			 			<div class="form-group row">
			 				<label for="Deskripsi" class="col-form-label col-sm-3">Deskripsi</label>
			 				<div class="col-sm-9">
			 					<textarea name="deskripsi" class="form-control" rows="5" value='haha'></textarea>
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

	<div class="modal fade modal-setdiskon" role="dialog">
	 		<div class="modal-dialog ">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal">&times;</button>
			        <h4 class="modal-title">Set Diskon</h4>
			      </div>
			      <div class="modal-body infobody">
				      <div class="row">
				        
					 	
					 	<div class="col-sm-6">
							<select name='carikategori' class="form-control kategori">
								<option value='' selected="true">All</option>
								
							</select>
					 	</div>

					 	<div class="col-sm-3">
							<select name="diskon" class="form-control diskon">
				 				<?php 
				 					for($i=0;$i<=100;$i+=5){
										$diskon=0.01*$i;
										echo "<option value='$diskon'>$i %</option> ";
									}
				 				 ?>
				 			</select>	
					 	</div>
				      </div>
			      </div>
			      <div class="modal-footer">
			      	<button type="button" class="btn btn-danger btn-submit">Submit</button>
			        <button type="button" class="btn btn-default" data-dismiss="modal" >Close</button>
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
			      <div class="modal-body infobody">
			        
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default btn-tutup" data-dismiss="modal" >Close</button>
			      </div>
			    </div>
 			</div>
 	</div>
 	<div class="modal modal-confirm" role="dialog">
	 		<div class="modal-dialog modal-sm">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal">&times;</button>
			        <h4 class="modal-title">Hapus Data</h4>
			      </div>
			      <div class="modal-body infobody">
			        	Anda yakin?
			        	
			      </div>
			      <div class="modal-footer">
			      	<button type="button" class="btn btn-danger btn-submit">Submit</button>
			        <button type="button" class="btn btn-default cancel" data-dismiss="modal" >Close</button>
			        
			      </div>
			    </div>
 		</div>
 	</div>
 	<div class="modal modal-tambahstok" role="dialog">
	 		<div class="modal-dialog modal-sm">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal">&times;</button>
			        <h4 class="modal-title">Tambah Stok</h4>
			      </div>
			      <div class="modal-body infobody">
			        	<div class="form-group row">
			        		<label class="col-form-label col-sm-4">QTY +</label>
			        		<div class="col-sm-8">
			        			<input type="number" name="tambahstok" class="form-control">
			        		</div>
			        	</div>
			      </div>
			      <div class="modal-footer">
			      	<button type="button" class="btn btn-info btn-submit">Submit</button>
			        <button type="button" class="btn btn-default cancel" data-dismiss="modal" >Close</button>
			        
			      </div>
			    </div>
 		</div>
 	</div>
 	
</body>
</html>
