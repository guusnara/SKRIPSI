<?php session_start(); include '../incdo/config.php'; include '../incdo/functionfile.php';

$id = $_GET['id']; $sn = ''; $tmpsn = 0;
if(isset($_SESSION['pegawai']['NIP']) || !empty($_SESSION['pegawai']['NIP'])) $nip = $_SESSION['pegawai']['NIP']; else $nip = 0; ?>

<ul class="nav nav-tabs mb-2" id="myTab" role="tablist">
  <li class="nav-item">
  	<a class="nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-expanded="true"><strong>Detail Kerja</strong></a>
  </li>
  <li class="nav-item">
  	<a class="nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile"><strong>Anggota Kerja</strong></a>
  </li>
</ul>
<div class="tab-content" id="nav-tabContent">
	<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
  		
		<div class="card <?php //text-white ?> bg-info fixcard">
		  	<div class="card-header">
		  		Detail Tugas
		  	</div>
		  	<div class="card-body text-dark small" style="background-color: #fff;">
		  		<?php
					$b = mysql_fetch_array(mysql_query("SELECT 
					dt_kerja.id_kerja, dt_kerja.nama_kerja,
					dt_kerja.NIP, dt_pegawai.nama_pegawai, 
					dt_kerja.ket, 
					dt_kerja.id_berkas,
					dt_kerja.tgl_mulai, dt_kerja.tgl_target_selesai, dt_kerja.status
					FROM dt_kerja
					JOIN dt_pegawai ON dt_kerja.NIP = dt_pegawai.NIP
					WHERE id_kerja='$id'"));
					
					$idkoor = $b[2];
				?>
		  		<?php $cm = mysql_query("select id_dtl_kerja from dt_dtl_kerja where id_kerja='$id' and status<'3'");
				if(mysql_num_rows($cm) == 0 && $idkoor == $nip && $b[8] == 0)	{ ?>
		  		<div class="mb-1">
					<button class="btn btn-success btn-sm" data-toggle="modal" data-target="#selesaidonex" data-idkrjg="<?= $b[0]; ?>">Project Selesai</button>
				</div>
				<?php } ?>
				<?php if($idkoor == $nip && $b[8] != 1)	{ ?>
		  		<div class="mb-1">
					<button class="btn btn-success btn-sm" id="klkpd" data-toggle="modal" data-target="#exampleModalLonged" data-idkrjgxz="<?= $b[0]; ?>" data-namke="<?= $b[1]; ?>" data-kete="<?= $b[4]; ?>" data-idber="<?= $b[5]; ?>" data-tgl1z="<?= $b[6]; ?>" data-tgl2z="<?= $b[7]; ?>" data-idnip="<?= $idkoor; ?>">Perbaharui Data Project</button>
				</div>
				<?php } ?>
				<div class="row">
					<div class="col-md-12"><strong>Pembuat Project (Koordinator) :</strong></div>
					<div class="col-md-12 mb-2"><?= $b[3]; ?></div>
					<div class="col-md-12"><strong>Keterangan :</strong></div>
					<div class="col-md-12 mb-2"><?= $b[4]; ?></div>
					<div class="col-md-12"><strong>Data Unggahan :</strong></div>
					<?php if($b[5] == 0 || $b[5] == '')	{ ?>
						<div class="col-md-12">Tidak ada data</div>
					<?php } else	{
						$c = mysql_fetch_array(mysql_query("select nama_berkas, url_berkas, ukuran_berkas, tipe_berkas from dt_berkas where id_berkas='$b[5]'"))?>
						<div class="col-md-4">
							<div class="fix-list-group list-group-flush small">
								<a href="pegawaidb/<?= $c[1]; ?>" class="list-group-item list-group-item-action">
								  <div class="media">
									<?= formatfile($c[3]); ?>
									<div class="media-body">
									  <strong><?= $c[0]; ?></strong>
									  <div class="text-muted smaller"><?= $c[2]; ?> mb</div>
									</div>
								  </div>
								</a>
							</div>
						</div>
					<?php } ?>
				</div>
		  	</div>
		</div>
		<div class="card <?php //text-white ?> bg-primary">
		  	<div class="card-header">
		  		Tugas Anggota
		  	</div>
		  	<?php if($idkoor == $nip  && $b[8] == 0)	{ ?>
		  	<div class="card-body text-dark" style="background-color: #fff;">
		  		<button class="btn btn-success btn-sm" data-toggle="modal" data-target="#exampleModalLongw" data-id="<?= $id; ?>" data-dtpro="<?= $b[6]; ?>" data-dtpro2="<?= $b[7]; ?>">Tambah Anggota & Tugas</button>
		  	</div>
		  	<?php } ?>
		  	<ul class="list-group list-group-flush text-dark">
		  	<?php $s = mysql_query("SELECT * from dt_dtl_kerja join dt_dtl_pegawai_krj on dt_dtl_kerja.id_dtl_kerja = dt_dtl_pegawai_krj.id_dtl_kerja where dt_dtl_kerja.id_kerja='$id' order by case when dt_dtl_pegawai_krj.NIP='$nip' then 1 else 2 end");
			while($ss = mysql_fetch_array($s))	{ ?>
				<li class="list-group-item">
					<div class="media small">
						<i class="fa fa-user fa-lg mr-2 mt-1" aria-hidden="true"></i>
						<div class="media-body">
							<strong>
								<?php $no=1; $d = mysql_query("SELECT dt_dtl_pegawai_krj.NIP, dt_pegawai.nama_pegawai from dt_dtl_pegawai_krj join dt_pegawai on dt_dtl_pegawai_krj.NIP = dt_pegawai.NIP where dt_dtl_pegawai_krj.id_dtl_kerja='$ss[0]'");
								$cex = mysql_num_rows($d);
								$sn = 0;
								$snb = 0;
								$forn = '';
								while($dd = mysql_fetch_array($d))	{
									if($dd[0] == $nip) {
										$sn = 1; 
										$snb = 1;
										$tmpsn+=1;
									}
									if($no != $cex)	{
										if($sn == 1)	{
											$forn .= 'Anda, ';
										} else
											$forn .= $dd[1].', ';
									} else	{
										if($sn == 1)	{
											$forn .= 'Anda';
										} else
											$forn .= $dd[1];
									}
									// not compatible for more than 1 anggota
									$tmpNama = $dd[1];
									$tmpNIP = $dd[0];
									
									$snb = 0;
									$no++;
								} echo $forn; ?>
								<?php if($ss[7] == 0 && $ss[4] < date("Y-m-d")) {
									echo '<span class="badge badge-danger ml-1 p-1">Tugas Melewati Target</span>';
								} elseif($ss[7] == 2 && $ss[4] < date("Y-m-d")) {
									echo '<span class="badge badge-danger ml-1 p-1">Tugas Melewati Target</span>';
								} ?>
							</strong>
							<div><?= $ss[2]; ?></div>
							
							<?php if($idkoor == $nip && $b[8] != 1)	{ // PERBAHARUI TUGAS ?>
							<div class="mt-1">
								<button class="btn btn-success btn-sm" data-toggle="modal" data-target="#exampleModaltgs" data-tgsidkrj="<?= $id; ?>" data-tgsiddtl="<?= $ss[0]; ?>" data-tgsnip="<?= $tmpNIP; ?>" data-tgsnm="<?= $tmpNama; ?>" data-tgsket="<?= $ss[2]; ?>" data-tgstgl1="<?= $ss[3]; ?>" data-tgstgl2="<?= $ss[4]; ?>">Perbaharui Tugas</button>
							</div>
							<?php } ?>
							
							<?php if($ss[3] <= date("Y-m-d"))	{ ?>
							<div class="mt-1">
								<?php if($ss[7] == 0 || $ss[7] == 2)	{ ?>
								<?php if($ss[6] == 100) $m='display: none;'; else $m='display: inline-block;';?>
								<?php if($sn==1)	{ ?>
									<input class="slide" type="text" data-slider-id='clrslider' data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="<?= $ss[6]; ?>" value="<?= $ss[6]; ?>">
								<?php } ?>
								<?php } ?>
								<strong>
								<?php if($sn==1)	{ ?>
									<?php if($ss[7] == 0 || $ss[7] == 2)	{ ?>
									<span class="mr-2"></span>
									<a style="<?= $m; ?>" class="btn btn-success btn-sm sldup" iddtl="<?= $ss[0]; ?>" persen="<?= $ss[6]; ?>" href="#" role="button">Update Persentase</a>
									<br>
									<?php } ?>
								<?php } ?>Perkembangan Kerja : <span class="vslide"><?= $ss[6]; ?></span> %
								
								<?php if($ss[7] == 0 || $ss[7] == 2)	{ ?>
								<?php if($ss[6] == 100) $r='display: block;'; else $r='display: none;';?>
								<div class="opns mt-1" style="<?= $r; ?>">
									<?php $fek = mysql_query("select * from dt_revisi_kerja where id_dtl_kerja='$ss[0]' and status='0'"); 
									if(mysql_num_rows($fek) > 0) {$wd = mysql_fetch_array($fek); $wdo = $wd[0];} else $wdo = 0; ?>
									<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleModalLongwx" data-iddtlz="<?= $ss[0]; ?>" data-idkrjz="<?= $id; ?>" data-nipc="<?= $nip; ?>" data-sts="<?= $ss[7]; ?>" data-rev="<?= $wdo; ?>">Unggah Data</button>
									<a class="btn btn-success btn-sm sldsls" iddtls="<?= $ss[0]; ?>" revs="<?= $wdo; ?>" idkrjs="<?= $id; ?>" href="#" role="button">Selesai</a>
								</div>
								<?php } ?>
								</strong>
							</div>
							<?php } ?>
							
							<div class="mt-1"><strong>Mulai Tugas : <?= $ss[3]; ?></strong></div>
							<div class="mt-1"><strong>Target Selesai : <?= $ss[4]; ?></strong></div>
							<?php if($ss[7] == 3)	{ ?>
								<div class="mt-1"><strong>Selesai : <?= $ss[5]; ?></strong></div>
							<?php } ?>
							
							<?php if($ss[7] == 1 || $ss[7] == 3 || $ss[7] == 2 && $sn == 1)	{ ?>
								<div class="small mt-1"><strong>Data Unggahan :</strong></div>
								<?php $bn = mysql_query("SELECT dt_dtl_brks_krj.id_dtl_brks_krj, dt_dtl_brks_krj.id_berkas, dt_berkas.nama_berkas, dt_berkas.ukuran_berkas, dt_berkas.url_berkas, dt_berkas.tipe_berkas
								FROM dt_dtl_brks_krj
								JOIN dt_berkas ON dt_dtl_brks_krj.id_berkas = dt_berkas.id_berkas
								WHERE dt_dtl_brks_krj.id_dtl_kerja = '$ss[0]'");
								
								$ceks = mysql_query("select * FROM dt_dtl_brks_krj WHERE id_dtl_kerja = '$ss[0]'");

								if(mysql_num_rows($ceks) == 0)	{ ?>
								<div class="small mt-1"><strong>Tidak ada data</strong></div>
								<?php } elseif(mysql_num_rows($bn) == 0)	{ ?>
								<div class="small text-danger mt-1"><strong>Data tidak ditemukan atau telah dihapus oleh administrator.</strong></div>
								<?php } else { ?>
								<div class="row">
									<?php while($bnn = mysql_fetch_array($bn))	{ ?>
									<div class="col-md-4">
										<div class="fix-list-group list-group-flush small">
											<a href="pegawaidb/<?= $bnn[4]; ?>" class="list-group-item list-group-item-action">
											  <div class="media">
												<?= formatfile($bnn[5]); ?>
												<div class="media-body">
												  <strong><?= $bnn[2]; ?></strong>
												  <div class="text-muted smaller"><?= $bnn[3]; ?> mb</div>
												</div>
											  </div>
											</a>
										</div>
									</div>
									<?php } ?>
								</div>
								<?php } ?>
							<?php } ?>
							
							<?php if($ss[3] > date("Y-m-d")) {
									$sd='Menunggu Periode Pengerjaan';
							} else	{
									if($ss[7]==0) $sd='Sedang Dikerjakan';
									elseif($ss[7]==1) $sd='Menunggu Hasil Dari Koordinator';
									elseif($ss[7]==2) $sd='Perlu Revisi';
									else $sd='Selesai';
							} ?>
							<div class="mt-1"><strong>Status Tugas : <?= $sd; ?></strong></div>
							
							<?php if($ss[7] == 2)	{ ?>
							<?php $fek = mysql_query("select * from dt_revisi_kerja where id_dtl_kerja='$ss[0]' and status='0'");
							if(mysql_num_rows($fek) > 0)	{
								$fks = mysql_fetch_array($fek); ?>
								<div class="mt-1">
									<strong>Keterangan Revisi :</strong>
									<div class="alert alert-warning mt-1" role="alert">
									  <?= $fks[2]; ?>
									</div>
								</div>
							<?php } ?>
							<?php } ?>
							
							<?php if($ss[7] == 1 && $idkoor == $nip)	{ ?>
							<div class="mt-1">
								<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#exampleModals" data-iddtlm="<?= $ss[0]; ?>" data-fornm="<?= $forn; ?>" data-idkrjm="<?= $id; ?>">Revisi Tugas</button>
								<a class="btn btn-success btn-sm slsall" iddtlb="<?= $ss[0]; ?>" idkrjb="<?= $id; ?>" href="#" role="button">Selesai</a>
							</div>
							<?php } ?>
						</div>
				  	</div>
				</li>
			<?php } ?>
		  	</ul>
		</div>
		
  	</div>
  	
  	<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
  		<div class="card" style="overflow-y: auto;">
  			<div class="list-group list-group-flush">
  				<?php $a = mysql_query("
				SELECT dt_pegawai.NIP, dt_pegawai.nama_pegawai, dt_pegawai.id_bidang, dt_pegawai.id_jabatan, dt_pegawai.jk, dt_pegawai.alamat, dt_pegawai.no_telp, dt_pegawai.email, dt_pegawai.url_photo, dt_jabatan.nama_jabatan
				FROM dt_dtl_pegawai_krj
				JOIN dt_pegawai ON dt_dtl_pegawai_krj.NIP = dt_pegawai.NIP
				JOIN dt_dtl_kerja ON dt_dtl_pegawai_krj.id_dtl_kerja = dt_dtl_kerja.id_dtl_kerja
				JOIN dt_kerja ON dt_dtl_kerja.id_kerja = dt_kerja.id_kerja
				JOIN dt_jabatan ON dt_pegawai.id_jabatan = dt_jabatan.id_jabatan
				WHERE dt_kerja.id_kerja = '$id'
				ORDER BY dt_dtl_pegawai_krj.NIP ASC
				");
				$tmp = '';
				while($b = mysql_fetch_array($a))	{
					if($tmp != $b[0])	{ ?>
						<?php $dt = 'data-nip="'.$b[0].'" data-nm="'.$b[1].'" data-bidang="'.$b[2].'" data-jabatan="'.$b[3].'" data-jk="'.$b[4].'" data-alamat="'.$b[5].'" data-tlp="'.$b[6].'" data-email="'.$b[7].'" data-url="'.$b[8].'"'; ?>

						<button type="button" class="list-group-item list-group-item-action" data-toggle="modal" data-target="#exampleView" <?= $dt ?> data-backdrop="static">
						  <div class="media">
							<img class="img-fluid mr-3" width="100" src="pegawaidb/<?= $b[8]; ?>" alt="image">
							<div class="media-body align-self-center">
								<strong><?= $b[1]; ?></strong>
								<div class="text-muted small"><?= $b[9]; ?></div>
							</div>
						  </div>
						</button>
					<?php }
					$tmp = $b[0];
				} ?>
			</div>
		</div>
  	</div>
</div>
<?php if($tmpsn>0)	{ ?>
<script>
$(document).ready(function(){
	$(".slide").slider({
		formatter: function(value) {
			return 'Current value: ' + value;
		}
	});

	$(".slide").on("slide", function(slideEvt) {
		$(this).next().find(".vslide").text(slideEvt.value);
		$(this).next().find(".sldup").attr("persen",slideEvt.value);
		$(this).next().find(".sldsls").attr("persens",slideEvt.value);
		if(slideEvt.value == 100)	{
			$(this).next().find(".opns").show();
			$(this).next().find(".sldup").hide();
		} else	{
			$(this).next().find(".opns").hide();
			$(this).next().find(".sldup").show();
		}
	});
	
	$('a.sldup').click(function (event){ 
		event.preventDefault();
		toastr.clear();
		var iddtlc = $(this).attr('iddtl');
		var persen = $(this).attr('persen');
		var data = new FormData();
			data.append('var1', iddtlc);
			data.append('var2', persen);
		
		$.ajax('incdo/doaddkerja.php?do=persen', {
				method: "POST",
				data: data,
				processData: false,
				contentType: false,
				dataType: "json",
				beforeSend: function(e) {
					if(e && e.overrideMimeType) {
						e.overrideMimeType("application/json;charset=UTF-8");
					}
				},
				success: function(response){
					if(response.status=='ok'){
						//alert(response.pesan);
						toastr.success(response.pesan,"Sukses !");
					} else	{
						//alert(response.pesan);
						toastr.error(response.pesan,"Kesalahan !");
					}
				},
				error: function(xhr,err){
					alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n\n1:loading, 2:loaded, 3:interactive, 4:complete.\n404: not found, 500: server error, 200: ok.");
					alert("responseText: "+xhr.responseText);
				}
			});
	});
	
	$('a.sldsls').click(function (events){ 
		events.preventDefault();
		toastr.clear();
		var iddtlcs = $(this).attr('iddtls');
		var revs = $(this).attr('revs');
		var idkr = $(this).attr('idkrjs');
		var data = new FormData();
			data.append('var1', iddtlcs);
			data.append('var2', revs);
		
		$("#overlay").LoadingOverlay("show", {
			image       : "",
			fontawesome : "fa fa-circle-o-notch fa-spin",
			maxSize	: "50px"
		});
		$.ajax('incdo/doaddkerja.php?do=selesai', {
				method: "POST",
				data: data,
				processData: false,
				contentType: false,
				dataType: "json",
				beforeSend: function(e) {
					if(e && e.overrideMimeType) {
						e.overrideMimeType("application/json;charset=UTF-8");
					}
				},
				success: function(response){
					if(response.status=='ok'){
						//alert(response.pesan);
						toastr.success(response.pesan,"Sukses !");
						$( "#here" ).load("incpart/dtlkerja.php?id="+idkr, function() {
							//console.log('sip');
							$("#overlay").LoadingOverlay("hide"); //CONTINUE
						});
					} else	{
						//alert(response.pesan);
						toastr.error(response.pesan,"Kesalahan !");
					}
				},
				error: function(xhr,err){
					alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n\n1:loading, 2:loaded, 3:interactive, 4:complete.\n404: not found, 500: server error, 200: ok.");
					alert("responseText: "+xhr.responseText);
				}
			});
	});
});
</script>
<?php } ?>


<?php if($idkoor == $nip)	{ ?>
<script>
$(document).ready(function(){
	$('#klkpd').click(function()	{
		$("#overlaysx").LoadingOverlay("show", {
			image       : "",
			fontawesome : "fa fa-circle-o-notch fa-spin",
			maxSize	: "50px"
		});
	});
	$('a.slsall').click(function (eventt){ 
		eventt.preventDefault();
		toastr.clear();
		var iddtlb = $(this).attr('iddtlb');
		var idkrjb = $(this).attr('idkrjb');
		var data = new FormData();
			data.append('var1', iddtlb);
		
		$("#overlay").LoadingOverlay("show", {
			image       : "",
			fontawesome : "fa fa-circle-o-notch fa-spin",
			maxSize	: "50px"
		});
		$.ajax('incdo/doaddkerja.php?do=selesaiall', {
				method: "POST",
				data: data,
				processData: false,
				contentType: false,
				dataType: "json",
				beforeSend: function(e) {
					if(e && e.overrideMimeType) {
						e.overrideMimeType("application/json;charset=UTF-8");
					}
				},
				success: function(response){
					if(response.status=='ok'){
						//alert(response.pesan);
						toastr.success(response.pesan,"Sukses !");
						$( "#here" ).load("incpart/dtlkerja.php?id="+idkrjb, function() {
							//console.log('sip');
							$("#overlay").LoadingOverlay("hide"); //CONTINUE
						});
					} else	{
						//alert(response.pesan);
						toastr.error(response.pesan,"Kesalahan !");
					}
				},
				error: function(xhr,err){
					alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n\n1:loading, 2:loaded, 3:interactive, 4:complete.\n404: not found, 500: server error, 200: ok.");
					alert("responseText: "+xhr.responseText);
				}
			});
	});
});
</script>
<?php } ?>