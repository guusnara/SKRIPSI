<?php
session_start();
include('config.php');
$go = @$_GET['go'];
echo $go.'----- ';
if($go == 'logout')	{
	if($_GET['sts'] == 1)	{
		unset($_COOKIE['admin']);
		$res = setcookie('admin', '', time() - (7800 * 30), '/');
		echo $_COOKIE['admin'];
		echo ' this ';
	} elseif($_GET['sts'] == 2)	{
		unset($_COOKIE['pegawai']);
		$res = setcookie('pegawai', '', time() - (86400 * 30), '/');
		echo ' this 2 ';
	} else	{
		//header('location:../index.php');
		echo ' shit ';
	}
	session_destroy();
	echo ' logout ';
} else	{
	//echo ' shitttt ';
}
echo ' yoo ';
header('location:../login.php');
?>