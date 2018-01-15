<?php 
$koneksi=mysqli_connect('localhost','root','','efg');
/*for ($i=1; $i <= 12 ; $i++) { 
	$number[]=cal_days_in_month(CAL_GREGORIAN, $i, 2017);
}
$tanggal1='01';
$bulan1='01';
$tanggal2='30';

$mulai = strtotime("2017/$bulan1/$tanggal1"); 
$akhir = strtotime("2017/$bulan2/$tanggal2");
$selisih = $akhir-$mulai;

$selisih=($selisih / (60 * 60 * 24 ));



while ($selisih>=0) {
	$arr['categories'][]="2017/01/$tanggal1";

	$query="select sum(profit) profit from tbl_penjualan 
		where tipe=0 and date(tanggal) = '2017/01/$tanggal1'";
	$result=mysqli_query($koneksi,$query);
	$data=mysqli_fetch_assoc($result);
	$arr['series'][0]['name']="Offline";
	$arr['series'][0]['data'][]=(int)$data['profit'];

	$query="select sum(profit) profit from tbl_penjualan 
		where tipe=1 and date(tanggal) = '2017/01/$tanggal1'";
	$result=mysqli_query($koneksi,$query);
	$data=mysqli_fetch_assoc($result);
	$arr['series'][1]['name']="Online";
	$arr['series'][1]['data'][]=(int)$data['profit'];

	$selisih--;
	$tanggal1++;
}


// per bln
$namabln=['kosong','jan','feb','mar','apr','may','jun','jul','ags','sep','oct','nov','des',];
$tahun=date("Y");

for ($i=1; $i <= 12; $i++) { 
	$arr['categories'][]=$namabln[$i];
	$query="select sum(profit) profit from tbl_penjualan 
		where tipe=0 and month(tanggal) = '$i' and year(tanggal) = '$tahun'";
	$result=mysqli_query($koneksi,$query);
	$data=mysqli_fetch_assoc($result);
	$arr['series'][0]['name']="Offline";
	$arr['series'][0]['data'][]=(int)$data['profit'];

	$query="select sum(profit) profit from tbl_penjualan 
		where tipe=1 and month(tanggal) = '$i' and year(tanggal) = '$tahun'";
	$result=mysqli_query($koneksi,$query);
	$data=mysqli_fetch_assoc($result);
	$arr['series'][1]['name']="Online";
	$arr['series'][1]['data'][]=(int)$data['profit'];
}

// per thn
$tahun1=2016;
$tahun2=2030;
$selisih=$tahun2-$tahun1;
while ($tahun1<=$tahun2) { 

	$arr['categories'][]=$tahun1;

	$query="select sum(profit) profit from tbl_penjualan 
		where tipe=0 and year(tanggal) = '$tahun1'";
	$result=mysqli_query($koneksi,$query);
	$data=mysqli_fetch_assoc($result);
	$arr['series'][0]['name']="Offline";
	$arr['series'][0]['data'][]=(int)$data['profit'];

	$query="select sum(profit) profit from tbl_penjualan 
		where tipe=1 and year(tanggal) = '$tahun1'";
	$result=mysqli_query($koneksi,$query);
	$data=mysqli_fetch_assoc($result);
	$arr['series'][1]['name']="Online";
	$arr['series'][1]['data'][]=(int)$data['profit'];
	$tahun1++;
}
*/

// perhari
$bulan=2;
$tahun=2017;
$jumlahhari=cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);

for ($i=1; $i <= $jumlahhari; $i++) { 
	$arr['categories'][]=$i;
	$query="select sum(profit) profit from tbl_penjualan 
		where tipe=0 and day(tanggal) = '$i' and year(tanggal) = '$tahun'";
	$result=mysqli_query($koneksi,$query);
	$data=mysqli_fetch_assoc($result);
	$arr['series'][0]['name']="Offline";
	$arr['series'][0]['data'][]=(int)$data['profit'];

	$query="select sum(profit) profit from tbl_penjualan 
		where tipe=1 and day(tanggal) = '$i' and year(tanggal) = '$tahun'";
	$result=mysqli_query($koneksi,$query);
	$data=mysqli_fetch_assoc($result);
	$arr['series'][1]['name']="Online";
	$arr['series'][1]['data'][]=(int)$data['profit'];
}
echo json_encode($arr);
 ?>