<?php
include('../incdo/config.php');

$get = $_GET['apa'];
$dt = $_GET['val'];
if($get == 1)	{
	$s = mysql_fetch_array(mysql_query("select nama_jabatan from dt_jabatan where id_jabatan='$dt'"));
	echo $s[0];
} elseif($get == 2)	{
	$s = mysql_fetch_array(mysql_query("select nama_bidang from dt_bidang where id_bidang='$dt'"));
	if($s[0] == '-')
		echo '';
	else
		echo $s[0];
}
?>