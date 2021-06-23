<?php session_start(); include('../incdo/config.php');
	
$dtnw = date("Y-m-d");
$pdtnw = strtotime($dtnw);
$get = $_GET['pk'];
if(isset($_SESSION['pegawai']['NIP']))
	$nip = $_SESSION['pegawai']['NIP'];
$cc = 0;
if($get == 1)	{
	
	$q = mysql_query("
	SELECT
	dt_kerja.id_kerja, dt_kerja.nama_kerja, dt_kerja.tgl_target_selesai, dt_dtl_kerja.status
	FROM dt_kerja
	JOIN dt_dtl_kerja ON dt_kerja.id_kerja = dt_dtl_kerja.id_kerja
	JOIN dt_dtl_pegawai_krj ON dt_dtl_kerja.id_dtl_kerja = dt_dtl_pegawai_krj.id_dtl_kerja
	WHERE dt_dtl_kerja.status IN ('0','2')
	AND dt_kerja.tgl_mulai<='$dtnw'
	AND dt_kerja.status='0'
	AND dt_dtl_pegawai_krj.NIP='$nip'
	ORDER BY dt_dtl_kerja.status DESC
	");
	$cek = mysql_num_rows($q);
	$tmp = 0;
	if($cek == 0)	{
		$cc = 1;
	} else	{
		while($qq = mysql_fetch_array($q))	{ ?>
			
			<?php if($tmp != $qq[0])	{ ?>
				<div class="fix-list-group list-group-flush small">

					<a href="#" class="list-group-item list-group-item-action klikpks" data-toggle="modal" data-target="#myModal2" data-backdrop="false" data-id="<?= $qq[0]; ?>" data-name="<?= $qq[1]; ?>">
					  <div class="media">
						<i class="fa fa-circle fa-lg mr-2 mt-1" aria-hidden="true"></i>
						<div class="media-body">
						  <strong><?= $qq[1]; ?><?php if($qq[3] == 2)	{ echo ' - <span class="text-danger">Perlu Revisi</span>'; } ?></strong>
						  <div class="smaller">Target Selesai : <?= $qq[2]; ?></div>
						</div>
					  </div>
					</a>

				</div>
			<?php } ?>

		<?php $tmp = $qq[0];
		}
	}
	
	/*
	$q = mysql_query("select * from dt_dtl_pegawai_krj where NIP='$nip' order by id_dtl_kerja desc");
	$cek = mysql_num_rows($q);
	$tmp = 0;
	$isi = 0;
	if($cek > 0)	{
		while($qq = mysql_fetch_array($q))	{
			$iddtl = $qq[1];
			//$q2 = mysql_query("select * from dt_dtl_kerja join dt_kerja on dt_dtl_kerja.id_kerja = dt_kerja.id_kerja where dt_dtl_kerja.id_dtl_kerja='$iddtl' and dt_dtl_kerja.status < 2");
			$q2 = mysql_query("select * from dt_dtl_kerja where id_dtl_kerja='$iddtl'");
			
			$cek2 = mysql_num_rows($q2);
			if($cek2 > 0)	{
				$qq2 = mysql_fetch_array($q2);
				$idkrj = $qq2[1];
				$q3 = mysql_query("select * from dt_kerja where id_kerja='$idkrj' and status='0'");
				$qq3 = mysql_fetch_array($q3);
				$cek3 = mysql_num_rows($q3);
				
				if($cek3 != 0)	{
					if($tmp == 0 || $tmp != $idkrj)	{
						$isi = 1;
					} else	{
						$isi = 0;
					}
				} else	{
					$isi = 0;
				}

				if($isi == 1)	{ ?>
					<div class="fix-list-group list-group-flush small">

						<a href="#" class="list-group-item list-group-item-action klikpks" data-toggle="modal" data-target="#myModal2" data-backdrop="false" data-id="<?= $idkrj; ?>" data-name="<?= $qq3[1]; ?>">
						  <div class="media">
							<i class="fa fa-circle fa-lg mr-2 mt-1" aria-hidden="true"></i>
							<div class="media-body">
							  <strong><?= $qq3[1]; ?></strong>
							  <div class="smaller">Target Selesai : <?= $qq3[6]; ?></div>
							</div>
						  </div>
						</a>

					</div>
				<?php } $tmp = $idkrj; $cc = 0;
				
			} else	{
				$cc = 1;
			}
		}
	} else	{
		$cc = 1;
	}
	/*
	$a = mysql_query("select * from dt_kerja where NIP='$nip' and status='0'");
	if(mysql_num_rows($a) == 0)	{
		$cc = 1;
	} else	{
		while($b = mysql_fetch_array($a))	{ ?>
			<div class="fix-list-group list-group-flush small">

				<a href="#" class="list-group-item list-group-item-action klikpks" data-toggle="modal" data-target="#myModal2" data-backdrop="false" data-id="<?= $b[0]; ?>" data-name="<?= $b[1]; ?>">
				  <div class="media">
					<i class="fa fa-circle fa-lg mr-2 mt-1" aria-hidden="true"></i>
					<div class="media-body">
					  <strong><?= $b[1]; ?></strong>
					  <div class="smaller">Target Selesai : <?= $b[6]; ?></div>
					</div>
				  </div>
				</a>

			</div>
		<?php }
	}*/
} elseif($get == 2)	{
	
	$q = mysql_query("
	SELECT
	dt_kerja.id_kerja, dt_kerja.nama_kerja, dt_kerja.tgl_target_selesai
	FROM dt_kerja
	WHERE dt_kerja.tgl_mulai<='$dtnw'
	AND dt_kerja.status='0'
	AND  dt_kerja.NIP='$nip'
	");
	$cek = mysql_num_rows($q);

	if($cek == 0)	{
		$cc = 1;
	} else	{
		while($qq = mysql_fetch_array($q))	{ ?>

			<div class="fix-list-group list-group-flush small">

				<a href="#" class="list-group-item list-group-item-action klikpks" data-toggle="modal" data-target="#myModal2" data-backdrop="false" data-id="<?= $qq[0]; ?>" data-name="<?= $qq[1]; ?>">
				  <div class="media">
					<i class="fa fa-circle fa-lg mr-2 mt-1" aria-hidden="true"></i>
					<div class="media-body">
					  <strong><?= $qq[1]; ?></strong>
					  <div class="smaller">Target Selesai : <?= $qq[2]; ?></div>
					</div>
				  </div>
				</a>

			</div>

		<?php }
	}
	
} elseif($get == 3)	{
	
	$q = mysql_query("
	SELECT
	dt_kerja.id_kerja, dt_kerja.nama_kerja, dt_kerja.tgl_target_selesai
	FROM dt_kerja
	JOIN dt_dtl_kerja ON dt_kerja.id_kerja = dt_dtl_kerja.id_kerja
	JOIN dt_dtl_pegawai_krj ON dt_dtl_kerja.id_dtl_kerja = dt_dtl_pegawai_krj.id_dtl_kerja
	WHERE dt_kerja.tgl_mulai<='$dtnw'
	AND dt_kerja.status='0'
	AND dt_dtl_pegawai_krj.NIP='$nip'
	AND dt_dtl_kerja.status='1'
	");
	$cek = mysql_num_rows($q);
	$tmp = 0;
	if($cek == 0)	{
		$cc = 1;
	} else	{
		while($qq = mysql_fetch_array($q))	{ ?>

			<?php if($tmp != $qq[0])	{ ?>
				<div class="fix-list-group list-group-flush small">

					<a href="#" class="list-group-item list-group-item-action klikpks" data-toggle="modal" data-target="#myModal2" data-backdrop="false" data-id="<?= $qq[0]; ?>" data-name="<?= $qq[1]; ?>">
					  <div class="media">
						<i class="fa fa-circle fa-lg mr-2 mt-1" aria-hidden="true"></i>
						<div class="media-body">
						  <strong><?= $qq[1]; ?></strong>
						  <div class="smaller">Target Selesai : <?= $qq[2]; ?></div>
						</div>
					  </div>
					</a>

				</div>
			<?php } ?>

		<?php $tmp = $qq[0];
		}
	}
	
} elseif($get == 4)	{
	
	$q = mysql_query("
	SELECT
	dt_kerja.id_kerja, dt_kerja.nama_kerja, dt_kerja.tgl_target_selesai, dt_dtl_kerja.status
	FROM dt_kerja
	JOIN dt_dtl_kerja ON dt_kerja.id_kerja = dt_dtl_kerja.id_kerja
	JOIN dt_dtl_pegawai_krj ON dt_dtl_kerja.id_dtl_kerja = dt_dtl_pegawai_krj.id_dtl_kerja
	WHERE dt_dtl_kerja.status='0'
	AND dt_kerja.tgl_mulai>'$dtnw'
	AND dt_kerja.status='0'
	AND dt_dtl_pegawai_krj.NIP='$nip'
	ORDER BY dt_dtl_kerja.status DESC
	");
	$cek = mysql_num_rows($q);
	$tmp = 0;
	if($cek == 0)	{
		$cc = 1;
	} else	{
		while($qq = mysql_fetch_array($q))	{ ?>
			
			<?php if($tmp != $qq[0])	{ ?>
				<div class="fix-list-group list-group-flush small">

					<a href="#" class="list-group-item list-group-item-action klikpks" data-toggle="modal" data-target="#myModal2" data-backdrop="false" data-id="<?= $qq[0]; ?>" data-name="<?= $qq[1]; ?>">
					  <div class="media">
						<i class="fa fa-circle fa-lg mr-2 mt-1" aria-hidden="true"></i>
						<div class="media-body">
						  <strong><?= $qq[1]; ?></strong>
						  <div class="smaller">Target Selesai : <?= $qq[2]; ?></div>
						</div>
					  </div>
					</a>

				</div>
			<?php } ?>

		<?php $tmp = $qq[0];
		}
	}
	
} elseif($get == 5)	{
	
	$q = mysql_query("
	SELECT
	dt_kerja.id_kerja, dt_kerja.nama_kerja, dt_kerja.tgl_target_selesai
	FROM dt_kerja
	WHERE dt_kerja.tgl_mulai>'$dtnw'
	AND dt_kerja.status='0'
	AND  dt_kerja.NIP='$nip'
	");
	$cek = mysql_num_rows($q);

	if($cek == 0)	{
		$cc = 1;
	} else	{
		while($qq = mysql_fetch_array($q))	{ ?>

			<div class="fix-list-group list-group-flush small">

				<a href="#" class="list-group-item list-group-item-action klikpks" data-toggle="modal" data-target="#myModal2" data-backdrop="false" data-id="<?= $qq[0]; ?>" data-name="<?= $qq[1]; ?>">
				  <div class="media">
					<i class="fa fa-circle fa-lg mr-2 mt-1" aria-hidden="true"></i>
					<div class="media-body">
					  <strong><?= $qq[1]; ?></strong>
					  <div class="smaller">Target Selesai : <?= $qq[2]; ?></div>
					</div>
				  </div>
				</a>

			</div>

		<?php }
	}
	
} elseif($get == 6)	{
	
	$q = mysql_query("
	SELECT
	dt_kerja.id_kerja, dt_kerja.nama_kerja, dt_kerja.tgl_target_selesai, dt_dtl_kerja.status
	FROM dt_kerja
	JOIN dt_dtl_kerja ON dt_kerja.id_kerja = dt_dtl_kerja.id_kerja
	JOIN dt_dtl_pegawai_krj ON dt_dtl_kerja.id_dtl_kerja = dt_dtl_pegawai_krj.id_dtl_kerja
	WHERE dt_dtl_kerja.status='3'
	AND dt_dtl_pegawai_krj.NIP='$nip'
	");
	$cek = mysql_num_rows($q);
	$tmp = 0;
	if($cek == 0)	{
		$cc = 1;
	} else	{
		while($qq = mysql_fetch_array($q))	{ ?>
			
			<?php if($tmp != $qq[0])	{ ?>
				<div class="fix-list-group list-group-flush small">

					<a href="#" class="list-group-item list-group-item-action klikpks" data-toggle="modal" data-target="#myModal2" data-backdrop="false" data-id="<?= $qq[0]; ?>" data-name="<?= $qq[1]; ?>">
					  <div class="media">
						<i class="fa fa-circle fa-lg mr-2 mt-1" aria-hidden="true"></i>
						<div class="media-body">
						  <strong><?= $qq[1]; ?><?php if($qq[3] == 2)	{ echo ' - <span class="text-danger">Perlu Revisi</span>'; } ?></strong>
						  <div class="smaller">Target Selesai : <?= $qq[2]; ?></div>
						</div>
					  </div>
					</a>

				</div>
			<?php } ?>

		<?php $tmp = $qq[0];
		}
	}
	
} elseif($get == 7)	{
	
	$q = mysql_query("
	SELECT
	dt_kerja.id_kerja, dt_kerja.nama_kerja, dt_kerja.tgl_target_selesai
	FROM dt_kerja
	WHERE dt_kerja.status='1'
	AND  dt_kerja.NIP='$nip'
	");
	$cek = mysql_num_rows($q);

	if($cek == 0)	{
		$cc = 1;
	} else	{
		while($qq = mysql_fetch_array($q))	{ ?>

			<div class="fix-list-group list-group-flush small">

				<a href="#" class="list-group-item list-group-item-action klikpks" data-toggle="modal" data-target="#myModal2" data-backdrop="false" data-id="<?= $qq[0]; ?>" data-name="<?= $qq[1]; ?>">
				  <div class="media">
					<i class="fa fa-circle fa-lg mr-2 mt-1" aria-hidden="true"></i>
					<div class="media-body">
					  <strong><?= $qq[1]; ?></strong>
					  <div class="smaller">Target Selesai : <?= $qq[2]; ?></div>
					</div>
				  </div>
				</a>

			</div>

		<?php }
	}
	
} elseif($get == 8)	{
	
	$q = mysql_query("
	SELECT
	dt_kerja.id_kerja, dt_kerja.nama_kerja, dt_kerja.tgl_target_selesai
	FROM dt_kerja
	JOIN dt_dtl_kerja ON dt_kerja.id_kerja = dt_dtl_kerja.id_kerja
	JOIN dt_dtl_pegawai_krj ON dt_dtl_kerja.id_dtl_kerja = dt_dtl_pegawai_krj.id_dtl_kerja
	WHERE dt_kerja.tgl_mulai<='$dtnw'
	AND dt_kerja.status='0'
	");
	$cek = mysql_num_rows($q);
	$tmp = 0;
	if($cek == 0)	{
		$cc = 1;
	} else	{
		while($qq = mysql_fetch_array($q))	{ ?>

			<?php if($tmp != $qq[0])	{ ?>
				<div class="fix-list-group list-group-flush small">

					<a href="#" class="list-group-item list-group-item-action klikpks" data-toggle="modal" data-target="#myModal2" data-backdrop="false" data-id="<?= $qq[0]; ?>" data-name="<?= $qq[1]; ?>">
					  <div class="media">
						<i class="fa fa-circle fa-lg mr-2 mt-1" aria-hidden="true"></i>
						<div class="media-body">
						  <strong><?= $qq[1]; ?></strong>
						  <div class="smaller">Target Selesai : <?= $qq[2]; ?></div>
						</div>
					  </div>
					</a>

				</div>
			<?php } ?>

		<?php $tmp = $qq[0];
		}
	}
	
} elseif($get == 9)	{
	
	$q = mysql_query("
	SELECT
	dt_kerja.id_kerja, dt_kerja.nama_kerja, dt_kerja.tgl_target_selesai
	FROM dt_kerja
	JOIN dt_dtl_kerja ON dt_kerja.id_kerja = dt_dtl_kerja.id_kerja
	JOIN dt_dtl_pegawai_krj ON dt_dtl_kerja.id_dtl_kerja = dt_dtl_pegawai_krj.id_dtl_kerja
	WHERE dt_kerja.tgl_mulai>'$dtnw'
	AND dt_kerja.status='0'
	");
	$cek = mysql_num_rows($q);
	$tmp = 0;
	if($cek == 0)	{
		$cc = 1;
	} else	{
		while($qq = mysql_fetch_array($q))	{ ?>

			<?php if($tmp != $qq[0])	{ ?>
				<div class="fix-list-group list-group-flush small">

					<a href="#" class="list-group-item list-group-item-action klikpks" data-toggle="modal" data-target="#myModal2" data-backdrop="false" data-id="<?= $qq[0]; ?>" data-name="<?= $qq[1]; ?>">
					  <div class="media">
						<i class="fa fa-circle fa-lg mr-2 mt-1" aria-hidden="true"></i>
						<div class="media-body">
						  <strong><?= $qq[1]; ?></strong>
						  <div class="smaller">Target Selesai : <?= $qq[2]; ?></div>
						</div>
					  </div>
					</a>

				</div>
			<?php } ?>

		<?php $tmp = $qq[0];
		}
	}
	
} elseif($get == 10)	{
	
	$q = mysql_query("
	SELECT
	dt_kerja.id_kerja, dt_kerja.nama_kerja, dt_kerja.tgl_target_selesai
	FROM dt_kerja
	JOIN dt_dtl_kerja ON dt_kerja.id_kerja = dt_dtl_kerja.id_kerja
	JOIN dt_dtl_pegawai_krj ON dt_dtl_kerja.id_dtl_kerja = dt_dtl_pegawai_krj.id_dtl_kerja
	WHERE dt_kerja.status='1'
	");
	$cek = mysql_num_rows($q);
	$tmp = 0;
	if($cek == 0)	{
		$cc = 1;
	} else	{
		while($qq = mysql_fetch_array($q))	{ ?>

			<?php if($tmp != $qq[0])	{ ?>
				<div class="fix-list-group list-group-flush small">

					<a href="#" class="list-group-item list-group-item-action klikpks" data-toggle="modal" data-target="#myModal2" data-backdrop="false" data-id="<?= $qq[0]; ?>" data-name="<?= $qq[1]; ?>">
					  <div class="media">
						<i class="fa fa-circle fa-lg mr-2 mt-1" aria-hidden="true"></i>
						<div class="media-body">
						  <strong><?= $qq[1]; ?></strong>
						  <div class="smaller">Target Selesai : <?= $qq[2]; ?></div>
						</div>
					  </div>
					</a>

				</div>
			<?php } ?>

		<?php $tmp = $qq[0];
		}
	}
	
}

if($cc==1)	{ ?>
<div class="middles text-muted">
	<center><i class="fa fa-times-circle fa-4x" aria-hidden="true"></i><br></center>
	<label class="small"><strong>Tidak Ada Pekerjaan</strong></label>
</div>
<?php }
?>