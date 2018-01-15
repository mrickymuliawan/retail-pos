<!DOCTYPE html>
<html>
<head>
	<title>Transaksi</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/jquery-ui.min.css">
	<link rel="stylesheet" href="fonts/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="style.css?version=1">


	<script src="js/jquery.min.js"></script>
	<script src="js/jquery-ui.min.js"></script>
	<script src="js/jquery-validate.min.js"></script>
	<script src="js/bootstrap.min.js"></script>

	
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

				<div class="row">

					<div class="col-sm-9">
						<div class="tool-row">
							<div class="form-group row">
							
								<label class="col-form-label col-sm-3" for='kodepenjualan'>Kode Penjualan</label>
								<div class="col-sm-3">
									<input type="text" name="kodepenjualan" class="form-control kode-penjualan" readonly="">
								</div>
							

							
								<label class="col-form-label col-sm-2" for='tanggal'>Tanggal</label>
								<div class="col-sm-3">
									<input type="text" name="tanggal" class="form-control tgl" disabled="">
								</div>

								
								
							   
							</div>
							<div class="form-group row">
								<div class="col-sm-12">
									<div class="input-group">
										<div class="input-group-addon">
											<span class="fa fa-search "></span>
										</div>
										<input type="text" name="caridata" placeholder="Cari produk atau scan barcode.." class="form-control cariproduk" >
									</div>
								</div>
							</div>
						</div> 

						
						<div class="cart-row">	
							<div class="row">
								<table class="table table-striped table-keranjang">
									<thead>
										<tr>
											<th>Kode produk</th>
											<th>Nama produk</th>
											<th>Harga</th>
											<th>Qty</th>
											<th>Stok</th>
											<th>Diskon %</th>
											<th>Total</th>
											<th>Tools</th>
											</tr>
									</thead>
									<tbody></tbody>	
								</table>
							</div>	
						</div>
						

					</div> 

				

					<div class="col-sm-3">	
						<div class="transaksi-pelanggan-row">
							<div class="form-group row">

								<div class="col-sm-12">

									<div class="input-group">
										<span class="input-group-addon">
											<span class="fa fa-user "></span>
										</span>
										<input type="text" name="pelanggan" placeholder="Nama pelanggan.." class="form-control caripelanggan" >
										<span class="input-group-btn">
											<button class="btn btn-secondary btn-tambahpel"><span class="fa fa-plus"></span></button>
										</span>
									</div>

								</div>
							</div>
							
							<form class="form-pelanggan">
								<input type="hidden" name="namapelanggan">
								<div class="form-group row">
						 			<label for="stok" class="col-form-label col-sm-12">Alamat</label>
						 			<div class="col-sm-12">
						 				<textarea name="alamat" class="form-control" readonly="true"></textarea> 	
						 			</div>
						 		</div>
						 		<div class="form-group row">
						 			<label for="notelp" class="col-form-label col-sm-12">No. Telephone</label>
						 			<div class="col-sm-12">
						 				<input type="text" name="notelp" class="form-control" readonly="true">	
						 			</div>
						 		</div>
						 		<div class="form-group row">
						 			<label for="akun" class="col-form-label col-sm-12">Akun</label>
						 			<div class="col-sm-12">
						 				<input type="text" name="akun" class="form-control" readonly="true">	
						 			</div>
						 		</div>
								<div class="form-check">
						 			<label for="pengiriman" class="form-check-label">
						 			<input type="checkbox" name="order" class="form-check-input order-cbox" value="1">
						 			Order
						 			</label>
						 		</div>	
						 		<div class="form-check">
						 			<label for="pengiriman" class="form-check-label">
						 			<input type="checkbox" name="pengiriman" class="form-check-input bykirim-cbox">
						 					Biaya Pengiriman	
						 			</label>
						 		</div>	
						 		<div class="form-group row">
						 			<div class="col-sm-7">
						 				<input type="number" name="biayakirim" class="form-control bykirim-input" value=0 readonly="true" min='0'>	
						 			</div>
						 		</div>
						 	</form>				 			
							
							<button  type="button" class="btn btn-coba">cobbar</button>	
						</div>	
					</div>

					
				</div>
<!--...................................................................................................... -->
				<div class="row">
					<form class="form-total">
						<div class=" col-sm-12">
							<div class="tool-row">
							<div class="form-group row">
						 		<label for="total" class="col-form-label col-sm-1">Total</label>
						 		<div class="col-sm-3">
						 			<input type="text" name="totalharga" class="form-control form-control-lg total" value=0 readonly>	
						 		</div>
						 			
						 	</div>
						 		
						
						
							<div class="form-group row">
						 		<label for="bayar" class="col-form-label col-sm-1 ">Bayar</label>
						 		<div class="col-sm-3">
						 			<input type="text" name="bayar" class="form-control form-control-lg bayar" >	
						 		</div>
						 		<label for="kembali" class="col-form-label col-sm-1 ">Kembali</label>
						 		<div class="col-sm-3">
						 			<input type="text" name="kembali" class="form-control form-control-lg kembali" >	
						 		</div>
						 		<div class="offset-sm-1 col-sm-3">
						 			 <button type='button' class="btn btn-danger btn-lg btn-clear">Clear</button>
									 <button type='button' class="btn btn-secondary btn-lg btn-bayar" disabled>Bayar</button>
								</div>
						 	</div>
						 	</div>
						</div>
					</form>
				</div>
<!--...................................................................................................... -->
			</div>
		</div>
	</div>
</body>
</html>

<div class="modal modalformtambah" role="dialog">
		<div class="modal-dialog ">
			<div class="modal-content">
			    <div class="modal-header">
			    	<button type="button" class="close" data-dismiss="modal">&times;</button>
			        <h4 class="modal-title">Tambah Data Pelanggan</h4>
			    </div>
				<div class="modal-body">
					<form class="tambahpelanggan">

			 			<div class="form-group row">
			 				<label for="namapelanggan" class="col-form-label col-sm-3">Nama Pelanggan</label>
			 				<div class="col-sm-6">
			 					<input type="text" name="namapelanggan" class="form-control" placeholder="Baju polos" >	
			 				</div>
			 			</div>

			 			
			 			<div class="form-group row">
			 				<label for="alamat" class="col-form-label col-sm-3">alamat</label>
			 				<div class="col-sm-6">
			 					<textarea name="alamat" class="form-control" rows="5" value='haha'></textarea>
			 				</div>
			 			</div>

			 			<div class="form-group row">
			 				<label for="notelp" class="col-form-label col-sm-3">NO HP</label>
			 				<div class="col-sm-6">
			 					<input type="text" name="notelp" class="form-control" placeholder="nomor handphone" >	
			 				</div>
			 			</div>

			 			<div class="form-group row">
			 				<label for="akun" class="col-form-label col-sm-3">Akun</label>
			 				<div class="col-sm-6">
			 					<input type="text" name="akun" class="form-control" placeholder="akun" >	
			 				</div>
			 			</div>
			 			
			 		

			 			<div class="form-group row">
			 				<div class="col-sm-5 offset-sm-4">
			 					<input type='submit' class="btn btn-info edit" >
			 				</div>
			 			</div>
			 			
			 		</form>     
				</div>
				
			</div>
 		</div>
 	</div>


 		<div class="modal modal-info" role="dialog">
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
 		<div class="modal modal-print" role="dialog">
	 		<div class="modal-dialog ">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal">&times;</button>
			        <h4 class="modal-title">Informasi</h4>
			      </div>
			      <div class="modal-body info-body">
			        	Penjualan berhasil
			      </div>
			      <div class="modal-footer">
			      <button type="button" class="btn btn-default btn-print">Print</button>
			        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
			      </div>
			    </div>
 			</div>
 		</div>

<script type="text/javascript">
		
		function changeqty(a){
			// a = td-qty input
			var qty=parseInt($(a).val());
			var stok=parseInt($(a).parent().siblings('.td-stok_produk').html());

			if(qty > stok){
				alert("Stok kurang")
				$(a).css('border','solid 1px red')
				$('.bayar,.kembali').prop('disabled',true)
			}
				
			else{
				var harga=parseInt($(a).parent().siblings('.td-harga_jual').html());
				var diskon=parseFloat($(a).parent().siblings('.td-diskon').html());
				var total=(harga-(harga*diskon))*qty;
				$(a).parent().siblings('.td-total').find('input').val(total);	
				$(a).css('border','')
				$('.bayar,.kembali').prop('disabled',false)
				}
				
		}
		function hapussemua(){
			$('.total').val(0)
			$('.bayar').val("")
			$('.kembali').val("")
			$('.btn-bayar').attr('disabled','true')
			$('.bykirim-input').attr('readonly','true').val(0)
	    	$('.bykirim-cbox').prop('checked',false)
		}
		function generate(){
			var text = "";
			var possible = "0123456789";
			for( var i=0; i < 7; i++ )
			    text += possible.charAt(Math.floor(Math.random() * possible.length));
				return text;
			}
//==========================================================================================================//

		$(document).ready(function(){
			var gen=generate()
			var kodepenjualan=$('input[name=kodepenjualan').val(gen)
			$.ajax({
				url:'function/prosestransaksi.php',
				data:{kodepenjualan:$('input[name=kodepenjualan').val(),cekkode:true},
				success: function(data){
					if (data=='true') {
						location.reload();
					}
				}
			})
			
			
			$('.tgl').datepicker().datepicker("setDate",new Date()).datepicker('option','dateFormat','yy-mm-dd');

			// CARI PRODUK
			$( ".cariproduk" ).autocomplete({
				minLength:1,
				autoFocus:true,
		      	source: function( request, response ) {
			        $.ajax( {
			          url: "function/prosestransaksi.php",
			          dataType: "json",
			          data: {cariproduk: $('.cariproduk').val() },
			          success: function(data) {
			            response(data);
			          }
			        })
			      },
			    select: function(event,data){


			    	// KOSONGNKAN INPUT CARIPRODUK
			    	var sudahada=false
			    	$('.cariproduk').val("");

			    	//CEK APAKAH DATA SUDAH ADA DIKERANJANG
			    	$('.td-kode_produk').each(function(){
			    		// JIKA SUDAH ADA DIKERANJANG 
			    		if($(this).find('input').val()==data.item.value){
			    			
			    			var qtyinput=$(this).siblings('.td-qty').find('input')
			    			var qty=parseInt(qtyinput.val())
			    			$(this).siblings('.td-qty').find('input').val(qty+1)


			    			// FUNSI CHANGEQTY
			    			changeqty(qtyinput)

			    			sudahada=true

			    		}
			    		
			    	})
			    	// JIKA SUDAH ADA DIKERANJANG HITUNG ULANG TOTAL 
			    	if(sudahada){
			    		var tot=0;
						$('.td-total input').each(function(){
							var value=parseInt($(this).val());
							tot += value;
							$('.total').val(tot)
						})
							var bykirim= parseInt($('.bykirim-input').val());	
							tot += bykirim;
							$('.total').val(tot)
				
			    	}
			    	// JIKA BELUM ADA DIKERANJANG, TAMBAHKAN DIKERANJANG LALU HITUNG TOTAL
			    	else{
			    		$.ajax({
						url:'function/prosestransaksi.php',
						dataType:'html',
						data:{pilih:data.item.value},
						success:function(data){
							$('.table-keranjang tbody').append(data);
							
							// VALUE TOTAL	
							var tot=parseInt($('.total').val())
							var value=parseInt($('.td-total input').last().val())
							tot += value
							$('.total').val(tot)
						
						}

					})
			    	}
			    	return false
			    }
			  	
		    });

			//TOMBOL CLEAR  HAPUS SEMUA
			$('.btn-clear').click(function(){
				
				$('.table-keranjang tbody').children().remove();
				hapussemua()
			})
			//TOMBOL HAPUS, HAPUS SATU YANG DIPILIH DAN TOTAL DIKURANGI
			$('.table-keranjang').on('click','.btn-hapus',function(){
				$(this).parents("tr").remove();

				//isi total 
				var tot=parseInt($('.total').val())
				var value=parseInt($(this).parent().siblings('.td-total').find('input').val())
				tot -= value
				$('.total').val(tot)

				if($('.table-keranjang tbody').children().length == 0){
					hapussemua()
				}
				
			})

			// MENGGANTI QTY
			$('.table-keranjang').on('change','.td-qty input',function(){
				changeqty(this)
					var tot=0;
				$('.td-total input').each(function(){
					var value=parseInt($(this).val());
					tot += value;
					$('.total').val(tot)
				})
					var bykirim= parseInt($('.bykirim-input').val());	
					tot += bykirim;
					$('.total').val(tot)
				
			})
			// AUTO FOCUS SAAT KLIK QTY
			.on('focus','.td-qty input',function(){
				$(this).select();
			})

			// BAYAR 
			$('.bayar').on('keyup',function(){
				var total=$('.total').val();
				var bayar=$(this).val();
				$('.kembali').val(bayar-total)
				if ($('.kembali').val()>= 0) {
					$('.btn-bayar').removeAttr('disabled')
				}
				else{
					$('.btn-bayar').attr('disabled','true')
				}
			})

			

			// PELANGGAN //
			$('.btn-tambahpel').click(function(){
				$('.modalformtambah').modal('show')
			 	$('.tambahpelanggan').trigger('reset');
			})
			$('.tambahpelanggan').validate({
				submitHandler:function(form){
					 $.ajax({
			            url:'function/prosestransaksi.php',
			            type:'post',
			            data:$('.tambahpelanggan').serialize()+"&tambahpelanggan=true",
			            success: function(data){
			               $('.modal-info .info-body').html(data);
			               $('.modalformtambah').modal('hide');
			               $('.modal-info').modal('show');
			               $('.tambahpelanggan').trigger('reset');

			               $.ajax({
								url:'function/prosestransaksi.php',
								dataType:'json',
								data:{pilihpelangganterakhir:true},
								success:function(data){
									$('.caripelanggan').val(data.nama_pelanggan)
									$('input[name=namapelanggan]').val(data.nama_pelanggan);
									$('textarea[name=alamat]').val(data.alamat);
									$('input[name=notelp]').val(data.no_telp);
									$('input[name=akun]').val(data.akun);
									}
								})

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
			// CARI PELANGGAN
		    $( ".caripelanggan" ).autocomplete({
		      	source: function( request, response ) {
			        $.ajax( {
			          url: "function/prosestransaksi.php",
			          dataType: "json",
			          data: {caripelanggan: request.term },
			          success: function( data ) {
			            response( data );
			          }
			        });
			      },
			  		minLength:2,
			  		select:function(event,data){
			  			$.ajax({
						url:'function/prosestransaksi.php',
						dataType:'json',
						data:{pilihpelanggan:data.item.value},
						success:function(data){
							$('input[name=namapelanggan]').val(data.nama_pelanggan);
							$('textarea[name=alamat]').val(data.alamat);
							$('input[name=notelp]').val(data.no_telp);
							$('input[name=akun]').val(data.akun);
						}
					})
			  		}
		    });

		    // BIAYA KIRIM CHECKBOX 
		    $('.bykirim-cbox').click(function(){
		    	if ($(this).prop('checked')) {
		    		$('.bykirim-input').removeAttr('readonly')
		    		var tot=parseInt($('.total').val())
					var bykirim= parseInt($('.bykirim-input').val())
					tot += bykirim
					$('.total').val(tot)
		    	}
		    	else{
		    		$('.bykirim-input').attr('readonly','true')
		    		var tot=parseInt($('.total').val())
					var bykirim= parseInt($('.bykirim-input').val())
					tot -= bykirim
					$('.total').val(tot)
		    	}
		    })
		    // BIAYA KIRIM INPUT 
		    $('.bykirim-input').change(function(){
		    
				var tot=parseInt($('.total').val())
				var bykirim= parseInt($('.bykirim-input').val())
				tot += bykirim
				$('.total').val(tot)

		    })


		    // BTN BAYAR 
		    $('.btn-bayar').click(function(){
		    	var x=0
		    	
				$.ajax({
			      url:'function/prosestransaksi.php',
			      type:'post',
			      // ISI TBL PENJUALAN
			      data:$('.form-total,.form-pelanggan,input[name=kodepenjualan]').serialize()
			      	   +"&tambahpenjualan=true"
			      
			   });

				$('.table-keranjang tbody tr').each(function(){
					var value=
						$('input[name=kodepenjualan]').serialize()+"&"+
						$(this).find('input').serialize()+
						"&tambahpenjualandetail=true"
					    

					$.ajax({
						url:'function/prosestransaksi.php',
						type:'post',
						// ISI TBL PENJUALAN DETAIL AMBIL DATA DARI SETIAP INPUT
						data:value
					});
				})
				
				
				$('.modal-print').modal('show');
				$('.modal-print').on('click','.btn-print',function(){
					location.reload();
					var kode=$('input[name=kodepenjualan]').val();
					window.open("templates/print.php?kodepenjualan="+kode,"","width=200,height=500");
				});
				$('.modal-print').on('hidden.bs.modal',function(){
					location.reload();
					
				});
				
			})

			$('.btn-coba').click(function(){
				var kode=$('input[name=kodepenjualan]').val();
				window.open("templates/print.php?kodepenjualan="+kode,"","width=200,height=500");

			})
		})
	</script>