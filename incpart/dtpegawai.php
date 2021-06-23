<?php session_start(); include('../incdo/config.php');
if(isset($_SESSION['admin']))	{
	$sts = 1;
	//echo "<script type='text/javascript'>alert('Admin');</script>";
} elseif(isset($_SESSION['pegawai']))	{
	$sts = 0;
} ?>

<?php $nip = ''; $an = ''; if(isset($_SESSION['pegawai']))	{
	$nip = $_SESSION['pegawai']['NIP'];
	$an = "order by case when dt_pegawai.NIP='$nip' then 1 else 2 end";
} elseif(isset($_SESSION['admin']))	{
	$nip = $_SESSION['admin']['id_admin'];
} ?>
<div class="animated fadeIn">
<?php if($sts != 0)	{ ?>
<div class="row">
	<div class="col-md-12">
		<button id="tmb" href="#" class="btn btn-outline-success btn-lg" data-toggle="modal" data-target="#exampleModalLong" role="button" data-backdrop="static" data-keyboard="false"><i class="fa fa-fw fa-user-plus"></i> Tambah Pegawai</button>
	</div>
</div>

<div class="mb-3"></div>
<?php } ?>

<div class="row">
<div class="col-md-12">
<div class="table-responsive">
<table class="table table-bordered table-striped table-hover" width="100%" id="dataTable" cellspacing="0">
<thead>
  <tr>
  	<th>NIP</th>
	<th>Nama Pegawai</th>
	<th>Bidang</th>
	<th>Jabatan</th>
	<th>Jenis Kelamin</th>
	<th>Aksi</th>
  </tr>
</thead>
<tbody>
<?php $a = mysql_query("select *  from dt_pegawai join dt_bidang on dt_pegawai.id_bidang=dt_bidang.id_bidang join dt_jabatan on dt_pegawai.id_jabatan=dt_jabatan.id_jabatan $an");
while($b = mysql_fetch_array($a))	{ ?>
  <tr>
	<td><?= $b[0]; ?></td>
	<td><?= $b[1]; ?></td>
	<td><?= $b[12]; ?></td>
	<td><?= $b[14]; ?></td>
	<?php if ($b[4]=='L') $jk='Laki-Laki'; else $jk='Perempuan'; ?>
	<td><?= $jk; ?></td>
	<td>
		<?php $dt = 'data-nip="'.$b[0].'" data-nm="'.$b[1].'" data-bidang="'.$b[2].'" data-jabatan="'.$b[3].'" data-jk="'.$b[4].'" data-alamat="'.$b[5].'" data-tlp="'.$b[6].'" data-email="'.$b[7].'" data-url="'.$b[8].'" data-user="'.$b[9].'"'; ?>
		
		<button class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#exampleView" <?= $dt ?> title="Info" data-backdrop="static">
			<i class="fa fa-fw fa-address-card-o"></i>
			<span class="shw-mobile"> Info</span>
		</button>
		<?php if($sts == 1 || $b[0] == $nip)	{ ?>
		<button class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleEdit" <?= $dt ?> title="Perbaharui Data" data-backdrop="static" data-keyboard="false">
			<i class="fa fa-fw fa-pencil-square-o"></i>
			<span class="shw-mobile"> Perbaharui Data</span>
		</button>
		<?php } ?>
		<?php if($sts != 0)	{ ?>
		<button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exampleDelete" data-id="<?= $b[0]; ?>" title="Hapus Data" data-backdrop="static" data-keyboard="false">
			<i class="fa fa-fw fa-trash-o"></i>
			<span class="shw-mobile"> Hapus Data</span>
		</button>
		<?php } ?>
	</td>
  </tr>
<?php } ?>
</tbody>
</table>
</div>
</div>
</div>
</div>

<script src="vendor/form-validator/jquery.form-validator.js"></script>
<link href="vendor/form-validator/theme-default.min.css" media="all" rel="stylesheet" type="text/css"/>
<link href="vendor/fileinput/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
<script src="vendor/fileinput/js/fileinput.js" type="text/javascript"></script>
<script src="vendor/fileinput/js/locales/id.js" type="text/javascript"></script>
<script src="vendor/fileinput/themes/fa/theme.js"></script>
<link  href="vendor/croppie/croppie.css" rel="stylesheet">
<script src="vendor/croppie/croppie.min.js"></script>
<script>
	$(document).ready(function(){
		$(".ext").click(function(){
			$('#add').get(0).reset();
			$('#editad').get(0).reset();
			$('#editpwd').get(0).reset();
			$('#previewv').empty();
			$('#previewv').removeAttr("style class");
			$('#previewe').empty();
			$('#previewe').removeAttr("style class");
		});
	});
</script>
<script>
  // Call the dataTables jQuery plugin
  $(document).ready(function() {
	$('#dataTable').DataTable();
  });
</script>

<?php include('loadview.php'); ?>

<!-- Modal ADD -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="Tambah Admin" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Tambah Pegawai</h5>
        <button id="btnDox" type="button" class="close ext" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="add" enctype="multipart/form-data">
      <div class="modal-body">

         <div class="form-row">
          <div class="form-group col-md-5">
            <label for="nip" class="form-control-label">NIP</label>
            <input type="text" class="form-control" name="nip" id="nip" data-validation="custom length" data-validation-regexp="^[0-9]+$" data-validation-length="18">
          </div>
          <div class="form-group col-md-7">
            <label for="pegawai" class="form-control-label">Nama Pegawai</label>
            <input type="text" class="form-control" name="pegawai" id="pegawai" data-validation="custom length" data-validation-regexp="^[A-z,.\s]+$" data-validation-length="max30">
          </div>
          <div class="form-group col-md-12">
          	  <label for="jk" class="form-control-label">Jenis Kelamin</label>
			  <div class="form-check">
				<label class="custom-control custom-radio">
				  <input id="cwo" name="jk" type="radio" class="custom-control-input" value="L" checked>
				  <span class="custom-control-indicator"></span>
				  <span class="custom-control-description">Laki-Laki</span>
				</label>
				<label class="custom-control custom-radio">
				  <input id="cwo" name="jk" type="radio" class="custom-control-input" value="P">
				  <span class="custom-control-indicator"></span>
				  <span class="custom-control-description">Perempuan</span>
				</label>
			  </div>
		  </div>
          <div class="form-group col-md-6">
            <label for="bidang" class="form-control-label">Bidang</label>
            <select class="form-control custom-select" name="bidang" id="bidang" data-validation="required">
            	<option value="">Pilih Bidang</option>
            <?php $lo = mysql_query("select * from dt_bidang");
			while($ce = mysql_fetch_array($lo))	{ ?>
			  <option value="<?= $ce[0] ?>"><?= $ce[1] ?></option>
			<?php } ?>
			</select>
          </div>
          <div class="form-group col-md-6">
            <label for="jabatan" class="form-control-label">Jabatan</label>
            <select class="form-control custom-select" name="jabatan" id="jabatan" data-validation="required">
            	<option value="">Pilih Jabatan</option>
            <?php $los = mysql_query("select * from dt_jabatan");
			while($ces = mysql_fetch_array($los))	{ ?>
			  <option value="<?= $ces[0] ?>"><?= $ces[1] ?></option>
			<?php } ?>
			</select>
          </div>
          <div class="form-group col-md-12">
            <label for="alamat" class="form-control-label">Alamat</label>
            <textarea class="form-control" id="alamat" name="alamat" rows="3" data-validation="required"></textarea>
          </div>
          <div class="form-group col-md-4">
            <label for="tlp" class="form-control-label">Nomor Telepon</label>
            <input type="text" class="form-control" name="tlp" id="tlp" data-validation="custom length" data-validation-regexp="^[0-9]+$" data-validation-length="max12">
          </div>
          <div class="form-group col-md-8">
            <label for="email" class="form-control-label">E-mail</label>
            <input type="text" class="form-control" name="email" id="email" data-validation="email">
          </div>
          <div class="form-group col-md-12">
            <label for="email" class="form-control-label">Unggah Foto</label><br />
        	<div id="previewv">
			
			</div>
         	<div class="file-loading">
			  <input id="foto" name="foto" accept=".jpg,.jpeg" type="file" 
					 data-validation="mime size required" 
					 data-validation-max-size="512kb" 
					 data-validation-allowing="jpg">
			</div>
         
          </div>
          <div class="form-group col-md-12">
            <label for="username" class="form-control-label">Username</label>
            <input type="text" class="form-control" name="username" id="username" data-validation="alphanumeric length server" data-validation-allowing="_" data-validation-length="5-16" data-validation-url="incdo/dtpegawai-cuser.php">
          </div>
          <div class="form-group col-md-6">
            <label for="pwd1" class="form-control-label">Password</label>
            <input type="password" name="pwd1" id="pwd1" class="form-control" data-validation="length" data-validation-length="min8">
          </div>
          <div class="form-group col-md-6">
            <label for="pwd2" class="form-control-label">Konfirmasi Password</label>
            <input type="password" name="pwd2" id="pwd2" class="form-control" data-validation="confirmation" data-validation-confirm="pwd1">
          </div>
		</div>
        
        
      </div>
      <div class="modal-footer">
        <button type="button" id="btnDobtl" class="btn btn-secondary ext" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Batal</button>
        <div id="btnplc"></div>
        <button type="submit" id="btnDo" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Data</button>
      </div>
      </form>
    </div>
  </div>
</div>
<script>
	$(document).ready(function(){
		$('#foto').on('change', function () { 
			var reader = new FileReader();
			reader.onload = function (e) {
				$('#previewv').empty();
				$('#previewv').attr("style", "height: 380px;").html('<div class="text-center"><label class="form-control-label"><strong>ATUR POSISI FOTO</strong></label></div>');
				$uploadCrop = $('#previewv').croppie({
					enableExif: true,
					showZoomer: true,
    				enableOrientation: false,
					viewport: {
						width: 280,
						height: 280,
						type: 'square'
					},
					boundary: {
						width: 300,
						height: 300
					}
				});
				
				$uploadCrop.croppie('bind', {
					url: e.target.result
				}).then(function(){
					console.log('jQuery bind complete');
				});

			}
			reader.readAsDataURL(this.files[0]);
		});
		
		// dont remove this
		$("#foto").fileinput({
			theme: "fa",
			language: "id",
			showPreview: false,
			showUpload: false,
			showRemove: false,
			removeClass: "btn btn-danger",
			allowedFileExtensions: ["jpg", "jpeg"]
			//uploadUrl: '/site/file-upload-single'
		});
		
		$.validate({
			form : '#add',
			modules : 'security, file',
			
			onError : function($form) {
			 	//alert('Kesalahan Penginputan Data, Perhatikan Kembali Data Yang Akan Dimasukkan !');
			 	toastr.error("Terdapat Data Yang Wajib Diisi, Perhatikan Kembali Data Yang Akan Dimasukkan","Kesalahan !");
				$("#exampleModalLong").scrollTop(0);
			},
			onSuccess : function($form) {
			  	//alert('The form is valid!');
				doAdd();
			  	return false; // Will stop the submission of the form
			}
		});
		
		function doAdd()	{
			toastr.clear();
			$uploadCrop.croppie('result', {
				type: 'canvas',
				size: 'viewport'
			}).then(function (resp) {
				$('#btnDobtl').attr("disabled", true);
				$('#btnDox').removeAttr("data-dismiss");
				$('#btnDo').attr("disabled", true).html('Sedang Memproses <i class="fa fa-spinner fa-pulse fa-fw"></i>');
				
				var data = new FormData();
				data.append('var1', $("#nip").val());
				data.append('var2', $("#pegawai").val());
				data.append('var3', $("input[name=jk]:checked").val());// JK ???
				data.append('var4', $("#bidang").val());
				data.append('var5', $("#jabatan").val());
				data.append('var6', $("#alamat").val());
				data.append('var7', $("#tlp").val());
				data.append('var8', $("#email").val());
        		data.append('var9', resp);
				data.append('var10', $("#username").val());
				data.append('var11', $("#pwd2").val());
				
				var txt = '<i class="fa fa-plus" aria-hidden="true"></i> Tambah Data';
				$.ajax('incdo/dopegawai.php?do=add', {
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
							//console.log('Upload success');
							toastr.success(response.pesan,"Sukses !");
							$('#btnDobtl').removeAttr("disabled");
							$('#btnDox').attr("data-dismiss","modal");
							$('#btnDo').removeAttr("disabled").html(txt);
							$('#exampleModalLong').modal('hide');
							setTimeout(function() {
								$('#ui-view').load("incpart/dtpegawai.php");
							}, 500);
						} else	{
							//console.log('Upload gagal');
							//alert(response.pesan);
							toastr.error(response.pesan,"Kesalahan !");
							$('#btnDobtl').removeAttr("disabled");
							$('#btnDox').attr("data-dismiss","modal");
							$('#btnDo').removeAttr("disabled").html(txt);
						}
					},
					error: function(xhr,err){
						alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n\n1:loading, 2:loaded, 3:interactive, 4:complete.\n404: not found, 500: server error, 200: ok.");
						alert("responseText: "+xhr.responseText);
					}
				});
				
			});
			
		}
	});
</script>

<?php include('loadedit.php'); ?>

<!-- Delete Modal -->
<div class="modal fade" id="exampleDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
	<div class="modal-content">
	  <div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
		<button type="button" id="btnHpsx" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
	  </div>
	  <div class="modal-body">
	   Yakin untuk menghapus data ini ?
	   <input type="hidden" name="iddel" id="iddel">
	  </div>
	  <div class="modal-footer">
		<button type="button" id="btnHpsbtl" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Batal</button>
		<button type="button" id="btnHps" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Hapus</button>
	  </div>
	</div>
  </div>
</div>
<script>
	$('#exampleDelete').on('show.bs.modal', function (event) {
	  var button = $(event.relatedTarget) // Button that triggered the modal
	  var id = button.data('id')// Extract info from data-* attributes
	  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
	  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
	  var modal = $(this)
	  modal.find('#iddel').val(id)
	});
	
	$(document).ready(function(){
		$("#btnHps").click(function(){
			toastr.clear();
			$('#btnHpsbtl').attr("disabled", true);
			$('#btnHpsx').removeAttr("data-dismiss");
			$('#btnHps').attr("disabled", true).html('Sedang Memproses <i class="fa fa-spinner fa-pulse fa-fw"></i>');
			
			var data = new FormData();
			data.append('id', $("#iddel").val());
			
			var txt = '<i class="fa fa-trash" aria-hidden="true"></i> Hapus';
			$.ajax({
				url: 'incdo/dopegawai.php?do=delete', // File tujuan
				type: 'POST', // Tentukan type nya POST atau GET
				data: data, // Set data yang akan dikirim
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
						toastr.success(response.pesan,"Sukses !");
						$('#btnHpsbtl').removeAttr("disabled");
						$('#btnHpsx').attr("data-dismiss","modal");
						$('#btnHps').removeAttr("disabled").html(txt);
						$('#exampleDelete').modal('hide');
						setTimeout(function() {
							$('#ui-view').load("incpart/dtpegawai.php");
						}, 500);
					}
					else{
						//alert(response.pesan);
						toastr.error(response.pesan,"Kesalahan !");
						$('#btnHpsbtl').removeAttr("disabled");
						$('#btnHpsx').attr("data-dismiss","modal");
						$('#btnHps').removeAttr("disabled").html(txt);
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