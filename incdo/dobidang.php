<?php session_start();
include('config.php');

$get = @$_GET['do'];
if($get == 'add')	{
	
	if(isset($_POST['var1']))	{
		$vr = addslashes($_POST['var1']);
		if(empty($vr))	{
			$status = 0;
		} else	{
			if(mysql_query("insert into dt_bidang values('','$vr')"))	{
				$status = 4;
				$psn = 'Data Berhasil Ditambah';
			} else	{
				$status = 3;
				$psn = 'Data Tidak Berhasil Ditambah';
			}
		}
	} else	{
		$status = 1;
	}
	
} elseif($get == 'update')	{
	
	if(isset($_POST['var1']) && isset($_POST['id']))	{
		$vr = addslashes($_POST['var1']);
		$id = addslashes($_POST['id']);
		if(empty($vr) || empty($id))	{
			$status = 0;
		} else	{
			if(mysql_query("update dt_bidang set nama_bidang='$vr' where id_bidang='$id'"))	{
				$status = 4;
				$psn = 'Data Berhasil Diperbaharui';
			} else	{
				$status = 3;
				$psn = 'Data Tidak Berhasil Diperbaharui';
			}
		}
	} else	{
		$status = 1;
	}
	
} elseif($get == 'delete')	{
	
	if(isset($_POST['id']))	{
		$id = addslashes($_POST['id']);
		if(empty($id))	{
			$status = 0;
		} else	{
			if(mysql_query("delete from dt_bidang where id_bidang='$id'"))	{
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