<?php
session_start();
include('config.php');
$cek = $_POST['usernamee'];
$id = @$_GET['id'];
	if(mysql_num_rows(mysql_query("select * from dt_admin where username='$cek' and id_admin!='$id'"))>0)	{
		$response = array(
			'valid' => false,
  			'message' => 'Username is already taken.'
		);
	} else	{
		$response = array(
			'valid' => true
		);
	}
echo json_encode($response); // konversi variabel response menjadi JSON
?>