<?php 
include('koneksi.php');


	// Load = true
if (isset($_REQUEST['load']) ) {
	$caridata=$_REQUEST['caridata'];
	$kolom=$_REQUEST['kolom'];
	$kategori=$_REQUEST['kategori'];
	$page=$_REQUEST['page'];
	$maxdata=$_REQUEST['maxdata'];
	$where="where $kolom like '%$caridata%' and kategori like '%$kategori%' "; 
	
	//AMBIL DATA INFO (TOTAL DATA)
	$result=mysqli_query($koneksi,
		"select count(*) totaldata from tbl_produk $where ");
	$data=mysqli_fetch_assoc($result);
	$arr['totaldata']=$data['totaldata'];
	

	// JIKA DATA > 0
	if ($arr['totaldata'] > 0) {

		$result=ambildata($koneksi,"tbl_produk",$where,$page,$maxdata);
			 	
		while ($data=mysqli_fetch_assoc($result)) {
			$data['diskon']*=100;
				
			$arr['table'][]= "<tr>
				<td><input type='checkbox' value='$data[kode_produk]'/></td>
				<td>$data[kode_produk]</td>
				<td>$data[nama_produk]</td>
				<td>$data[size_produk]</td>
				<td>$data[harga_modal]</td>
				<td>$data[harga_jual]</td>
				<td>$data[kategori]</td>
				<td>$data[stok_produk]</td>
				<td>$data[diskon]</td>
				<td><button class='btn btn-info btn-sm btn-tambahstok' value='$data[kode_produk]'><i class='fa fa-plus'></i></button>
				<button class='btn btn-success btn-sm btn-edit' value='$data[kode_produk]'><i class='fa fa-edit'></i></button>
				<button class='btn btn-danger btn-sm btn-hapus' value='$data[kode_produk]'><i class='fa fa-trash-o'></i></button></td>
			</tr>";
					
		}
	}
	else{
		$arr['table'][]="";
	}

	$btn=buatbutton($koneksi,"tbl_produk",$where,$maxdata);
	if ($btn>=5) {
		for ($i=1; $i < $btn; $i++) { 
			if ($page>=4 ) {
				if ($i==1) {
					$arr['button'][]= "<button class='btn btn-sm btn-secondary btn-page' value='$i'> $i </button>&nbsp";
				}
				elseif ($i==$page-1 or $i==$page or $i==$page+1 ) {
					$arr['button'][]= "<button class='btn btn-sm btn-secondary btn-page' value='$i'> $i </button>";
				}	
			}
			elseif($i<=4 ) {
				$arr['button'][]= "<button class='btn btn-sm btn-secondary btn-page' value='$i'> $i </button>";
			}
		}	
		$arr['button'][]= "&nbsp<button class='btn btn-sm btn-secondary btn-page' value='$btn'> $btn </button>";
	}
	else{
		for ($i=1; $i <= $btn; $i++) { 
			$arr['button'][]= "<button class='btn btn-sm btn-secondary btn-page' value='$i'> $i </button>";
		}
	}
	
	echo json_encode($arr);
}
elseif (isset($_REQUEST['ambileditdata'])) {
		
		$kode=filterdata($_REQUEST['kodeproduk']);
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

	elseif(isset($_REQUEST['hapusdata'])){
		
		$kode=filterdata($_REQUEST['kodeproduk']);
		$query="delete from tbl_produk where kode_produk='$kode' ";
		$result=mysqli_query($koneksi,$query);
		if($result){
			echo "produk dengan kode <b>'$kode'</b> berhasil dihapus";
		}
		else {
			die("ada yg error".mysqli_error($koneksi));
		}
	}
	elseif(isset($_REQUEST['tambahstok'])){
		
		$kode=filterdata($_REQUEST['kodeproduk']);
		$qty=filterdata($_REQUEST['qty']);
		$query="update tbl_produk set stok_produk=(stok_produk+$qty) where kode_produk='$kode'";
		$result=mysqli_query($koneksi,$query);
		if($result){
			echo "Stok dengan kode <b>'$kode'</b> berhasil ditambah";
		}
		else {
			die("ada yg error".mysqli_error($koneksi));
		}
	}
	elseif(isset($_REQUEST['setdiskon'])){
		
		$kategori=filterdata($_REQUEST['kategori']);
		$diskon=filterdata($_REQUEST['diskon']);
		$query="update tbl_produk set diskon=$diskon where kategori='$kategori'";
		$result=mysqli_query($koneksi,$query);
		if($result){
			echo "Stok dengan kode <b>'$kode'</b> berhasil ditambah";
		}
		else {
			die("ada yg error".mysqli_error($koneksi));
		}
	}
 ?>