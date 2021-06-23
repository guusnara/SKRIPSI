<?php session_start();
include('config.php');

$get = @$_GET['do'];
if($get == 'delete')	{
	
	if(isset($_POST['id']))	{
		$id = addslashes($_POST['id']);
		if(empty($id))	{
			$status = 0;
		} else	{
			if(mysql_query("delete from dt_berkas where id_berkas='$id'"))	{
				$status = 4;
				$psn = 'Data Berhasil Dihapus';
			} else	{
				$status = 3;
				$psn = 'Data Tidak Berhasil Dihapus';
			}
		}
	} else	{
		$status = 1;
	}
	
} else	{
	$status = 2;
}

if($status==0)	{
	$response = array(
		'status'=>'gagal', // Set status
		'pesan'=>'Data Tidak Boleh Kosong'
	);
} elseif($status==1)	{
	$response = array(
		'status'=>'gagal', // Set status
		'pesan'=>'Data Belum Ditentukan'
	);
} elseif($status==2)	{
	$response = array(
		'status'=>'gagal', // Set status
		'pesan'=>'Data Gagal Mencapai Tujuan'
	);
} elseif($status==3)	{
	$response = array(
		'status'=>'gagal', // Set status
		'pesan'=>$psn
	);
} elseif($status==4)	{
	// Load ulang
	//ob_start();
	//include "../incpart/tablebidang.php";
	//$html = ob_get_contents();
	//ob_end_clean();
	$response = array(
	  'status'=>'ok', // Set status
	  'pesan'=>$psn // Set pesan
	  //'html'=>$html // Set html
	);
}	
echo json_encode($response); // konversi variabel response menjadi JSON
?>