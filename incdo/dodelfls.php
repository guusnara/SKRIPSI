<?php
session_start(); include('config.php');
$ht2 = $_GET['idbrks'];
$ht1 = $_GET['idkerja'];

if(isset($ht2) && !empty($ht2))	{
	$sy = mysql_fetch_array(mysql_query("select url_berkas from dt_berkas where id_berkas='$ht2'"));
	$syy = $sy[0];
	mysql_query("delete from dt_berkas where id_berkas='$ht2'");
	mysql_query("update dt_berkas set id_berkas='0' where id_kerja='$ht1'");
	unlink('../pegawaidb/'.$syy);
	//return '{}';
	echo json_encode('{}');
}
?>