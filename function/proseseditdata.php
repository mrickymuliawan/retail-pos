<?php 
include('koneksi.php');
	if (isset($_REQUEST['kodeprodukedit'])) {
		
		$kode=filterdata($_REQUEST['kodeprodukedit']);
		$query="select*from tbl_produk where kode_produk='$kode' ";
		$result=mysqli_query($koneksi,$query);

		if($result){
			$data=mysqli_fetch_assoc($result);
			$arr=$data;
			echo json_encode($arr);
		}
		else {
			die("ada yg error".mysqli_error($koneksi));
		}
	}

	// FORM EDIT DATA
	elseif(isset($_REQUEST['editdata'])) {
		
		$kode=filterdata($_REQUEST['kodeproduk']);
		$nama=filterdata($_REQUEST['namaproduk']);
		$hargamodal=filterdata($_REQUEST['hargamodal']);
		$hargajual=filterdata($_REQUEST['hargajual']);
		$kategori=filterdata($_REQUEST['kategori']);
		$diskon=filterdata($_REQUEST['diskon']);
		$size=filterdata($_REQUEST['size']);
		$stok=filterdata($_REQUEST['stok']);
		$deskripsi=filterdata($_REQUEST['deskripsi']);
		$query="update tbl_produk set nama_produk='$nama',
				size_produk='$size', kategori='$kategori' , harga_modal='$hargamodal', harga_jual='$hargajual',  diskon=$diskon,
				stok_produk='$stok', deskripsi='$deskripsi' where kode_produk='$kode' ";
		$result=mysqli_query($koneksi,$query);
		if($result){
			echo "produk dengan kode <b>'$kode'</b> berhasil diedit";
		}
		else {
			die("ada yg error".mysqli_error($koneksi));
		}
	}

	elseif(isset($_REQUEST['kodeprodukhapus'])){
		
		$kode=filterdata($_REQUEST['kodeprodukhapus']);
		$query="delete from tbl_produk where kode_produk='$kode' ";
		$result=mysqli_query($koneksi,$query);
		if($result){
			echo "produk dengan kode <b>'$kode'</b> berhasil dihapus";
		}
		else {
			die("ada yg error".mysqli_error($koneksi));
		}
	}


 ?>