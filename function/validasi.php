
<?php 
	if($_POST['kodeproduk']!=''){
		$koneksi=mysqli_connect("localhost","root","","efg");
		$result=mysqli_query($koneksi,
							 "select * from tbl_produk where kode_produk='$_POST[kodeproduk]' ");
		$data=mysqli_fetch_assoc($result);
		if(mysqli_num_rows($result) == 0){
			echo "true";

		}
		else{
			echo "false";
		}
		
		
	}
 ?>