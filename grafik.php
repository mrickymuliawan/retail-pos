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
	<script type="text/javascript" src='js/highcharts.js'></script>

	<script type="text/javascript">
		function chart (data,cat) {
		   $('.grafik').highcharts({
		    chart: {
		        type: 'area'
		    },
		    title: {
		        text: 'Profit'
		    },
		    xAxis: {
		        categories:cat
		    },
		    yAxis: {
		        title: {
		            text: 'Jumlah Profit'
		        }
		    },
		    series: data,
		  });
		}
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
			
			$.ajax({
			    url: 'function/prosesgrafik.php',
			    data:'',
			    dataType: "json",
			    success: function (data) {
					chart(data.series,data.categories);
				    }
			 	});

			$('select[name=interval').change(function(){
				
			})
			$(".btn-cari").click(function(){
				$.ajax({
			    url: 'function/prosesgrafik.php',
			    data:{
			    	tahun:$('select[name=tahun]').val(),
			    	bulan:$('select[name=bulan]').val(),
			    	interval:$('select[name=interval]').val()},
			    dataType: "json",
			    success: function (data) {
					chart(data.series,data.categories);
				    }
			 	});
			})
			
		 });
		

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

			 		<label class="col-form-label col-sm-1" for='interval'>Interval</label>
				 	<div class="col-sm-2">
				 		<select name='interval' class="form-control">	
								<option value='1' selected="true">Per hari</option>
								<option value='2'>Per Bulan</option>
								<option value='3'>Per Tahun</option>
								
						</select>
				 	</div>
					
					<div>
						<label class="col-form-label col-sm-1" for='bulan'>Bulan</label>
						<div class="col-sm-2">
							<select name='bulan' class="form-control">	
								<option value='1' selected="true">January</option>
								<option value='2'>February</option>
								<option value='3'>March</option>
								<option value='4'>April</option>
								<option value='5'>May</option>
								<option value='6'>June</option>
								<option value='7'>Jule</option>
								<option value='8'>August</option>
								<option value='9'>September</option>
								<option value='10'>October</option>
								<option value='11'>November</option>
								<option value='12'>Desember</option>	
							</select>
						</div>
						<div class="col-sm-2">
							<select name='tahun' class="form-control">	
								<option value='2016' selected="true">2016</option>
								<option value='2017'>2017</option>
								<option value='2018'>2018</option>
								<option value='2019'>2019</option>
									
							</select>
						</div>
						<div class="col-sm-1">
							<button class="btn btn-secondary btn-cari">Go</button>
						</div>
					</div>
			 		
				</div>

		 		<div class="row">
			 		
		 			
			
		 		</div>	
	 		</div>

	 		<div class="table-row">
		 		<div class="row">
		 			<div class="col-sm-2 row-total-data">
		 				<h5>Grafik <span class="tag tag-info"> <i class="fa fa-bar-chart"></i>  </span></h5>
					</div>
		 			<div class="offset-sm-8 col-sm-2 row-button">
		 				
					</div>
		 		</div>
		 		<div class="grafik" style="width:100%; height:400px;"></div>
				
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

