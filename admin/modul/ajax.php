<?php
	include_once "../config/class.php";
    
	$tgl_awal = $_POST['tgl_awal'];
	$tgl_akhir = $_POST['tgl_akhir'];
    $id_pemesanan = $_POST['id_pemesanan'];
	
	$sql = "SELECT DATEDIFF('$tgl_awal','$tgl_akhir') AS tothari";
	$qry = mysql_query($sql);
    $data = mysql_fetch_assoc($qry);
    $tothari = $data['tothari'];
    $sql2 = "SELECT * FROM tb_pemesanan WHERE id_pemesanan='$id_pemesanan'";
    $qry2 = mysql_query($sql2);
	while($arr= mysql_fetch_array($qry2)){
		$harga_hari = $arr['harga'];
	}
	$total_bayar = $tothari * $harga_hari ;
	
	echo $total_bayar;
?>