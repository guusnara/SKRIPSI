<?php session_start(); include('../incdo/config.php'); include('../incdo/functionfile.php');

$stat = $_GET['sts'];
$iddtlk = $_GET['iddtl'];
$nip = $_SESSION['pegawai']['NIP'];

$cv = mysql_query("SELECT dt_dtl_brks_krj.id_dtl_brks_krj, dt_dtl_brks_krj.id_berkas, dt_berkas.nama_berkas, dt_berkas.ukuran_berkas, dt_berkas.url_berkas, dt_berkas.tipe_berkas
								FROM dt_dtl_brks_krj
								JOIN dt_berkas ON dt_dtl_brks_krj.id_berkas = dt_berkas.id_berkas
								WHERE dt_dtl_brks_krj.id_dtl_kerja = '$iddtlk'");

if(mysql_num_rows($cv) == 0 || $stat == 0 && isset($iddtlk))	{ ?>
	<div class="form-group col-md-12">
		<label for="email" class="form-control-label">Unggah Multi Berkas</label><br />
		<div class="file-loading">
		  <input id="datas" name="datas[]" type="file" 
				 data-validation="size required" 
				 data-validation-max-size="20mb" multiple>
		</div>
	</div>
	<script>
		$(document).ready(function() {
			// dont remove this
			$("#datas").fileinput({
				theme: "fa",
				language: "id",
				showPreview: true,
				showUpload: false,
				removeClass: "btn btn-danger",
				overwriteInitial: false,
				preferIconicPreview: true, // this will force thumbnails to display icons for following file extensions
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
				//uploadUrl: '/site/file-upload-single'
			});

			$.validate({
				form : '#anggx',
				modules : 'file',

				onError : function($form) {
					//alert('Kesalahan Penginputan Data, Perhatikan Kembali Data Yang Akan Dimasukkan !');
					toastr.error("Terdapat Data Yang Wajib Diisi, Perhatikan Kembali Data Yang Akan Dimasukkan","Kesalahan !");
					$("#exampleModalLongwx").scrollTop(0);
				},
				onSuccess : function($form) {
					//alert('The form is valid!');
					$("#overlayns").LoadingOverlay("show", {
						image       : "",
						fontawesome : "fa fa-circle-o-notch fa-spin",
						maxSize	: "50px"
					});
					doAddsx();
					return false; // Will stop the submission of the form
				}
			});

			function doAddsx()	{
				
				toastr.clear();
				$('#btnDtubtl').attr("disabled", true);
				$('#btnDtux').removeAttr("data-dismiss");
				$('#btnDtu').attr("disabled", true).html('Sedang Memproses <i class="fa fa-spinner fa-pulse fa-fw"></i>');

				var data = new FormData();
				var file = $("#datas")[0].files;
				var len = file.length;
				data.append('var0', len);
				for (var i = 0; i < len ; i++)	{
					//alert(file[i].name);
					data.append('var1-'+i, file[i]);
				}
				data.append('var2', $("#idkx").text());
				data.append('var3', $("#nipc").text());
				//data.append('var4', $("#statusrev").val());
				var x = $("#statusrev").val();

				var idak = $("#idkrjx").text();
				var txt = '<i class="fa fa-download" aria-hidden="true"></i> Unggah dan Selesai';
				$.ajax('incdo/doaddkerja.php?do=selesaipup&rev='+x, {
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
							$("#overlayns").LoadingOverlay("hide");
							$('#anggx').get(0).reset();
							$("#exampleModalLongwx").scrollTop(0);
							$('#exampleModalLongwx').modal('hide');
							toastr.success(response.pesan,"Sukses !");
							$('#btnDtubtl').removeAttr("disabled");
							$('#btnDtux').attr("data-dismiss","modal");
							$('#btnDtu').removeAttr("disabled").html(txt);
							setTimeout(function(){
								$("#overlay").LoadingOverlay("show", {
									image       : "",
									fontawesome : "fa fa-circle-o-notch fa-spin",
									maxSize	: "50px"
								});
								$( "#here" ).load("incpart/dtlkerja.php?id="+idak, function() {
									//console.log('sip');
									$("#overlay").LoadingOverlay("hide");
								});
							}, 500);
						} else	{
							//console.log('Upload gagal');
							//alert(response.pesan);
							$("#exampleModalLongwx").scrollTop(0);
							$("#overlayns").LoadingOverlay("hide");
							toastr.error(response.pesan,"Kesalahan !");
							$('#btnDtubtl').removeAttr("disabled");
							$('#btnDtux').attr("data-dismiss","modal");
							$('#btnDtu').removeAttr("disabled").html(txt);
						}
					},
					error: function(xhr,err){
						alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n\n1:loading, 2:loaded, 3:interactive, 4:complete.\n404: not found, 500: server error, 200: ok.");
						alert("responseText: "+xhr.responseText);
					}
				});

			}
		});
	</script>
<?php } elseif($stat == 2 && isset($iddtlk))	{ ?>
	<div class="form-group col-md-12">
		<label for="email" class="form-control-label">Multi Berkas Data</label>
		<div class="alert alert-warning mb-2" role="alert">
  			<strong>Penting !</strong><br>
		  	<small>Hapus file yang akan di perbaharui dahulu, kemudian unggah file barunya.</small>
		</div>
		<div class="file-loading">
		  <input id="datas" name="datas[]" type="file" 
				 data-validation="size required" 
				 data-validation-max-size="20mb" multiple>
		</div>
		<small class="form-text text-muted">
			Dapat memilih lebih dari 1 file.
		</small>
	</div>
	<script>
		$(document).ready(function() {
			// dont remove this
			$("#datas").fileinput({
				theme: "fa",
				language: "id",
				showPreview: true,
				showUpload: false,
				removeClass: "btn btn-danger"
				
				<?php $num = mysql_num_rows($cv); if($num > 0)	{ ?>
				<?php $msb = ''; $msv = ''; $nu = 1; while ($cvv = mysql_fetch_array($cv))	{
					$flz = /*@filesize('pegawaidb/'.$cvv[4]);*/ $cvv[3]*1048576;
					
					$msb .= '{caption: "'.$cvv[2].'", url: "incdo/dodelimg.php?iddtlbrks='.$cvv[0].'&idbrks='.$cvv[1].'", size: '.$flz.', width: "120px", key: '.$cvv[0].', extra: {id: '.$cvv[0].'}}';

					$msv .= '"pegawaidb/'.$cvv[4].'"';
					//$msv .= "'".formatfile2($cvv[5])."'";
	
					if($num != $nu) {$msv = $msv.','; $msb = $msb.',';}
					$nu++;
				} ?>
				,initialPreview: [
					<?= $msv; ?>
				],
				initialPreviewAsData: true,
				initialPreviewConfig: [
					<?= $msb; ?>
				],
				<?php } ?>
				deleteUrl: "/site/file-delete",
				overwriteInitial: false,
				initialCaption: "Data Sebelumnya",
				preferIconicPreview: false,
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
			
			//$(".file-footer-buttons a").html('<i class="fa fa-download" aria-hidden="true"></i>');

			$.validate({
				form : '#anggx',
				modules : 'file',

				onError : function($form) {
					//alert('Kesalahan Penginputan Data, Perhatikan Kembali Data Yang Akan Dimasukkan !');
					toastr.error("Terdapat Data Yang Wajib Diisi, Perhatikan Kembali Data Yang Akan Dimasukkan","Kesalahan !");
					$("#exampleModalLongwx").scrollTop(0);
				},
				onSuccess : function($form) {
					//alert('The form is valid!');
					$("#overlayns").LoadingOverlay("show", {
						image       : "",
						fontawesome : "fa fa-circle-o-notch fa-spin",
						maxSize	: "50px"
					});
					doAddsx();
					return false; // Will stop the submission of the form
				}
			});

			function doAddsx()	{

				toastr.clear();
				$('#btnDtubtl').attr("disabled", true);
				$('#btnDtux').removeAttr("data-dismiss");
				$('#btnDtu').attr("disabled", true).html('Sedang Memproses <i class="fa fa-spinner fa-pulse fa-fw"></i>');

				var data = new FormData();
				var file = $("#datas")[0].files;
				var len = file.length;
				data.append('var0', len);
				for (var i = 0; i < len ; i++)	{
					//alert(file[i].name);
					data.append('var1-'+i, file[i]);
				}
				data.append('var2', $("#idkx").text());
				data.append('var3', $("#nipc").text());
				var x = $("#statusrev").val();
				//data.append('var4', $("#statusrev").val());

				var idak = $("#idkrjx").text();
				var txt = '<i class="fa fa-download" aria-hidden="true"></i> Unggah dan Selesai';
				$.ajax('incdo/doaddkerja.php?do=selesaipup&rev='+x, {
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
							$("#overlayns").LoadingOverlay("hide");
							$('#anggx').get(0).reset();
							$("#exampleModalLongwx").scrollTop(0);
							$('#exampleModalLongwx').modal('hide');
							toastr.success(response.pesan,"Sukses !");
							$('#btnDtubtl').removeAttr("disabled");
							$('#btnDtux').attr("data-dismiss","modal");
							$('#btnDtu').removeAttr("disabled").html(txt);
							setTimeout(function(){
								$("#overlay").LoadingOverlay("show", {
									image       : "",
									fontawesome : "fa fa-circle-o-notch fa-spin",
									maxSize	: "50px"
								});
								$( "#here" ).load("incpart/dtlkerja.php?id="+idak, function() {
									//console.log('sip');
									$("#overlay").LoadingOverlay("hide");
								});
							}, 500);
						} else	{
							//console.log('Upload gagal');
							//alert(response.pesan);
							$("#exampleModalLongwx").scrollTop(0);
							$("#overlayns").LoadingOverlay("hide");
							toastr.error(response.pesan,"Kesalahan !");
							$('#btnDtubtl').removeAttr("disabled");
							$('#btnDtux').attr("data-dismiss","modal");
							$('#btnDtu').removeAttr("disabled").html(txt);
						}
					},
					error: function(xhr,err){
						alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n\n1:loading, 2:loaded, 3:interactive, 4:complete.\n404: not found, 500: server error, 200: ok.");
						alert("responseText: "+xhr.responseText);
					}
				});

			}
		});
	</script>
<?php } else	{
	echo 'Kesalahan, Tindakan => Refresh Page';
} ?>