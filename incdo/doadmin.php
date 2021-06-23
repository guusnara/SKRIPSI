<?php session_start();
include('config.php');

$get = @$_GET['do'];
if($get == 'add')	{
	
	$var1 = $_POST['var1'];
	$var2 = $_POST['var2'];
	$var3 = $_POST['var3'];
	$var4 = $_POST['var4'];
	
	if(isset($var1) && isset($var2) && isset($var3) && isset($var4))	{
		if(empty($var1) && empty($var2) && empty($var3) && empty($var4))	{
			$status = 0;
		} else	{
			$md5 = md5($var4);
			if(mysql_query("insert into dt_admin values('','$var1','$var2','$var3','$md5')"))	{
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
	
	$var1 = $_POST['var1'];
	$var2 = $_POST['var2'];
	$var3 = $_POST['var3'];
	$var4 = $_POST['var4'];
	$var5 = $_POST['var5'];
	
	if(isset($var1) && isset($var2) && isset($var3) && isset($var4) && isset($var4))	{
		if(empty($var1) && empty($var2) && empty($var3) && empty($var4) && empty($var4))	{
			$status = 0;
		} else	{
			$md5 = md5($var4);
			if(mysql_num_rows(mysql_query("select * from dt_admin where id_admin='$var5' and password='$md5'"))==0)	{
				$status = 3;
				$psn = 'Password Yang Anda Ketikan Salah. Tidak Dapat Memperbaharui Data';
			} else	{
				if(mysql_query("update dt_admin set nama_admin='$var1', no_telp='$var2', username='$var3' where id_admin='$var5'"))	{
					$status = 4;
					$psn = 'Data Berhasil Diperbaharui';
				} else	{
					$status = 3;
					$psn = 'Data Tidak Berhasil Diperbaharui';
				}
			}
		}
	} else	{
		$status = 1;
	}
	
} elseif($get == 'updatepass')	{
	
	$var1 = $_POST['var1']; // lama
	$var2 = $_POST['var2']; // baru
	$var3 = $_POST['var3']; // id
	
	if(isset($var1) && isset($var2) && isset($var3))	{
		if(empty($var1) && empty($var2) && empty($var3))	{
			$status = 0;
		} else	{
			$md5 = md5($var1);
			$md5s = md5($var2);
			if(mysql_num_rows(mysql_query("select * from dt_admin where id_admin='$var3' and password='$md5'"))==0)	{
				$status = 3;
				$psn = 'Password Yang Anda Ketikan Salah. Tidak Dapat Memperbaharui Password';
			} else	{
				if(mysql_query("update dt_admin set password='$md5s' where id_admin='$var3'"))	{
					$status = 4;
					$psn = 'Data Berhasil Diperbaharui';
				} else	{
					$status = 3;
					$psn = 'Data Tidak Berhasil Diperbaharui';
				}
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
			if(mysql_query("delete from dt_admin where id_admin='$id'"))	{
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