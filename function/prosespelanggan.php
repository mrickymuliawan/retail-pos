<?php 
include('koneksi.php');
if (isset($_REQUEST['load'])) {
	$caridata=$_REQUEST['caridata'];
	//$kolom=$_REQUEST['kolom'];
	//$kategori=$_REQUEST['kategori'];
	$page=$_REQUEST['page'];
	$maxdata=$_REQUEST['maxdata'];
	$where="where nama_pelanggan like '%$caridata%' "; 
	
	//AMBIL DATA INFO (TOTAL DATA)
	$result=mysqli_query($koneksi,
		"select count(*) totaldata from tbl_pelanggan $where ");
	$data=mysqli_fetch_assoc($result);
	$arr['totaldata']=$data['totaldata'];
	

	// JIKA DATA > 0
	if ($arr['totaldata'] > 0) {
		$result=ambildata($koneksi,"tbl_pelanggan",$where,$page,$maxdata);
			 	
		while ($data=mysqli_fetch_assoc($result)) {	
			$arr['table'][]= "<tr>
						<td>$data[kode_pelanggan]</td>
						<td>$data[nama_pelanggan]</td>
						<td>$data[alamat]</td>
						<td>$data[no_telp]</td>
						<td>$data[akun]</td>
						<td><button class='btn btn-success btn-sm btn-edit' value='$data[kode_pelanggan]'>
						<i class='fa fa-edit'></i></button>
						<button class='btn btn-danger btn-sm btn-hapus' value='$data[kode_pelanggan]'>
						<i class='fa fa-trash-o'></i></button></td>
					</tr>";
					
		}
	}
	else{
		$arr['table'][]="";
	}
	
	$btn=buatbutton($koneksi,"tbl_pelanggan",$where,$maxdata);
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

	elseif (isset($_REQUEST['tambahdata'])) {

		
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

	

//AMBIL KODE PELANGGAN TOMBOL EDIT 
	elseif (isset($_REQUEST['ambileditdata'])) {
		$kode=filterdata($_REQUEST['kodepelanggan']);
		$query="select*from tbl_pelanggan where kode_pelanggan='$kode' ";
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
		$kode=filterdata($_REQUEST['kodepelanggan']);
		$nama=filterdata($_REQUEST['namapelanggan']);
		$alamat=filterdata($_REQUEST['alamat']);
		$notelp=filterdata($_REQUEST['notelp']);
		$akun=filterdata($_REQUEST['akun']);
		$query="update tbl_pelanggan set nama_pelanggan='$nama',
				alamat='$alamat', akun='$akun' , no_telp='$notelp' where kode_pelanggan='$kode' ";
		$result=mysqli_query($koneksi,$query);
		if($result){
			echo "Pelanggan dengan kode <b>'$kode'</b> berhasil diedit";
		}
		else {
			die("ada yg error".mysqli_error($koneksi));
		}
	}

	elseif(isset($_REQUEST['hapusdata'])){
		$kode=filterdata($_REQUEST['kodepelanggan']);
		$query="delete from tbl_pelanggan where kode_pelanggan='$kode' ";
		$result=mysqli_query($koneksi,$query);
		if($result){
			echo "Pelanggan dengan kode <b>'$kode'</b> berhasil dihapus";
		}
		else {
			die("ada yg error".mysqli_error($koneksi));
		}
	}

 ?>