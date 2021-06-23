<?php session_start();
include('config.php');

$get = @$_GET['do'];
if($get == 'add')	{
	
	$var1 = $_POST['var1'];
	$var2 = $_POST['var2'];
	$var3 = $_POST['var3'];
	@$var4 = $_FILES['var4']['name'];
	@$var4tmp = $_FILES['var4']['tmp_name'];
	@$var4ext = pathinfo($var4, PATHINFO_EXTENSION);
	$var5 = $_POST['var5'];
	$var6 = $_POST['var6'];
	if(isset($_POST['var1']) || isset($_POST['var2']) || isset($_POST['var3']) || isset($_POST['var5']) || isset($_POST['var6']))	{
		if(empty($_POST['var1']) || empty($_POST['var2']) || empty($_POST['var3']) || empty($_POST['var5']) || empty($_POST['var6']))	{
			$status = 0;
		} else	{
			if(!empty($var4tmp))	{
				$cek = mysql_num_rows(mysql_query("select * from dt_berkas where nama_berkas='$var4' and NIP='$var1'"));
				if($cek > 0)	{
					@$var4 = ($cek+1).' of '.$_FILES['var4']['name'];
				}
				$dir = $var1.'/dtberkas/'.$var1.'_'.$var4;
				$dirx = '../pegawaidb/'.$dir;
				if(move_uploaded_file($var4tmp, $dirx))	{
					$var4size = (filesize($dirx) * .0009765625) * .0009765625; // mb
					$var43sum = number_format($var4size,2);
					if(mysql_query("insert into dt_berkas values('','$var4','$var4ext','$var43sum','$dir','$var1')"))	{
						$df = mysql_insert_id(); // works on php 5 and id is auto increment
						if(mysql_query("insert into dt_kerja values('','$var2','$var1','$var3','$df','$var5','$var6','','0')"))	{
							$status = 4;
							$psn = 'Data Berhasil Ditambah w/file';
						} else	{
							$status = 3;
							$psn = 'Data Tidak Berhasil Ditambah w/file';
							//mysql_query("delete from dt_berkas")
						}
					} else	{
						$status = 3;
						$psn = 'Data Tidak Berhasil Ditambah w/file only';
					}
				}
			} else	{
				$gh = '';
				if(mysql_query("insert into dt_kerja values('','$var2','$var1','$var3','$gh','$var5','$var6','','0')"))	{
					$status = 4;
					$psn = 'Data Berhasil Ditambah';
				} else	{
					$status = 3;
					$psn = 'Data Tidak Berhasil Ditambah';
				}
				
			}
		}
	} else	{
		$status = 1;
	}
	
} elseif($get == 'addang')	{
	
	$var1 = $_POST['var1']; // multiple nip
	$var2 = $_POST['var2']; // ket
	$var3 = $_POST['var3']; // tgl mulai
	$var4 = $_POST['var4']; // tgl selesai
	$var5 = $_POST['var5']; // idkerja
	
	if(isset($var1) && isset($var2) && isset($var3) && isset($var4))	{
		if(empty($var1) || empty($var2) || empty($var3) || empty($var4))	{
			$status = 0;
		} else	{
			$plode =  explode(',', $var1);
			$count = count($plode);
			if(mysql_query("insert into dt_dtl_kerja values('','$var5','$var2','$var3','$var4','','0','0')"))	{
				$iddtl = mysql_insert_id();
				for($i=0; $i<$count; $i++)	{
					mysql_query("insert into dt_dtl_pegawai_krj values('','$iddtl','$plode[$i]')");
				}
				$status = 4;
				$psn = 'Berhasil Menambah Data';
			} else	{
				$status = 3;
				$psn = 'Tidak Berhasil Menambah Data';
			}
		}
	} else	{
		$status = 1;
	}
	
} elseif($get == 'persen')	{
	
	$var1 = $_POST['var1'];
	$var2 = $_POST['var2'];
	
	if(isset($var1) && isset($var2))	{
		if(empty($var1) || empty($var2))	{
			$status = 0;
		} else	{
			if(mysql_query("update dt_dtl_kerja set persentase='$var2' where id_dtl_kerja='$var1'"))	{
				$status = 4;
				$psn = 'Persentase Telah Diperbaharui';
			} else	{
				$status = 3;
				$psn = 'Persentase Gagal Diperbaharui';
			}
		}
	} else	{
		$status = 1;
	}
	
} elseif($get == 'selesai')	{
	
	$var1 = $_POST['var1']; // id dtl kerja
	$var2 = $_POST['var2']; // id revisi
	
	if(isset($var1) && isset($var2))	{
		if(empty($var1))	{
			$status = 0;
		} else	{
			$dtnw = date("Y-m-d");
			if(mysql_query("update dt_dtl_kerja set tgl_selesai='$dtnw', persentase='100', status='1' where id_dtl_kerja='$var1'"))	{
				if($var2 != 0)	{
					mysql_query("update dt_revisi_kerja set status='1' where id_revisi_kerja='$var2'");
				}
				$status = 4;
				$psn = 'Proses Penyelesaian Kerja Sukses';
			} else	{
				$status = 3;
				$psn = 'Gagal Proses Penyelesaian Kerja';
			}
		}
	} else	{
		$status = 1;
	}
	
} elseif($get == 'selesaipup')	{
	
	$tmp = '';
	$tmp2 = '';
	$nms = '';
	$var0 = $_POST['var0']; // count files
	$var2 = $_POST['var2']; // id dtl kerja
	$var3 = $_POST['var3']; // nip
	
	for($d = 0; $d<$var0; $d++)	{
		$nms = $_FILES['var1-'.$d]['name'];
		$tmp .= $nms;
		$tmp2 .= pathinfo($nms, PATHINFO_EXTENSION);
		if($d+1!=$var0) {
			$tmp = $tmp.'?';
			$tmp2 = $tmp2.'?'; 
		}
	}
	$var1 = explode('?', $tmp); // filename
	$var1ext = explode('?', $tmp2); // extension filename
	
	if(isset($var0) && isset($var1) && isset($var2))	{
		if(empty($var0) || empty($var1) || empty($var2))	{
			$status = 0;
		} else	{
			
			$var1tmp = '';
			$var1name = '';
			$df = '';
			for($e = 0; $e<$var0; $e++)	{
				
				$var1tmp = $_FILES['var1-'.$e]['tmp_name'];
				$var1name = $var1[$e];
				if(!empty($var1tmp))	{
					$cek = mysql_num_rows(mysql_query("select * from dt_berkas where nama_berkas='$var1name' and NIP='$var3'"));
					if($cek > 0)	{
						$var1name = ($cek+1).' of '.$var1name;
					}
					$dir = $var3.'/dtberkas/'.$var3.'_'.$var1name;
					$dirx = '../pegawaidb/'.$dir;
					if(move_uploaded_file($var1tmp, $dirx))	{
						$var1size = (filesize($dirx) * .0009765625) * .0009765625; // mb
						$var13sum = number_format($var1size,2);
						if(mysql_query("insert into dt_berkas values('','$var1name','$var1ext[$e]','$var13sum','$dir','$var3')"))	{
							$df = mysql_insert_id(); // works on php 5 and id is auto increment
							if(mysql_query("insert into dt_dtl_brks_krj values('','$var2','$df')"))	{
								$status = 4;
								$psn = 'Proses Penyelesaian Kerja Sukses w/file';
							} else	{
								$status = 3;
								$psn = 'Gagal Proses Penyelesaian Kerja w/file';
								//mysql_query("delete from dt_berkas")
							}
						} else	{
							$status = 3;
							$psn = 'Penyelesaian Tidak Dapat Diproses w/file only';
						}
					}
					$df = '';
				} else	{
					$status = 2;
				}
				
			}
			$dtnw = date("Y-m-d");
			if(isset($_GET['rev']) && $_GET['rev'] != 0)	{
				$rv = $_GET['rev'];
				mysql_query("update dt_revisi_kerja set status='1' where id_revisi_kerja='$rv'");
			}
			if(mysql_query("update dt_dtl_kerja set tgl_selesai='$dtnw', persentase='100', status='1' where id_dtl_kerja='$var2'"))	{
				$status = 4;
				$psn = 'Proses Penyelesaian Kerja Sukses';
			} else	{
				$status = 3;
				$psn = 'Gagal Proses Penyelesaian Kerja';
			}
			
		}
	} else	{
		$status = 1;
	}
	
} elseif($get == 'selesaiall')	{

	$var1 = $_POST['var1']; // id dtl kerja
	$dtnw = date("Y-m-d");
	
	if(isset($var1))	{
		if(empty($var1))	{
			$status = 0;
		} else	{
			
			if(mysql_query("update dt_dtl_kerja set status='3', tgl_selesai='$dtnw' where id_dtl_kerja='$var1'"))	{
				$status = 4;
				$psn = 'Tugas Telah Selesai';
			} else	{
				$status = 3;
				$psn = 'Gagal Proses Penyelesaian Tugas';
			}
			
		}
	} else	{
		$status = 1;
	}
	
} elseif($get == 'selesaidone')	{
	
	$var1 = $_POST['var1']; // id kerja
	$dtnw = date("Y-m-d");
	
	if(isset($var1))	{
		if(empty($var1))	{
			$status = 0;
		} else	{
			if(mysql_query("update dt_kerja set status='1', tgl_selesai='$dtnw' where id_kerja='$var1'"))	{
				$status = 4;
				$psn = 'Project Telah Selesai Dilakukan';
			} else	{
				$status = 3;
				$psn = 'Proses Penyelesaian Project Gagal';
			}
		}
	} else	{
		$status = 1;
	}
	
} elseif($get == 'updateproject')	{

	$var0 = $_POST['var0']; // NIP
	$var1 = $_POST['var1']; // id kerja
	$var2 = $_POST['var2']; // nama kerja
	$var3 = $_POST['var3']; // deskripsi
	@$var4 = $_FILES['var4']['name'];
	@$var4tmp = $_FILES['var4']['tmp_name'];
	@$var4ext = pathinfo($var4, PATHINFO_EXTENSION);
	$var5 = $_POST['var5']; // tgl 1
	$var6 = $_POST['var6']; // tgl 2
	
	if(isset($_POST['var1']) || isset($_POST['var2']) || isset($_POST['var3']) || isset($_POST['var5']) || isset($_POST['var6']))	{
		if(empty($_POST['var1']) || empty($_POST['var2']) || empty($_POST['var3']) || empty($_POST['var5']) || empty($_POST['var6']))	{
			$status = 0;
		} else	{
			
			if(!empty($var4tmp))	{
				$cek = mysql_num_rows(mysql_query("select * from dt_berkas where nama_berkas='$var4' and NIP='$var0'"));
				if($cek > 0)	{
					@$var4 = ($cek+1).' of '.$_FILES['var4']['name'];
				}
				$dir = $var0.'/dtberkas/'.$var0.'_'.$var4;
				$dirx = '../pegawaidb/'.$dir;
				if(move_uploaded_file($var4tmp, $dirx))	{
					$var4size = (filesize($dirx) * .0009765625) * .0009765625; // mb
					$var43sum = number_format($var4size,2);
					if(mysql_query("insert into dt_berkas values('','$var4','$var4ext','$var43sum','$dir','$var1')"))	{
						$df = mysql_insert_id(); // works on php 5 and id is auto increment
						if(mysql_query("update dt_kerja set nama_kerja='$var2', ket='$var3', tgl_mulai='$var5', tgl_target_selesai='$var6', id_berkas='$df' where id_kerja='$var1'"))	{
							$status = 4;
							$psn = 'Data Berhasil Diperbaharui w/file';
						} else	{
							$status = 3;
							$psn = 'Data Tidak Berhasil Diperbaharui w/file';
							//mysql_query("delete from dt_berkas")
						}
					} else	{
						$status = 3;
						$psn = 'Data Tidak Berhasil Diperbaharui w/file only';
					}
				}
			} else	{
				$gh = '';
				if(mysql_query("update dt_kerja set nama_kerja='$var2', ket='$var3', tgl_mulai='$var5', tgl_target_selesai='$var6' where id_kerja='$var1'"))	{
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
	
} elseif($get == 'updatetugas')	{

	$var1 = $_POST['var1']; // multiple nip
	$var2 = $_POST['var2']; // ket
	$var3 = $_POST['var3']; // tgl mulai
	$var4 = $_POST['var4']; // tgl target selesai
	$var5 = $_POST['var5']; // id dtl kerja
	
	if(isset($var2) && isset($var3) && isset($var4))	{
		if(empty($var2) || empty($var3) || empty($var4))	{
			$status = 0;
		} else	{
			if($var1!='null')	{
				$plode =  explode(',', $var1);
				$count = count($plode);
				
				if(mysql_query("update dt_dtl_kerja set ket='$var2', tgl_mulai='$var3', tgl_target_selesai='$var4' where id_dtl_kerja='$var5'"))	{
					for($i=0; $i<$count; $i++)	{
						mysql_query("update dt_dtl_pegawai_krj set NIP='$plode[$i]' where id_dtl_kerja='$var5'");
					}
					$status = 4;
					$psn = 'Berhasil Memperbaharui Tugas';
				} else	{
					$status = 3;
					$psn = 'Tidak Berhasil Memperbaharui Tugas';
				}
			} else	{
				if(mysql_query("update dt_dtl_kerja set ket='$var2', tgl_mulai='$var3', tgl_target_selesai='$var4' where id_dtl_kerja='$var5'"))	{
					$status = 4;
					$psn = 'Berhasil Memperbaharui Tugas 1';
				} else	{
					$status = 3;
					$psn = 'Tidak Berhasil Memperbaharui Tugas 1';
				}
			}
		}
	} else	{
		$status = 1;
	}
	
} elseif($get == 'revisi')	{
	
	$var1 = $_POST['var1']; // id detail kerja
	$var2 = $_POST['var2']; // ket revisi
	$var3 = $_POST['var3']; // persen
	
	if(isset($var1) && isset($var2) && isset($var3))	{
		if(empty($var1) || empty($var2) || empty($var2))	{
			$status = 0;
		} else	{
			if(mysql_query("update dt_dtl_kerja set persentase='$var3', status='2' where id_dtl_kerja='$var1'") && mysql_query("insert into dt_revisi_kerja values('','$var1','$var2','0')"))	{
				$status = 4;
				$psn = 'Revisi Telah Diberikan';
			} else	{
				$status = 3;
				$psn = 'Proses Revisi Gagal';
			}
		}
	} else	{
		$status = 1;
	}
	
} elseif($get == 'delete')	{
	/*
	if(isset($_POST['id']))	{
		$id = addslashes($_POST['id']);
		if(empty($id))	{
			$status = 0;
		} else	{
			if(mysql_query("delete from dt_jabatan where id_jabatan='$id'"))	{
				$status = 4;
				$psn = 'Data Berhasil Dihapus';
			} else	{
				$status = 3;
				$psn = 'Data Tidak Berhasil Dihapus';
			}
		}
	} else	{
		$status = 1;
	} */
	
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