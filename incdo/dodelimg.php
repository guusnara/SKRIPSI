<?php
session_start(); include('config.php');
$ht = $_GET['iddtlbrks'];
$ht2 = $_GET['idbrks'];

if(isset($ht) && !empty($ht) && isset($ht2) && !empty($ht2))	{
	$sy = mysql_fetch_array(mysql_query("select url_berkas from dt_berkas where id_berkas='$ht2'"));
	$syy = $sy[0];
	mysql_query("delete from dt_dtl_brks_krj where id_dtl_brks_krj='$ht'");
	mysql_query("delete from dt_berkas where id_berkas='$ht2'");
	unlink('../pegawaidb/'.$syy);
	//return '{}';
	echo json_encode('{}');
}
?>