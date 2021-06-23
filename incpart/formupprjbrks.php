<?php session_start(); include('../incdo/config.php'); include('../incdo/functionfile.php');

$idkerja = $_GET['idkerja'];
$berkas = $_GET['berkas'];
$nip = $_SESSION['pegawai']['NIP'];
$no = '';
$msb = ''; $msv = '';
		
$cv = mysql_query("SELECT dt_kerja.id_berkas, dt_berkas.nama_berkas, dt_berkas.ukuran_berkas, dt_berkas.url_berkas, dt_berkas.tipe_berkas
FROM dt_kerja
JOIN dt_berkas ON dt_kerja.id_berkas = dt_berkas.id_berkas
WHERE dt_kerja.id_kerja = '$idkerja' and dt_kerja.id_berkas = '$berkas'");

if(isset($idkerja) && isset($berkas))	{ ?>
		
		<?php $num = mysql_num_rows($cv); if($num > 0)	{ ?>
		<?php $nu = 1; while ($cvv = mysql_fetch_array($cv))	{
			if($cvv[0] > 0)	{
				$no = 1;
				$flz = /*@filesize('pegawaidb/'.$cvv[4]);*/ $cvv[2]*1048576;

				$msb .= '{caption: "'.$cvv[1].'", url: "incdo/dodelfls.php?idbrks='.$cvv[0].'&idkerja='.$idkerja.'", size: '.$flz.', width: "120px", key: '.$cvv[0].', extra: {id: '.$cvv[0].'}}';

				$msv .= '"pegawaidb/'.$cvv[3].'"';
				//$msv .= "'".formatfile2($cvv[5])."'";

				if($num != $nu) {$msv = $msv.','; $msb = $msb.',';}
			} else $no = 0;
			$nu++;
		} } ?>

		<label for="email" class="form-control-label">Perbaharui Berkas Data</label>
		<?php if($no != 0)	{ ?>
		<div class="alert alert-warning mb-2" role="alert">
  			<strong>Penting !</strong><br>
		  	<small>Hapus file yang akan di perbaharui dahulu, kemudian unggah file barunya.</small>
		</div>
		<?php } ?>
		<div class="file-loading">
		  <input id="datax" name="datax" type="file" 
				 data-validation="size" 
				 data-validation-max-size="20mb">
		</div>
		<small class="form-text text-muted">
			Hanya memilih 1 file.
		</small>

	<script>
		$(document).ready(function() {
			// dont remove this
			$("#datax").fileinput({
				theme: "fa",
				language: "id",
				showPreview: true,
				showUpload: false,
				removeClass: "btn btn-danger",
				
				
				initialPreview: [
					<?= $msv; ?>
				],
				initialPreviewAsData: true,
				initialPreviewConfig: [
					<?= $msb; ?>
				],
				deleteUrl: "/site/file-delete",
				overwriteInitial: false,
				<?php if($no != 0)	{ ?>
					initialCaption: "Data Sebelumnya",
				<?php } ?>
				preferIconicPreview: true,
				previewFileIconSettings: { // configure your icon file extensions
					'doc': '<i class="fa fa-file-word-o text-primary"></i>',
					'xls': '<i class="fa fa-file-excel-o text-success"></i>',
					'ppt': '<i class="fa fa-file-powerpoint-o text-danger"></i>',
					'pdf': '<i class="fa fa-file-pdf-o text-danger"></i>',
					'zip': '<i class="fa fa-file-archive-o text-muted"></i>',
					'htm': '<i class="fa fa-file-code-o text-info"></i>',
					'txt': '<i class="fa fa-file-text-o text-info"></i>',
					'mov': '<i class="fa fa-file-movie-o text-warning"></i>',
					'mp3': '<i class="fa fa-file-audio-o text-warning"></i>',
					// note for these file types below no extension determination logic 
					// has been configured (the keys itself will be used as extensions)
					'jpg': '<i class="fa fa-file-photo-o text-danger"></i>', 
					'gif': '<i class="fa fa-file-photo-o text-muted"></i>', 
					'png': '<i class="fa fa-file-photo-o text-primary"></i>'    
				},
				previewFileExtSettings: { // configure the logic for determining icon file extensions
					'doc': function(ext) {
						return ext.match(/(doc|docx)$/i);
					},
					'xls': function(ext) {
						return ext.match(/(xls|xlsx)$/i);
					},
					'ppt': function(ext) {
						return ext.match(/(ppt|pptx)$/i);
					},
					'zip': function(ext) {
						return ext.match(/(zip|rar|tar|gzip|gz|7z)$/i);
					},
					'htm': function(ext) {
						return ext.match(/(htm|html)$/i);
					},
					'txt': function(ext) {
						return ext.match(/(txt|ini|csv|java|php|js|css)$/i);
					},
					'mov': function(ext) {
						return ext.match(/(avi|mpg|mkv|mov|mp4|3gp|webm|wmv)$/i);
					},
					'mp3': function(ext) {
						return ext.match(/(mp3|wav)$/i);
					}
				}
				
			});

		});
	</script>
<?php } else	{
	echo 'Kesalahan, Tindakan => Refresh Page';
} ?>