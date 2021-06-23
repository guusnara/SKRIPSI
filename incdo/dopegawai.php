<?php session_start();
include('config.php');

function recursiveDelete($str) {
    if (is_file($str)) {
        return @unlink($str);
    }
    elseif (is_dir($str)) {
        $scan = glob(rtrim($str,'/').'/*');
        foreach($scan as $index=>$path) {
            recursiveDelete($path);
        }
        return @rmdir($str);
    }
}

$get = @$_GET['do'];
if($get == 'add')	{
	
	$var1 = $_POST['var1']; // nip
	$var2 = $_POST['var2']; // nama
	$var3 = $_POST['var3']; // jk
	$var4 = $_POST['var4']; // bidang
	$var5 = $_POST['var5']; // jabatan
	$var6 = $_POST['var6']; // alamat
	$var7 = $_POST['var7']; // tlp
	$var8 = $_POST['var8']; // email
	$var9 = $_POST['var9']; // gambar
	$var10 = $_POST['var10']; // user
	$var11 = $_POST['var11']; // pass
	
	if(isset($var1) && isset($var2) && isset($var3) && isset($var4) && isset($var5) && isset($var6) && isset($var7) && isset($var8) && isset($var9) && isset($var10) && isset($var11))	{
		if(empty($var1) && empty($var2) && empty($var3) && empty($var4) && empty($var5) && empty($var6) && empty($var7) && empty($var8) && empty($var9) && empty($var10) && empty($var11))	{
			$status = 0;
		} else	{
			$mkdir = mkdir('../pegawaidb/'.$var1, 0777, true);
			$mkdir2 = mkdir('../pegawaidb/'.$var1.'/dtberkas', 0777, true);
			
			if($mkdir && $mkdir2)	{
				list($type, $var9) = explode(';', $var9);
				list(, $var9)      = explode(',', $var9);

				$var9 = base64_decode($var9);
				//$imageName = time().'.jpg';
				$dir = $var1.'/'.$var1.'.jpg';
				$masuk = file_put_contents('../pegawaidb/'.$dir, $var9);
				
				$md5 = md5($var11);
				
				if(mysql_query("insert into dt_pegawai values('$var1','$var2','$var4','$var5','$var3','$var6','$var7','$var8','$dir','$var10','$md5')") && $masuk)	{
					$status = 4;
					$psn = 'Data Berhasil Ditambah';
				} else	{
					$status = 3;
					$psn = 'Data Tidak Berhasil Ditambah';
				}
			} else	{
				$status = 2;
			}
		}
	} else	{
		$status = 1;
	}
	
} elseif($get == 'update')	{
	
	$var1 = $_POST['var1']; // nip
	$var2 = $_POST['var2']; // nama
	$var3 = $_POST['var3']; // jk
	$var4 = $_POST['var4']; // bidang
	$var5 = $_POST['var5']; // jabatan
	$var6 = $_POST['var6']; // alamat
	$var7 = $_POST['var7']; // tlp
	$var8 = $_POST['var8']; // email
	//$var9 = $_POST['var9']; // gambar
	$var10 = $_POST['var10']; // user
	$var11 = $_POST['var11']; // pass
	$var12 = $_POST['var12']; // tmp nip
	
	if(isset($var1) && isset($var2) && isset($var3) && isset($var4) && isset($var5) && isset($var6) && isset($var7) && isset($var8) && isset($var10) && isset($var11) && isset($var12))	{
		if(empty($var1) && empty($var2) && empty($var3) && empty($var4) && empty($var5) && empty($var6) && empty($var7) && empty($var8) && empty($var10) && empty($var11) && empty($var12))	{
			$status = 0;
		} else	{
			$md5 = md5($var11);
			if(mysql_num_rows(mysql_query("select * from dt_pegawai where nip='$var12' and password='$md5'"))==0)	{
				$status = 3;
				$psn = 'Password Yang Anda Ketikan Salah. Tidak Dapat Memperbaharui Data';
			} else	{
				$dir = $var1.'/'.$var1.'.jpg';
				if(mysql_query("update dt_pegawai set nip='$var1', nama_pegawai='$var2', id_bidang='$var4', id_jabatan='$var5', jk='$var3', alamat='$var6', no_telp='$var7', email='$var8', username='$var10', url_photo='$dir' where nip='$var12' and password='$md5'"))	{
					// SEMENTARA
					if($var1 != $var12)	{
						mysql_query("update dt_dtl_pegawai_krj set nip='$var1' where nip='$var12'");
						mysql_query("update dt_kerja set nip='$var1' where nip='$var12'");
						$d = mysql_query("select url_berkas from dt_berkas where nip='$var12'");
						while($dd = mysql_fetch_array($d))	{
							$plode = explode('/',$dd[0]);
							$newDir = $var1.'/'.$plode[1].'/'.$plode[2];
							mysql_query("update dt_berkas set url_berkas='$newDir' where nip='$var12'");
						}
						mysql_query("update dt_berkas set nip='$var1' where nip='$var12'");
						rename('../pegawaidb/'.$var12, '../pegawaidb/'.$var1);
						rename('../pegawaidb/'.$var1.'/'.$var12.'.jpg', '../pegawaidb/'.$var1.'/'.$var1.'.jpg');
						if(isset($_SESSION['pegawai']))
							$_SESSION['pegawai']['NIP'] = $var1;
					}
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
			if(mysql_num_rows(mysql_query("select * from dt_pegawai where nip='$var3' and password='$md5'"))==0)	{
				$status = 3;
				$psn = 'Password Yang Anda Ketikan Salah. Tidak Dapat Memperbaharui Password';
			} else	{
				if(mysql_query("update dt_pegawai set password='$md5s' where NIP='$var3'"))	{
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
	
} elseif($get == 'updateimg')	{
	
	$var1 = $_POST['var1']; // img
	$var2 = $_POST['var2']; // id
	
	if(isset($var1) && isset($var2))	{
		if(empty($var1) && empty($var2))	{
			$status = 0;
		} else	{
			list($type, $var1) = explode(';', $var1);
			list(, $var1)      = explode(',', $var1);

			$var1 = base64_decode($var1);
			$dir = $var2.'/'.$var2.'.jpg';

			if(unlink('../pegawaidb/'.$dir))	{
				$masuk = file_put_contents('../pegawaidb/'.$dir, $var1);
				if($masuk)	{
					$status = 4;
					$psn = 'Foto Berhasil Diunggah';
				} else	{
					$status = 3;
					$psn = 'Foto Tidak Berhasil Diunggah';
				}
			} else	{
				$status = 3;
				$psn = 'Foto Tidak Berhasil Diunggah';
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
			if(mysql_query("delete from dt_pegawai where nip='$id'"))	{
				
				$dir = '../pegawaidb/'.$id; //get all file names
				recursiveDelete($dir);
				
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