<?php 
		//buat koneksi
		
		$koneksi=mysqli_connect("localhost","root","","efg");
		$maxdata=5;
		
		function getkategori($koneksi){
			$result=mysqli_query($koneksi,"select*from tbl_kategori");
			while ($data=mysqli_fetch_assoc($result)) {
			echo "<option value='$data[kategori]'>$data[kategori]</option>";
		}

		}	
		
		function filterdata($data){
			$hasil=strtolower(htmlentities($data));
			return $hasil;
		}

		function ambildata($koneksi,$namatable,$where,$page,$maxdata){
			//global $maxdata;
			if ($page==1 or $page ==0) {
				$page=0;
			}
			else{
				$page=($page*$maxdata)-$maxdata;
			}
			$result=mysqli_query($koneksi,"select*from $namatable $where limit $page,$maxdata");
			if (!$result) {
				die(mysqli_error($koneksi));
			}
			return $result;
		}

		function buatbutton($koneksi,$namatabel,$where,$maxdata){
			//global $maxdata;
			$result=mysqli_query($koneksi,"select*from $namatabel $where");
			$rowcount=mysqli_num_rows($result);
			$rowcount=$rowcount/$maxdata;
			$rowcount=ceil($rowcount);
			return $rowcount;
		}

	//	echo buatbutton($koneksi,'tbl_produk',"where kode_produk like '%%' and kategori like '%%'",10)
		

		
 ?>