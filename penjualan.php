<!DOCTYPE html>
<?php 
	include("function/koneksi.php");
 ?>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/jquery-ui.min.css">
	<link rel="stylesheet" href="fonts/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="style.css?version=1.0">

	<script src="js/jquery.min.js"></script>
	<script src="js/jquery-ui.min.js"></script>
	<script src="js/jquery-validate.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	
	<script type="text/javascript">
		$(document).ready(function(){
			// BUAT TANGGAL TAHUN LALU DAN SET TANGGAL
			var tglsatu=new Date(); tglsatu.setDate(tglsatu.getDate()-365);
			var tgldua=new Date(); tgldua.setDate(tgldua.getDate());

			$('.tgl-1').datepicker({
				showOtherMonths:true,
				selectOtherMonths:true
			}).datepicker('option','dateFormat','yy-mm-dd')
			.datepicker('setDate',tglsatu).datepicker();
			$('.tgl-2').datepicker().datepicker('option','dateFormat','yy-mm-dd')
			.datepicker('setDate',tgldua);

			$('.sidebar-wrapper').hover(function(){
				$('.wrapper').toggleClass('toggled');
			})
			
			function load(p){
				$.ajax({
				url:'function/prosespenjualan.php',
				data:{caridata:$('input[name=caridata]').val(),
					  tipe:$('select[name=caritipe').val(),
					  tgl1:$('.tgl-1').val(),
					  tgl2:$('.tgl-2').val(),
					  maxdata:$('.maxdata').val(),
					  page:p,
					  load:true},
				dataType:'json',
				success:function(data){
						$('.table-data tbody').html(data.table);
						$('.row-button').html(data.button);
						$('.row-total-data span').html(data.totaldata)
						// INFO BOX
						$('.info-1').html(data.penjualan);
						$('.info-2').html(data.item);
						$('.info-3').html(data.total);
						$('.info-4').html(data.profit);
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
			

			//EDIT DATA
			$('.table-data').on('click','.btn-view',function(){
				
				$.ajax({
					url:'function/prosespenjualan.php',
					data: {kodepenjualan:$(this).val(),ambildatapenj:true},
					dataType:'json',
					success:function(data){
						//tab pertama
						$('.modal-view input[name=status]').val(data.status);
						var status=$('.modal-view input[name=status]')
						if (status.val() == 'on hold') {
							status.css('color','red')
							$('.rowonhold').show()
							$('.rowcomplete').hide()
						}
						else{
							status.css('color','teal')
							$('.rowcomplete').show()
							$('.rowonhold').hide()
						}
						// set button 
						$('.modal-view .btn-complete').val(data.kode_penjualan);
						$('.modal-view .btn-refund').val(data.kode_penjualan);
						$('.modal-view input[name=kode]').val(data.kode_penjualan);
						$('.modal-view input[name=tanggal]').val(data.tanggal);
						$('.modal-view input[name=kasir]').val(data.nama_kasir);
						$('.modal-view input[name=pelanggan]').val(data.nama_pelanggan);
						// tab kedua
						$('.modal-view input[name=totalharga]').val(data.total_harga);
						$('.modal-view input[name=bayar]').val(data.bayar);
						$('.modal-view input[name=kembali]').val(data.kembali);
						$('.modal-view input[name=pajak]').val(data.pajak);
						$('.modal-view input[name=biayakirim]').val(data.biaya_kirim);
						$('.modal-view input[name=totalitem]').val(data.total_item);
						$('.modal-view table tbody').html(data.penjdetail);
						$('.modal-view').modal('show');
						
					}
				})
			})
			$('.modal-view').on('click','.btn-complete',function(){
				var value=$(this).val()
				$('.modal-view').modal('toggle');
				$('.modal-confirm').modal('toggle');
				$('.btn-submit').click(function(){
					$.ajax({
						url:'function/prosespenjualan.php',
						data:{kodepenjualan:value,complete:true},
						success:function(data){
							 location.reload()
						}
					})
				})
				
			})
			.on('click','.btn-refund',function(){
				var value=$(this).val()
				$('.modal-view').modal('toggle');
				$('.modal-confirm').modal('toggle');
				$('.btn-submit').click(function(){
					$.ajax({
						url:'function/prosespenjualan.php',
						data:{kodepenjualan:value,refund:true},
						success:function(data){
							 location.reload()
						}
					})
				})
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
		 			<div class="col-sm-3">
		 				<div class="card card-outline-info">
		 					
		 					<div class="card-block bg-info info-row">
		 						<div class="row ">
		 							<div class="col-sm-5">
		 								<i class="fa fa-shopping-cart fa-4x"></i>
		 							</div>
		 							<div class="col-sm-7 ">
		 								<h5 class="info-1"></h5>
		 								<b><p>Penjualan</p></b>
		 							</div>
		 						</div>
		 					</div>
		 				
		 				</div>
		 			</div>
		 			<div class="col-sm-3">
		 				<div class="card card-outline-info">
		 					
		 					<div class="card-block bg-info info-row">
		 						<div class="row ">
		 							<div class="col-sm-5">
		 								<i class="fa fa-tags fa-4x"></i>
		 							</div>
		 							<div class="col-sm-7">
		 								<h5 class="info-2"></h5>
		 								<b><p>Item Terjual</p></b>
		 								
		 							</div>
		 						</div>
		 					</div>
		 					
		 				</div>
		 			</div>
		 			<div class="col-sm-3">
		 				<div class="card card-outline-info">
		 					
		 					<div class="card-block bg-info info-row">
		 						<div class="row ">
		 							<div class="col-sm-5">
		 								<i class="fa fa-usd fa-4x"></i>
		 							</div>
		 							<div class="col-sm-7">
		 								<h5 class="info-3"></h5>
		 								<b><p>Total</p></b>
		 								
		 							</div>
		 						</div>
		 					</div>
		 					
		 				</div>
		 			</div>
		 			
		 			<div class="col-sm-3">
		 				<div class="card card-outline-info">
		 					
		 					<div class="card-block bg-info info-row">
		 						<div class="row ">
		 							<div class="col-sm-5">
		 								<i class="fa fa-money fa-4x"></i>
		 							</div>
		 							<div class="col-sm-7 ">
		 								<h5 class="info-4"></h5>
		 								<b><p>Profit</p></b>
		 							</div>
		 						</div>
		 					</div>
		 					
		 				</div>
		 			</div>
		 		</div>



		 		<div class="row">
			 			
				 	<div class="col-sm-3">
				 		<div class="input-group">
							<div class="input-group-addon">
								<span class="fa fa-search "></span>
							</div>
							<input type="text" name="caridata" placeholder="Search.." class="form-control cari-data" >
							
						</div>
				 	</div>
				 	<div class="col-sm-3">
				 		<select name='caritipe' class="form-control">	
								<option value='' selected="true">All</option>
								<option value='0'>Offline</option>
								<option value='1'>Online</option>
								
						</select>
				 	</div>
				 	<div class="offset-sm-4 col-sm-2">
						<a href='transaksi.php' class="btn btn-info">Tambah Penjualan</a>
					</div>
			 		
				</div>

		 		<div class="row">
			 		<label class="col-form-label col-sm-1" for='tanggal'>Tanggal</label>
					<div class="col-sm-2">
						<input type="text" name="tanggal1" class="form-control tgl-1" >
					</div>
					<label class="col-form-label col-sm-1" for='tanggal'>To</label>
					<div class="col-sm-2">
						<input type="text" name="tanggal2" class="form-control tgl-2" >
					</div>
					<div class="col-sm-1">
						<button class="btn btn-secondary btn-cari">Go</button>
					</div>
		 			
					<div class="offset-sm-3 col-sm-2">
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
							<td>Kode Penjualan</td>
							<td>Tanggal</td>
		 					<td>Nama Pelanggan</td>
		 					<td>Nama Kasir </td>
		 					<td>Total Item</td>
		 					<td>Biaya Kirim</td>
		 					<td>Bayar</td>
		 					<td>Kembali</td>
		 					<td>Total</td>
		 					<td>Profit</td>
		 					<td>Status</td>
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


	<div class="modal modal-view" role="dialog">
		<div class="modal-dialog ">
			<div class="modal-content">
			    <div class="modal-header">
			    	<button type="button" class="close" data-dismiss="modal">&times;</button>
			        <h4 class="modal-title">Penjualan</h4>
			    </div>
				<div class="modal-body">
					<!-- Nav tabs -->
					<ul class="nav nav-tabs" role="tablist">
					  <li class="nav-item">
					    <a class="nav-link active" data-toggle="tab" href="#detail" role="tab">Detail</a>
					  </li>
					  <li class="nav-item">
					    <a class="nav-link" data-toggle="tab" href="#item" role="tab">Item</a>
					  </li>
					  
					</ul>

					<!-- Tab panes -->
					<div class="tab-content">
					  <div class="tab-pane active" id="detail" role="tabpanel">
					  	<div class="row">
						  	<div class="col-sm-6">
							  	<div class="form-group row">
							  		<label for="status" class="col-form-label col-sm-4 ">Status:</label>
							 		<div class="col-sm-8">
							 			<input readonly type="text" name="status" class="form-control" >
							 		</div>
							 	</div>
								<div class="form-group row">
								 	<label for="kode" class="col-form-label col-sm-4 ">Kode:</label>
								 	<div class="col-sm-8">
								 		<input readonly type="text" name="kode" class="form-control" >	
								 	</div>
								</div>
								<div class="form-group row">	
								 	<label for="tanggal" class="col-form-label col-sm-4 ">Tanggal:</label>
								 	<div class="col-sm-8">
								 		<input readonly type="text" name="tanggal" class="form-control" >	
								 	</div>
								</div>
						  	</div>
					 	
						  	<div class="col-sm-6">
							  	<div class="form-group row">	
							  		<label for="tanggal" class="col-form-label col-sm-4 ">Kasir:</label>
							 		<div class="col-sm-8">
							 			<input readonly type="text" name="kasir" class="form-control" >	
							 		</div>
							 	</div>
							 	<div class="form-group row">	
							  		<label for="pelanggan" class="col-form-label col-sm-4 ">Pelanggan:</label>
							 		<div class="col-sm-8">
							 			<input readonly type="text" name="pelanggan" class="form-control" >	
							 		</div>
							 	</div>	

						  	</div>
					 	
					 		
					 	</div>
					 	<div class="row rowonhold">
					 		<div class="offset-sm-6 col-sm-6">
					 		<button type="button" class="btn btn-info btn-complete" >Complete</button>
			       			<button type="button" class="btn btn-danger btn-refund" >Cancel</button>
			       			<button type="button" class="btn btn-secondary" data-dismiss='modal'>Close</button>
					 		</div>
					 	</div>
					 	<div class="row rowcomplete">
					 		<div class="offset-sm-8 col-sm-4">
					 		<button type="button" class="btn btn-danger btn-refund" >Refund</button>
			       			<button type="button" class="btn btn-secondary" data-dismiss='modal'>Close</button>
					 		</div>
					 	</div>
					  </div>
					  <div class="tab-pane" id="item" role="tabpanel">
					  	<div class="row">
						  	<div class="col-sm-6">
						 		<div class="form-group row">				 
								 	<label for="totalharga" class="col-form-label col-sm-5 ">Total Harga:</label>
								 	<div class="col-sm-7">
								 		<input readonly type="text" name="totalharga" class="form-control" >	
								 	</div>
							 	</div>
							 	<div class="form-group row">
								 	<label for="bayar" class="col-form-label col-sm-5 ">Bayar:</label>
								 	<div class="col-sm-7">
								 		<input readonly type="text" name="bayar" class="form-control" >	
								 	</div>
							 	</div>
							 	<div class="form-group row">
								 	<label for="kembali" class="col-form-label col-sm-5 ">Kembali:</label>
								 	<div class="col-sm-7">
								 		<input readonly type="text" name="kembali" class="form-control" >	
								 	</div>
							 	</div>
						  	</div>
						 	
						  	<div class="col-sm-6">
							  	<div class="form-group row">
							  		<label for="pajak" class="col-form-label col-sm-5 ">Pajak:</label>
							 		<div class="col-sm-7">
							 			<input readonly type="text" name="pajak" class="form-control" >	
							 		</div>
							 	</div>

							 	<div class="form-group row">	
							  		<label for="biayakirim" class="col-form-label col-sm-5 ">Biaya Kirim</label>
							 		<div class="col-sm-7">
							 			<input readonly type="text" name="biayakirim" class="form-control" >	
							 		</div>
							 	</div>

							 	<div class="form-group row">	
							 		<label for="totalitem" class="col-form-label col-sm-5 ">Jumlah Item</label>
							 		<div class="col-sm-7">
							 			<input readonly type="text" name="totalitem" class="form-control" >	
							 		</div>
							 	</div>

						  	</div>
		 		
					 	</div>

					 	<div class='row'>
					 		<div class="col-sm-12">
					 			<table class="table table-striped">
					 			<thead>
					 				<tr>
								 		<td>kode produk</td>
								 		<td>nama produk</td>
								 		<td>qty</td>
								 		<td>harga modal</td>
								 		<td>harga jual</td>
								 		<td>total</td>
								 		<td>profit</td>
							 		</tr>
							 	</thead>
							 	<tbody>
							 		
							 	</tbody>
					 			</table>
					 		</div>
					 	</div>
					 	<div class="row rowonhold">
					 		<div class="offset-sm-6 col-sm-6">
					 		<button type="button" class="btn btn-info btn-complete" >Complete</button>
			       			<button type="button" class="btn btn-danger btn-refund" >Cancel</button>
			       			<button type="button" class="btn btn-secondary" data-dismiss='modal'>Close</button>
					 		</div>
					 	</div>
					 	<div class="row rowcomplete">
					 		<div class="offset-sm-8 col-sm-4">
					 		<button type="button" class="btn btn-danger btn-refund" >Refund</button>
			       			<button type="button" class="btn btn-secondary" data-dismiss='modal'>Close</button>
					 		</div>
					 	</div>
					 	
					  </div>
					</div>
						
					   
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
			        <button type="button" class="btn btn-default tutup" data-dismiss="modal" >Tutup</button>
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

