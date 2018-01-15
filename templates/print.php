<?php 
	include("../function/koneksi.php");
	$kodepenjualan=$_REQUEST['kodepenjualan'];
	$query="select * from tbl_penjualan where kode_penjualan='$kodepenjualan'";
	$result1=mysqli_query($koneksi,$query);
	$query="select * from tbl_penjualandetail where kode_penjualan='$kodepenjualan'";
	$result2=mysqli_query($koneksi,$query);
	
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title></title>
 	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
 	<style type="text/css">

 		@media print {
		   @page {
		    size: 100mm 210mm;
		     /* for compatibility with both A4 and Letter */
		  }
		  
		  .print{position: absolute;
		    left: 0;
		    top: 0;
			}
		}

		.table-print td{
			width: 150px;
		}
 	</style>
 </head>
 <body>
 	<div class="container-fluid print">
 		<div class="row">
 			<div class="col-sm-3" align="center">
 			<?php $data=mysqli_fetch_assoc($result1); ?>
 				<b><span>BRAND</span></b><br>
 				<span>Telp: 083812345345</span><br>
 				<span>Tanggal:</span><span class="tgl"></span>
 					<?php echo "$data[tanggal]"; ?><br>
 				<span>Kode:</span><span class="Kode">
 					<?php echo "$data[kode_penjualan]"; ?>
 				</span><br>
 				<hr style="border: 1px black dashed">
 				<table class=" table-print"> 
 					<?php 
 						while($data=mysqli_fetch_assoc($result2)){
 							echo "<tr>";
 							echo "<td>$data[kode_produk]</td>
 								  <td>$data[nama_produk]</td>
 								  <td>$data[kuantitas]</td>
 								  <td>$data[harga_jual]</td>
 								  <td>$data[total]</td>";
 							echo "</tr>";
 						}
 					 ?>
 				</table>
 				<hr style="border: 1px black dashed">
 				<?php 
 					$query="select * from tbl_penjualan where kode_penjualan='$kodepenjualan'";
					$result1=mysqli_query($koneksi,$query);
 					$data=mysqli_fetch_assoc($result1); 
 				?>
 				<table class=" table-print">
 					<tr>
 						<td>TOTAL</td><td>:</td>
 						<td><?php echo "$data[total_harga]"; ?></td>
 					</tr>
 					<tr>
 						<td>TOTAL ITEM</td><td>:</td>
 						<td><?php echo "$data[total_item]"; ?></td>
 					</tr>
 					<tr>
 						<td>BAYAR</td><td>:</td>
 						<td><?php echo "$data[bayar]"; ?></td>
 					</tr>
 					<tr>
 						<td>KEMBALI</td><td>:</td>
 						<td><?php echo "$data[kembali]"; ?></td>
 					</tr>
 				</table>
 				<hr style="border: 1px black dashed">
 				<table class=" table-print">
 					<tr>
 						<td>KASIR</td><td>:</td>
 						<td><?php echo "$data[nama_kasir]"; ?></td>
 						
 						<td><?php echo "$data[tanggal]"; ?></td>
 					</tr>
 					
 				</table>
 			</div>
 		</div>
 	</div>
 </body>
 <script type="text/javascript">
 	window.print()
 </script>
 </html>