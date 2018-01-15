<?php 
include('koneksi.php');
if (isset($_REQUEST['load'])) {
	$caridata=$_REQUEST['caridata'];
	//$kolom=$_REQUEST['kolom'];
	//$kategori=$_REQUEST['kategori'];
	$page=$_REQUEST['page'];
	$maxdata=$_REQUEST['maxdata'];
	$where="where kategori like '%$caridata%' "; 

	//AMBIL DATA INFO (TOTAL DATA)
	$result=mysqli_query($koneksi,
		"select count(*) totaldata from tbl_kategori $where ");
	$data=mysqli_fetch_assoc($result);
	$arr['totaldata']=$data['totaldata'];

	// JIKA DATA > 0
	if ($arr['totaldata'] > 0) {
		$result=ambildata($koneksi,"tbl_kategori",$where,$page,$maxdata);
			 	
		while ($data=mysqli_fetch_assoc($result)) {	
			$arr['table'][]= "<tr>
						<td>$data[kode_kategori]</td>
						<td>$data[kategori]</td>
						
						<td><button class='btn btn-success btn-sm btn-edit' value='$data[kode_kategori]'>
						<i class='fa fa-edit'></i></button>
						<button class='btn btn-danger btn-sm btn-hapus' value='$data[kode_kategori]'>
						<i class='fa fa-trash-o'></i></button></td>
					</tr>";
					
		}
	}
	else{
		$arr['table'][]="";
	}

	
	$btn=buatbutton($koneksi,"tbl_kategori",$where,$maxdata);
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

		
		$nama=filterdata($_REQUEST['namakategori']);

		$query="insert into tbl_kategori (kategori)
		values ('$nama')";
		$result=mysqli_query($koneksi,$query);
		if($result){
			echo "kategori dengan nama <b>'$nama'</b> berhasil ditambahkan";
		}
		else {
			die("ada yg error nih ".mysqli_error($koneksi));
		}
	}

	

//AMBIL KODE PELANGGAN TOMBOL EDIT 
	elseif (isset($_REQUEST['ambileditdata'])) {
		$kode=filterdata($_REQUEST['kodekategori']);
		$query="select*from tbl_kategori where kode_kategori='$kode' ";
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
		$kode=filterdata($_REQUEST['kodekategori']);
		$nama=filterdata($_REQUEST['namakategori']);
		$query="update tbl_kategori set kategori='$nama' where kode_kategori='$kode' ";
		$result=mysqli_query($koneksi,$query);
		if($result){
			echo "Kategori dengan kode <b>'$kode'</b> berhasil diedit";
		}
		else {
			die("ada yg error".mysqli_error($koneksi));
		}
	}

	elseif(isset($_REQUEST['hapusdata'])){
		$kode=filterdata($_REQUEST['kodekategori']);
		$query="delete from tbl_kategori where kode_kategori='$kode' ";
		$result=mysqli_query($koneksi,$query);
		if($result){
			echo "Kategori dengan kode <b>'$kode'</b> berhasil dihapus";
		}
		else {
			die("ada yg error".mysqli_error($koneksi));
		}
	}

 ?>