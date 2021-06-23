<?php
session_start();
//koneksi ke database
include('config.php');
if(isset($_POST['var_usn']) AND isset($_POST['var_pwd'])){
	if(empty($_POST['var_usn']) AND empty($_POST['var_pwd']))	{
		echo'Data Tidak Boleh Kosong';
	} else	{
		$username = addslashes($_POST['var_usn']);
		$password = md5(addslashes($_POST['var_pwd']));
		$adorno = mysql_query('select * from dt_pegawai where username="'.$username.'" AND password="'.$password.'" ');
		$check    = mysql_query('select * from dt_admin where username="'.$username.'" AND password="'.$password.'" ');
		if(mysql_num_rows($adorno)==0){
			if(mysql_num_rows($check)==0){
				echo 'Username atau Password Salah !';
			} else	{
				$namea = mysql_fetch_array($check);
				$cookie_role = 'admin';
				$cookie_alias = $namea[0].'-'.$namea[1];
				//setcookie($cookie_role, $cookie_alias, time() + (7800 * 30)); // 7800 = 30 minutes
				//$cookie = $_COOKIE[$cookie_role];
				$_SESSION['admin']['id_admin'] = $namea[0];
				//echo $_SESSION['admin']['id_admin'] ;
				//$ssid = $_SESSION['admin']['id_admin'];
				$_SESSION['admin']['nama_admin'] = $namea[1];
				//$ssnm = $_SESSION['admin']['nama_admin'];
				echo 'ok';
				//header('location:../index.php');
			}
		} else{
			$name = mysql_fetch_array($adorno);
			$cookie_role = 'pegawai';
			$cookie_alias = $name[0].'-'.$name[1];
			//setcookie($cookie_role, $cookie_alias, time() + (86400 * 30)); // 7800 = 30 minutes
			//$cookie = $_COOKIE[$cookie_role];
			$_SESSION['pegawai']['NIP'] = $name[0];
			//$ssid = $_SESSION['pegawai']['NIP'];
			$_SESSION['pegawai']['nama_pegawai'] = $name[1];
			$d = mysql_fetch_array(mysql_query("select role from dt_jabatan where id_jabatan='$name[3]'"));
			$_SESSION['pegawai']['role'] = $d[0];
			//$ssnm = $_SESSION['pegawai']['nama_pegawai'];
			echo 'ok';
			//header('location:../index.php');
		}
	}
}
?>