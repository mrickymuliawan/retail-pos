<?php 	
include('koneksi.php');
if (isset($_REQUEST['cekkode'])) {
	$kode=$_REQUEST['kodepenjualan'];
	$result=mysqli_query($koneksi, 
		"select * from tbl_penjualan where kode_penjualan='$kode' ");
	$data=mysqli_fetch_assoc($result);
	if(mysqli_num_rows($result) > 0){
		echo "true";
	}
	else{
		echo "false";
	}
		
		
}
elseif (isset($_REQUEST['cariproduk'])) {
	
	$cari=$_REQUEST['cariproduk'];
	$result=mysqli_query($koneksi,"select * from tbl_produk where kode_produk like '%$cari%' 
		and stok_produk > 0");
		while ($data=mysqli_fetch_assoc($result)) {
			$array[]=array("value"=>"$data[kode_produk]",
						   "label"=>"$data[kode_produk] - $data[nama_produk] Rp. $data[harga_jual]");;
		}
	echo json_encode($array);
	}

elseif (isset($_REQUEST['pilih'])) {
	
	$pilih=$_REQUEST['pilih'];
	$result=mysqli_query($koneksi,"select * from tbl_produk where kode_produk like '%$pilih%' ");
	
	if($data=mysqli_fetch_assoc($result)) {
		$total=$data['harga_jual']-($data['harga_jual']*$data['diskon']);
		echo "<tr>
				
				<td class='td-kode_produk'>
					$data[kode_produk] <input type='hidden' name='kodeproduk' value='$data[kode_produk]'>
				</td>
				<td>
					$data[nama_produk] <input type='hidden' name='namaproduk' value='$data[nama_produk]'>
				</td>
				<td class='td-harga_jual'>	
					$data[harga_jual] <input type='hidden' name='hargajual' value='$data[harga_jual]'>
				</td>
				<td class='td-qty'>			
					<input type=number name='qty' value=1 class='form-control' max=$data[stok_produk] min='1'> 
				</td>
				<td class='td-stok_produk'>	
					$data[stok_produk] <input type='hidden' name='stokproduk' value='$data[stok_produk]'>
				</td>
				<td class='td-diskon'>		
					$data[diskon] <input type='hidden' name='diskon' value='$data[diskon]'>
				</td>
				<td class='td-total'>		
					<input type='number' name='total' value='$total' class='form-control' readonly>
				</td>
				<td>						
					<button type='button' class='btn btn-danger btn-hapus'> <span class='fa fa-remove'/> </span> </button>
				</td>
				
			</tr>";
	}
}
elseif (isset($_REQUEST['tambahpelanggan'])) {
		

		
		$nama=filterdata($_REQUEST['namapelanggan']);
		$alamat=filterdata($_REQUEST['alamat']);
		$notelp=filterdata($_REQUEST['notelp']);
		$akun=filterdata($_REQUEST['akun']);

		$query="insert into tbl_pelanggan (nama_pelanggan,alamat,no_telp,akun)
		values ('$nama','$alamat','$notelp','$akun')";
		$result=mysqli_query($koneksi,$query);
		if($result){
			echo "pelanggan dengan nama <b>'$nama'</b> berhasil ditambahkan";
		}
		else {
			die("ada yg error nih ".mysqli_error($koneksi));
		}
	}
elseif (isset($_REQUEST['caripelanggan'])) {
	
	$cari=$_REQUEST['caripelanggan'];
	$result=mysqli_query($koneksi,"select * from tbl_pelanggan where nama_pelanggan like '%$cari%' ");
	$array=array();
	while ($data=mysqli_fetch_assoc($result)) {
		$array[]=$data['nama_pelanggan'];
	}
	echo json_encode($array);
	}

elseif (isset($_REQUEST['pilihpelanggan'])) {
	
	$pilih=$_REQUEST['pilihpelanggan'];
	$result=mysqli_query($koneksi,"select * from tbl_pelanggan where nama_pelanggan like '%$pilih%' ");
	while ($data=mysqli_fetch_assoc($result)) {
		$array=$data;
	}
	echo json_encode($array);
	
}
elseif (isset($_REQUEST['pilihpelangganterakhir'])) {
	
	
	$result=mysqli_query($koneksi,"select * from tbl_pelanggan order by kode_pelanggan desc limit 1 ");
	while ($data=mysqli_fetch_assoc($result)) {
		$array=$data;
	}
	echo json_encode($array);
	
}

elseif (isset($_REQUEST['tambahpenjualan'])) {
	
	$kodepenj=$_REQUEST['kodepenjualan'];
	$namapel=filterdata($_REQUEST['namapelanggan']);
	$namakas="kasir";
	$totitem=filterdata($_REQUEST['totalitem']);
	$biayakirim=filterdata($_REQUEST['biayakirim']);
	$bayar=filterdata($_REQUEST['bayar']);
	$kembali=filterdata($_REQUEST['kembali']);
	$pajak=0;
	$totharga=filterdata($_REQUEST['totalharga']);
	$profit=0;
	$order=filterdata($_REQUEST['order']);
	if ($order == 0) {
		$status="complete";
		
	}
	else{
		$status="on hold";
		
	}
	
	
	$query="insert into tbl_penjualan values ('$kodepenj',NOW(),'$namapel','$namakas','$totitem','$biayakirim','$bayar','$kembali','$pajak','$totharga','$profit','$status','$order')";
	$result=mysqli_query($koneksi,$query);
	
}
elseif (isset($_REQUEST['tambahpenjualandetail'])) {
	
	$kodepenj=$_REQUEST['kodepenjualan'];
	$kodeproduk=filterdata($_REQUEST['kodeproduk']);
	$namaproduk=filterdata($_REQUEST['namaproduk']);
	$qty=filterdata($_REQUEST['qty']);
	$hargamodal="(select harga_modal from tbl_produk where kode_produk='$kodeproduk')";
	$hargajual="(select harga_jual from tbl_produk where kode_produk='$kodeproduk')";
	$total=filterdata($_REQUEST['total']);
	$profit="$total-$hargamodal*$qty";
	
	// insert to penjualan detail
	$query="insert into tbl_penjualandetail 
			values ('$kodepenj','$kodeproduk','$namaproduk','$qty',$hargamodal,$hargajual,'$total',$profit)";
	$result=mysqli_query($koneksi,$query);


	// kurangi stok tiap itemnya
	$result=mysqli_query($koneksi,"update tbl_produk set stok_produk=(stok_produk-$qty) 
						where kode_produk ='$kodeproduk' ");

	// update total profit dan total qty di penjualan
	$query="update tbl_penjualan a 
			inner join (select kode_penjualan, 
						SUM(profit) totalprofit, SUM(kuantitas) totalqty 
						from tbl_penjualandetail where kode_penjualan = '$kodepenj') b
	 		on a.kode_penjualan = b.kode_penjualan
			set a.profit = totalprofit, a.total_item = totalqty
			where a.kode_penjualan = '$kodepenj'";
	$result=mysqli_query($koneksi,$query);

	if($result){
		echo "penjualan berhasil ditambahkan dan selesai";
	}
	else {
		die("ada yg error".mysqli_error($koneksi));
	}
}

 ?>