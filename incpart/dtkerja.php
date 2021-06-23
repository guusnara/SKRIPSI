<?php session_start();
if(isset($_SESSION['admin']))	{
	$sts = 1;
	//echo "<script type='text/javascript'>alert('Admin');</script>";
} elseif(isset($_SESSION['pegawai']))	{
	$sts = 0;
}

if(isset($_GET['to']))	{
	$to = $_GET['to'];
	include('../incdo/config.php');
} ?>
<?php 
if(isset($_SESSION['pegawai']['role']))	{
	$role = $_SESSION['pegawai']['role'];
} else	{
	$role = '';
}
?>
<div class="animated fadeIn">

<div class="row no-gutters mb-2 fulls">

<div class="col-sm-4" id="btnp">
	
	<div class="card fixcard">
	<?php if(isset($_SESSION['pegawai']))	{ $nip = $_SESSION['pegawai']['NIP']; ?>
		<button type="button" class="btn btn-block btn-success" data-toggle="modal" data-target="#exampleModalLong" role="button" data-backdrop="static" data-keyboard="false"><i class="fa fa-plus-circle" aria-hidden="true"></i> Tambah Kerja Baru</button>
	<?php } else 	{ ?>
		<style>
			.fullsx	{
				min-height: calc(100vh - 145px) !important;
				max-height: calc(100vh - 145px) !important;
			}
		</style>
	<?php } ?>
	</div>
	<div class="card fullsx fixcard" style="overflow-y: auto;">
	
		<div class="fix-list-group list-group-flush small" id="rmcl">
			
			<?php if($sts == 1 || $role == 1)	{ ?>
			<button type="button" class="list-group-item list-group-item-action" id="pk8">
				  <div class="media">
					<i class="fa fa-play-circle fa-3x mr-2" aria-hidden="true"></i>
					<div class="media-body align-self-center">
						<strong>Project Berlangsung</strong>
					</div>
				  </div>
			</button>
			<button type="button" class="list-group-item list-group-item-action" id="pk9">
				  <div class="media">
					<i class="fa fa-pause-circle fa-3x mr-2" aria-hidden="true"></i>
					<div class="media-body align-self-center">
						<strong>Project Belum Berlangsung</strong>
					</div>
				  </div>
			</button>
			<button type="button" class="list-group-item list-group-item-action" id="pk10">
				  <div class="media">
					<i class="fa fa-check-circle fa-3x mr-2" aria-hidden="true"></i>
					<div class="media-body align-self-center">
						<strong>Project Selesai</strong>
					</div>
				  </div>
			</button>
			<?php } ?>
			<?php if($sts == 0)	{ ?>
			<?php if($role != 1)	{ ?>
			<button type="button" class="list-group-item list-group-item-action" id="pk1">
				  <div class="media">
				  <i class="fa fa-play-circle fa-3x mr-2" aria-hidden="true"></i>
					<div class="media-body align-self-center">
						<strong>Tugas Project Sedang Berjalan</strong>
					</div>
				  </div>
			</button>
			<?php } ?>
			<button type="button" class="list-group-item list-group-item-action" id="pk2">
				  <div class="media">
				  <i class="fa fa-info-circle fa-3x mr-2" aria-hidden="true"></i>
					<div class="media-body align-self-center">
						<strong>Info Koor Project Berjalan</strong>
					</div>
				  </div>
			</button>
			<?php if($role != 1)	{ ?>
			<button type="button" class="list-group-item list-group-item-action" id="pk3">
				  <div class="media">
				  	<i class="fa fa-info-circle fa-3x mr-2" aria-hidden="true"></i>
					<div class="media-body align-self-center">
						<strong>Tugas Project Menunggu Revisi</strong>
					</div>
				  </div>
			</button>
			<button type="button" class="list-group-item list-group-item-action" id="pk4">
				  <div class="media">
					<i class="fa fa-pause-circle fa-3x mr-2" aria-hidden="true"></i>
					<div class="media-body align-self-center">
						<strong>Tugas Project Menunggu Waktu Berjalan</strong>
					</div>
				  </div>
			</button>
			<?php } ?>
			<button type="button" class="list-group-item list-group-item-action" id="pk5">
				  <div class="media">
					<i class="fa fa-pause-circle fa-3x mr-2" aria-hidden="true"></i>
					<div class="media-body align-self-center">
						<strong>Koor Project Menunggu Waktu Berjalan</strong>
					</div>
				  </div>
			</button>
			<?php if($role != 1)	{ ?>
			<button type="button" class="list-group-item list-group-item-action" id="pk6">
				  <div class="media">
					<i class="fa fa-check-circle fa-3x mr-2" aria-hidden="true"></i>
					<div class="media-body align-self-center">
						<strong>Tugas Project Telah Selesai</strong>
					</div>
				  </div>
			</button>
			<?php } ?>
			<button type="button" class="list-group-item list-group-item-action" id="pk7">
				  <div class="media">
					<i class="fa fa-check-circle fa-3x mr-2" aria-hidden="true"></i>
					<div class="media-body align-self-center">
						<strong>Koor Project Telah Selesai</strong>
					</div>
				  </div>
			</button>
			<?php } ?>
			
		</div>
		
	</div>
	
</div>
<!-- include loadpk.php -->
<div class="col-sm-8" id="listp">
		
	<div class="card fixcard">
		<div class="card-header">
			<button id="backbtn" style="left: 0; top: 0; position: absolute; margin-top: 0; padding: 6px 15px 6px 13px;" class="btn btn-x mobile-back"></span><i class="fa fa-angle-left fa-2x" aria-hidden="true"></i></button>
			<span class="mobile-back" style="margin-left: 20px;"></span>
			<i class="fa fa-list-ol" aria-hidden="true"></i> <strong>List Pekerjaan</strong>
		</div>
	</div>
	<div class="card fulls" style="overflow-y: auto;" id="loadpk">
	</div>	
	
</div>

</div>

</div>

<?php if($sts == 0)	{ ?>
<script src="vendor/form-validator/jquery.form-validator.js"></script>
<link href="vendor/form-validator/theme-default.min.css" media="all" rel="stylesheet" type="text/css"/>

<link href="vendor/fileinput/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
<script src="vendor/fileinput/js/fileinput.js" type="text/javascript"></script>
<script src="vendor/fileinput/js/locales/id.js" type="text/javascript"></script>
<script src="vendor/fileinput/themes/fa/theme.js"></script>

<link href="vendor/date/css/bootstrap-datepicker3.min.css" rel="stylesheet" />
<script src="vendor/date/js/bootstrap-datepicker.min.js"></script>

<link href="vendor/slider/css/bootstrap-slider.css" rel="stylesheet" type="text/css"/>
<script src="vendor/slider/bootstrap-slider.js"></script>
<?php } ?>

<link href="vendor/select2/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="vendor/select2/css/select2-CoreUI.min.css">
<script src="vendor/select2/js/select2.min.js"></script>

<?php include('loadview.php'); ?>

<script>
	$(document).ready(function(){
		//alert($(window).width());
		if($(window).width() < 576)	{
			$('#listp').hide();
			$("#rmcl button").click(function(){
				$('#btnp').slideUp(200);
				$('#listp').slideDown(200);
			});
			$("#backbtn").click(function(){
				$('#btnp').slideDown(200);
				$('#listp').slideUp(200);
			});
		}
		
		$.fn.select2.defaults.set( "theme", "bootstrap" );
		$('#hidemsg').hide();
		$('#hidemsge').hide();
		$('#hidemsgep').hide();
		$(".ext").click(function(){
			$('select#nip').find('option').remove().end();
			$('#addp').get(0).reset();
			$("#overlays").LoadingOverlay("hide");
			$('#angg').get(0).reset();
			$("#overlayn").LoadingOverlay("hide");
			$('#anggx').get(0).reset();
			$("#overlayns").LoadingOverlay("hide");
			$('#anggx2').get(0).reset();
			$("#overlayns2").LoadingOverlay("hide");
			$('#addpx').get(0).reset();
			$("#overlaysx").LoadingOverlay("hide");
			$('#anggu').get(0).reset();
			$("#overlayu").LoadingOverlay("hide");
			$('#setnama').html('Nama Anggota');
			$('#idu').html('');
		});
		
		$("#loadpk").LoadingOverlay("show", {
			image       : "",
			fontawesome : "fa fa-circle-o-notch fa-spin",
			maxSize	: "50px"
		});
		
		<?php if(isset($_GET['to']))	{
			if($to == 7)	{ ?>
				$("#rmcl button").removeClass("active");
				$("#pk7").addClass("active");
				$( "#loadpk" ).load("incpart/loadpk.php?pk=7", function() {
					//console.log('sip');
					$("#loadpk").LoadingOverlay("hide");
				});
			<?php } ?>
		<?php } else	{
			if($sts == 0)	{?>
				$("#pk1").addClass("active");
				$( "#loadpk" ).load("incpart/loadpk.php?pk=1", function() {
					//console.log('sip');
					$("#loadpk").LoadingOverlay("hide");
				});
			<?php }
			elseif($sts == 1 || $role == 1)	{ ?>
				$("#pk8").addClass("active");
				$( "#loadpk" ).load("incpart/loadpk.php?pk=8", function() {
					//console.log('sip');
					$("#loadpk").LoadingOverlay("hide");
				});
			<?php } ?>
		<?php } ?>
		
		<?php if($sts == 1 || $role == 1)	{ ?>
		
		$("#pk8, #pk9, #pk10").click(function(){
			$("#rmcl button").removeClass("active");
			$("#loadpk").LoadingOverlay("show", {
				image       : "",
				fontawesome : "fa fa-circle-o-notch fa-spin",
				maxSize	: "50px"
			});
		})
		
		$("#pk8").click(function(){
			$("#pk8").addClass("active");
			$( "#loadpk" ).load("incpart/loadpk.php?pk=8", function() {
				//console.log('sip');
				$("#loadpk").LoadingOverlay("hide");
			});
		});
		$("#pk9").click(function(){
			$("#pk9").addClass("active");
			$( "#loadpk" ).load("incpart/loadpk.php?pk=9", function() {
				//console.log('sip');
				$("#loadpk").LoadingOverlay("hide");
			});
		});
		$("#pk10").click(function(){
			$("#pk10").addClass("active");
			$( "#loadpk" ).load("incpart/loadpk.php?pk=10", function() {
				//console.log('sip');
				$("#loadpk").LoadingOverlay("hide");
			});
		});
		
		<?php } ?>
		
		<?php if($sts == 0)	{ ?>
		
		$("#pk1, #pk2, #pk3, #pk4, #pk5, #pk6, #pk7").click(function(){
			$("#rmcl button").removeClass("active");
			$("#loadpk").LoadingOverlay("show", {
				image       : "",
				fontawesome : "fa fa-circle-o-notch fa-spin",
				maxSize	: "50px"
			});
		})
		
		$("#pk1").click(function(){
			$("#pk1").addClass("active");
			$( "#loadpk" ).empty();
			setTimeout(function(){
			$( "#loadpk" ).load("incpart/loadpk.php?pk=1", function() {
				//console.log('sip');
				$("#loadpk").LoadingOverlay("hide");
			});
			}, 200);
		});
		$("#pk2").click(function(){
			$("#pk2").addClass("active");
			$( "#loadpk" ).load("incpart/loadpk.php?pk=2", function() {
				//console.log('sip');
				$("#loadpk").LoadingOverlay("hide");
			});
		});
		$("#pk3").click(function(){
			$("#pk3").addClass("active");
			$( "#loadpk" ).load("incpart/loadpk.php?pk=3", function() {
				//console.log('sip');
				$("#loadpk").LoadingOverlay("hide");
			});
		});
		$("#pk4").click(function(){
			$("#pk4").addClass("active");
			$( "#loadpk" ).load("incpart/loadpk.php?pk=4", function() {
				//console.log('sip');
				$("#loadpk").LoadingOverlay("hide");
			});
		});
		$("#pk5").click(function(){
			$("#pk5").addClass("active");
			$( "#loadpk" ).load("incpart/loadpk.php?pk=5", function() {
				//console.log('sip');
				$("#loadpk").LoadingOverlay("hide");
			});
		});
		$("#pk6").click(function(){
			$("#pk6").addClass("active");
			$( "#loadpk" ).load("incpart/loadpk.php?pk=6", function() {
				//console.log('sip');
				$("#loadpk").LoadingOverlay("hide");
			});
		});
		$("#pk7").click(function(){
			$("#pk7").addClass("active");
			$( "#loadpk" ).load("incpart/loadpk.php?pk=7", function() {
				//console.log('sip');
				$("#loadpk").LoadingOverlay("hide");
			});
		});
		
		<?php } ?>
		
		$(document).on('show.bs.modal', '.modal', function () {
			var zIndex = 1040 + (10 * $('.modal:visible').length);
			$(this).css('z-index', zIndex);
			setTimeout(function() {
				$('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
			}, 0);
		});
		
	});
</script>

<!-- Modal Detail Kerja include dtlkerja.php -->
<div class="modal right fade" id="myModal2" tabindex="-4" role="dialog" aria-labelledby="myModalLabel2">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content" id="mdl">

			<div class="modal-header">
				<h5 class="modal-title" id="myModalLabel2">Right Sidebar</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>

			<div class="modal-body" id="overlay">
				<div id="here"></div>
			</div>

		</div><!-- modal-content -->
	</div><!-- modal-dialog -->
</div><!-- modal -->
<script>
$( document ).ready(function() {
	$('#myModal2').on('show.bs.modal', function (event) {	
		var button = $(event.relatedTarget) // Button that triggered the modal
		var id = button.data('id')
		var name = button.data('name') // Extract info from data-* attributes
		// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
		// Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
		var modal = $(this)
		modal.find('.modal-title').text(name)
		//modal.find('#id').text(id)
		$("#overlay").LoadingOverlay("show", {
			image       : "",
			fontawesome : "fa fa-circle-o-notch fa-spin",
			maxSize	: "50px"
		});
		$( "#here" ).load("incpart/dtlkerja.php?id="+id, function() {
			//console.log('sip');
			setTimeout(function(){
				$("#overlay").LoadingOverlay("hide");
			}, 200);
		});
	});
	$('#myModal2').on('hidden.bs.modal', function (event) {	
		$( "#here" ).empty();
	});
});
</script>

<?php if($sts == 0)	{ ?>

<!-- Modal ADD -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="Tambah Admin" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Tambah Ruangan Kerja</h5>
        <button id="btnDox" type="button" class="close ext" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="addp" enctype="multipart/form-data">
      <div class="modal-body" id="overlays">
       
        <div class="form-row">
          <div class="form-group col-md-12">
            <label for="nmkrj" class="form-control-label">Nama Kerja</label>
            <input type="hidden" class="form-control" name="nip" id="nip" data-validation="required" value="<?= $_SESSION['pegawai']['NIP']; ?>">
            <input type="text" class="form-control" name="nmkrj" id="nmkrj" data-validation="custom required" data-validation-regexp="^[A-z\s]+$">
          </div>
          <div class="form-group col-md-12">
            <label for="dsk" class="form-control-label">Deskripsi Kerja</label>
            <textarea class="form-control" id="dsk" name="dsk" rows="3" data-validation="required"></textarea>
          </div>
          <div class="form-group col-md-12">
            <label for="email" class="form-control-label">Unggah Satu Berkas</label><br />
         	<div class="file-loading">
			  <input id="data" name="data" type="file" 
					 data-validation="size" 
					 data-validation-max-size="20mb" >
			</div>
          </div>
          <div class="form-group col-md-6">
            <label for="tgl1" class="form-control-label">Tanggal Mulai Kerja</label>
            <input type="text" class="form-control" name="tgl1" id="tgl1" data-validation="date" placeholder="yyyy-mm-dd" value="<?= date("Y-m-d"); ?>">
          </div>
          <div class="form-group col-md-6">
            <label for="tgl2" class="form-control-label">Tanggal Target Selesai Kerja</label>
            <input type="text" class="form-control" name="tgl2" id="tgl2" data-validation="date" placeholder="yyyy-mm-dd" value="<?= date("Y-m-d", time() + 86400); ?>">
          </div>
		</div>
        
        
      </div>
      <div class="modal-footer">
        <button type="button" id="btnDobtl" class="btn btn-secondary ext" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Batal</button>
        <div id="btnplc"></div>
        <button type="submit" id="btnDo" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Kerja Baru</button>
      </div>
      </form>
    </div>
  </div>
</div>
<script>
	$(document).ready(function(){
		$('#tgl1').datepicker({
			format: "yyyy-mm-dd",
			maxViewMode: 2,
			language: "id",
			autoclose: true,
			todayBtn: "linked",
			orientation: "auto",
			todayHighlight: true,
			forceParse: false
		});
		$('#tgl2').datepicker({
			format: "yyyy-mm-dd",
			maxViewMode: 2,
			language: "id",
			autoclose: true,
			orientation: "auto",
			todayHighlight: true,
			forceParse: false
		});
		
		// dont remove this
		$("#data").fileinput({
			theme: "fa",
			language: "id",
			showPreview: false,
			showUpload: false,
			removeClass: "btn btn-danger"
			//uploadUrl: '/site/file-upload-single'
		});
		
		$.validate({
			form : '#addp',
			modules : 'date, file',
			
			onError : function($form) {
			 	//alert('Kesalahan Penginputan Data, Perhatikan Kembali Data Yang Akan Dimasukkan !');
				toastr.error("Terdapat Data Yang Wajib Diisi, Perhatikan Kembali Data Yang Akan Dimasukkan","Kesalahan !");
				$("#exampleModalLong").scrollTop(0);
			},
			onSuccess : function($form) {
			  	//alert('The form is valid!');
				$("#overlays").LoadingOverlay("show", {
					image       : "",
					fontawesome : "fa fa-circle-o-notch fa-spin",
					maxSize	: "50px"
				});
				doAdd();
			  	return false; // Will stop the submission of the form
			}
		});
		
		function doAdd()	{
			
			toastr.clear();
			$('#btnDobtl').attr("disabled", true);
			$('#btnDox').removeAttr("data-dismiss");
			$('#btnDo').attr("disabled", true).html('Sedang Memproses <i class="fa fa-spinner fa-pulse fa-fw"></i>');

			var data = new FormData();
			data.append('var1', $("#nip").val());
			data.append('var2', $("#nmkrj").val());
			data.append('var3', $("#dsk").val());
			data.append('var4', $("#data")[0].files[0]);
			data.append('var5', $("#tgl1").val());
			data.append('var6', $("#tgl2").val());

			var txt = '<i class="fa fa-plus" aria-hidden="true"></i> Tambah Kerja Baru';
			$.ajax('incdo/doaddkerja.php?do=add', {
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
						$("#overlays").LoadingOverlay("hide");
						toastr.success(response.pesan,"Sukses !");
						$('#btnDobtl').removeAttr("disabled");
						$('#btnDox').attr("data-dismiss","modal");
						$('#btnDo').removeAttr("disabled").html(txt);
						$('#exampleModalLong').modal('hide');
						setTimeout(function() {
							$('#ui-view').load("incpart/dtkerja.php");
						}, 500);
					} else	{
						//console.log('Upload gagal');
						//alert(response.pesan);
						$("#exampleModalLong").scrollTop(0);
						$("#overlays").LoadingOverlay("hide");
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
				
		}
	});
</script>

<!-- Modal Update -->
<div class="modal fade" id="exampleModalLonged" tabindex="-1" role="dialog" aria-labelledby="Tambah Admin" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Perbaharui Data Project</h5>
        <button id="btnUpx" type="button" class="close ext" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="addpx" enctype="multipart/form-data">
      <div class="modal-body" id="overlaysx">
       
        <div class="form-row">
          <div class="form-group col-md-12">
            <label for="nmkrj" class="form-control-label">Nama Kerja</label>
            <input type="hidden" value="" name="idkrjxp" id="idkrjxb">
            <input type="hidden" value="" name="idnip" id="idnip">
            <input type="text" value="" class="form-control" name="nmkrjxb" id="nmkrjxb" data-validation="custom required" data-validation-regexp="^[A-z\s]+$">
          </div>
          <div class="form-group col-md-12">
            <label for="dsk" class="form-control-label">Deskripsi Kerja</label>
            <textarea class="form-control" id="dskx" name="dskx" rows="3" data-validation="required"></textarea>
          </div>
          <div class="form-group col-md-12" id="fls"></div>
          <div class="form-group col-md-6">
            <label for="tgl1" class="form-control-label">Tanggal Mulai Kerja</label>
            <input type="text" class="form-control" name="tgl1xb" id="tgl1xb" data-validation="date" placeholder="yyyy-mm-dd" value=" ">
          </div>
          <div class="form-group col-md-6">
            <label for="tgl2" class="form-control-label">Tanggal Target Selesai Kerja</label>
            <input type="text" class="form-control" name="tgl2xb" id="tgl2xb" data-validation="date" placeholder="yyyy-mm-dd" value=" ">
          </div>
		</div>
        
        
      </div>
      <div class="modal-footer">
        <button type="button" id="btnUpbtl" class="btn btn-secondary ext" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Batal</button>
        <div id="btnplc"></div>
        <button type="submit" id="btnUp" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Perbaharui Project</button>
      </div>
      </form>
    </div>
  </div>
</div>
<script>
	$(document).ready(function(){
		$('#exampleModalLonged').on('shown.bs.modal', function (event) {	
			var button = $(event.relatedTarget) // Button that triggered the modal
			var idkrjgx = button.data('idkrjgxz')
			var namke = button.data('namke')
			var kete = button.data('kete')
			var tgl1z = button.data('tgl1z')
			var tgl2z = button.data('tgl2z')
			var idber = button.data('idber')
			var idnip = button.data('idnip') // Extract info from data-* attributes
			// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
			// Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
			var modal = $(this)
			modal.find('#idkrjxb').attr('value', idkrjgx)
			modal.find('#nmkrjxb').attr('value', namke)
			modal.find('#dskx').text(kete)
			modal.find('#tgl1xb').attr('value', tgl1z)
			modal.find('#tgl2xb').attr('value', tgl2z)
			modal.find('#idnip').attr('value', idnip)
			
			$( "#fls" ).load('incpart/formupprjbrks.php?idkerja='+idkrjgx+'&berkas='+idber, function() {
				//console.log('sip');
				$("#overlaysx").LoadingOverlay("hide");
			});
			
			$('#tgl1xb').datepicker({
				format: "yyyy-mm-dd",
				maxViewMode: 2,
				language: "id",
				autoclose: true,
				todayBtn: "linked",
				orientation: "auto",
				todayHighlight: true,
				forceParse: true
			});
			$('#tgl2xb').datepicker({
				format: "yyyy-mm-dd",
				maxViewMode: 2,
				language: "id",
				autoclose: true,
				orientation: "auto",
				todayHighlight: true,
				forceParse: true
			});
			
		});
		
		// dont remove this
		/*$("#datax").fileinput({
			theme: "fa",
			language: "id",
			showPreview: false,
			showUpload: false,
			removeClass: "btn btn-danger"
			
		});*/
		
		$.validate({
			form : '#addpx',
			modules : 'date, file',

			onError : function($form) {
				//alert('Kesalahan Penginputan Data, Perhatikan Kembali Data Yang Akan Dimasukkan !');
				toastr.error("Terdapat Data Yang Wajib Diisi, Perhatikan Kembali Data Yang Akan Dimasukkan","Kesalahan !");
				$("#exampleModalLong").scrollTop(0);
			},
			onSuccess : function($form) {
				//alert('The form is valid!');
				$("#overlaysx").LoadingOverlay("show", {
					image       : "",
					fontawesome : "fa fa-circle-o-notch fa-spin",
					maxSize	: "50px"
				});
				doUpdatex();
				return false; // Will stop the submission of the form
			}
		});

		function doUpdatex()	{

			toastr.clear();
			$('#btnUpbtl').attr("disabled", true);
			$('#btnUpx').removeAttr("data-dismiss");
			$('#btnUp').attr("disabled", true).html('Sedang Memproses <i class="fa fa-spinner fa-pulse fa-fw"></i>');
			
			var data = new FormData();
			data.append('var0', $("#idnip").val());
			data.append('var1', $("#idkrjxb").val());
			data.append('var2', $("#nmkrjxb").val());
			data.append('var3', $("#dskx").val());
			data.append('var4', $("#datax")[0].files[0]);
			data.append('var5', $("#tgl1xb").val());
			data.append('var6', $("#tgl2xb").val());
			
			var idl = $("#idkrjxb").val();

			var txt = '<i class="fa fa-plus" aria-hidden="true"></i> Tambah Kerja Baru';

			$.ajax('incdo/doaddkerja.php?do=updateproject', {
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
						$("#overlaysx").LoadingOverlay("hide");
						toastr.success(response.pesan,"Sukses !");
						$('#btnUpbtl').removeAttr("disabled");
						$('#btnUpx').attr("data-dismiss","modal");
						$('#btnUp').removeAttr("disabled").html(txt);
						$('#addpx').get(0).reset();
						$('#exampleModalLonged').modal('hide');
						setTimeout(function() {
							$("#overlay").LoadingOverlay("show", {
								image       : "",
								fontawesome : "fa fa-circle-o-notch fa-spin",
								maxSize	: "50px"
							});
							$( "#here" ).load("incpart/dtlkerja.php?id="+idl, function() {
								//console.log('sip');
								$("#overlay").LoadingOverlay("hide");
							});
						}, 500);
					} else	{
						//console.log('Upload gagal');
						//alert(response.pesan);
						$("#exampleModalLonged").scrollTop(0);
						$("#overlaysx").LoadingOverlay("hide");
						toastr.error(response.pesan,"Kesalahan !");
						$('#btnUpbtl').removeAttr("disabled");
						$('#btnUpx').attr("data-dismiss","modal");
						$('#btnUp').removeAttr("disabled").html(txt);
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


<!-- Modal add anggota -->
<div class="modal fade" id="exampleModalLongw" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Tambah Anggota & Tugas</h5>
        <button type="button" class="close ext" id="btnAddx" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="angg">
      <div class="modal-body" id="overlayn">
      
      	<div class="row">
		  <div class="form-group col-md-12">
			<label for="nip">Anggota</label>
			<select name="nip" id="nip" class="form-control custom-select ted" data-validation="required">

			</select>
		  </div>
		</div>
    
    	<div class="row">
    		<div id="idk" style="display: none;"></div>
    		<div class="form-group col-md-12">
			  <label for="tgs">Deskripsi Tugas</label>
			  <div class="input-group">
			    <textarea class="form-control" id="tgs" name="tgs" rows="3" data-validation="required"></textarea>
			  </div>
		    </div>
		    <div class="form-group col-md-12">
			  <label for="tglx">Mulai Kerja</label>
			  <div class="input-group">
			    <input type="text" class="form-control" name="tglx" id="tglx" data-validation="date" placeholder="yyyy-mm-dd" value="<?= date("Y-m-d"); ?>">
			  </div>
		    </div>
		    <div class="form-group col-md-12">
			  <label for="tglx2">Target Selesai</label>
			  <div class="input-group">
			    <input type="text" class="form-control" name="tglx2" id="tglx2" data-validation="date" placeholder="yyyy-mm-dd" value="<?= date("Y-m-d", time() + 86400); ?>">
			  </div>
		    </div>
    	</div>
     
      </div>
      <div class="modal-footer">
        <button type="button" id="btnAddbtl" class="btn btn-secondary ext" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Batal</button>
        <div id="btnplc"></div>
        <button type="submit" id="btnAdd" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Data</button>
      </div>
      </form>
    </div>
  </div>
</div>
<script>
$( document ).ready(function() {
	$('#exampleModalLongw').on('show.bs.modal', function (event) {	
		var button = $(event.relatedTarget) // Button that triggered the modal
		var id = button.data('id')
		var dtpro = button.data('dtpro')
		var dtpro2 = button.data('dtpro2')// Extract info from data-* attributes
		// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
		// Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
		var modal = $(this)
		modal.find('#idk').text(id)
		//modal.find('#tglx').val(dtpro)
		
		//var nowDate = new Date();
		//var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate());
		//alert(today);
		var dateDb = new Date(dtpro);
		var actDatedb = new Date(dateDb.getFullYear(), dateDb.getMonth(), dateDb.getDate());
		
		var dateDb2 = new Date(dtpro2);
		var actDatedb2 = new Date(dateDb2.getFullYear(), dateDb2.getMonth(), dateDb2.getDate());
		
		//modal.find('#tglx2').val(dateDb.getFullYear()+'-'+dateDb.getMonth()+'-'+(dateDb.getDate()+1))
		/*
		actDatedb.setDate(actDatedb.getDate() - today.getDate());
		var fixDt = actDatedb.getDate();
		
		var newDate = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate()+fixDt);
		alert(newDate);*/
	
		$('#tglx, #tglx2').datepicker({
			format: "yyyy-mm-dd",
			startDate: actDatedb,
			endDate: actDatedb2,
			maxViewMode: 2,
			language: "id",
			autoclose: true,
			orientation: "auto",
			todayHighlight: true,
			forceParse: false
		});
		
		$('.ted').select2({
			dropdownParent: $("#exampleModalLongw"),
			ajax: {
				url: "incdo/srpegawai.php",
				dataType: 'json',
				multiple:true,
				delay: 250,
				data: function (params) {
					return {
						q: params.term // search term
					};
				},
				processResults: function (data) {
					// parse the results into the format expected by Select2.
					// since we are using custom formatting functions we do not need to
					// alter the remote JSON data
					return {
						results: data
					};
				},
				cache: true
			},
			minimumInputLength: 1
		});
		
		$.validate({
			form : '#angg',
			modules : 'date',

			onError : function($form) {
				//alert('Kesalahan Penginputan Data, Perhatikan Kembali Data Yang Akan Dimasukkan !');
				toastr.error("Terdapat Data Yang Wajib Diisi, Perhatikan Kembali Data Yang Akan Dimasukkan","Kesalahan !");
				$("#exampleModalLongw").scrollTop(0);
			},
			onSuccess : function($form) {
				//alert('The form is valid!');
				$("#overlayn").LoadingOverlay("show", {
					image       : "",
					fontawesome : "fa fa-circle-o-notch fa-spin",
					maxSize	: "50px"
				});
				doAdds();
				return false; // Will stop the submission of the form
			}
		});

		function doAdds()	{
			
			toastr.clear();
			$('#btnAddbtl').attr("disabled", true);
			$('#btnAddx').removeAttr("data-dismiss");
			$('#btnAdd').attr("disabled", true).html('Sedang Memproses <i class="fa fa-spinner fa-pulse fa-fw"></i>');

			var data = new FormData();
			data.append('var1', $(".ted").val());
			data.append('var2', $("#tgs").val());
			data.append('var3', $("#tglx").val());
			data.append('var4', $("#tglx2").val());
			data.append('var5', $("#idk").text());

			var ida = $("#idk").text();
			var txt = '<i class="fa fa-plus" aria-hidden="true"></i> Tambah Data';
			$.ajax('incdo/doaddkerja.php?do=addang', {
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
						//alert('okelah');
						$("#overlayn").LoadingOverlay("hide");
						toastr.success(response.pesan,"Sukses !");
						$('#angg').get(0).reset();
						$('#exampleModalLongw').modal('hide');
						$('#btnAddbtl').removeAttr("disabled");
						$('#btnAddx').attr("data-dismiss","modal");
						$('#btnAdd').removeAttr("disabled").html(txt);
						setTimeout(function(){
							$("#overlay").LoadingOverlay("show", {
								image       : "",
								fontawesome : "fa fa-circle-o-notch fa-spin",
								maxSize	: "50px"
							});
							$( "#here" ).load("incpart/dtlkerja.php?id="+ida, function() {
								//console.log('sip');
								$("#overlay").LoadingOverlay("hide");
							});
						}, 500);
					} else	{
						//console.log('Upload gagal');
						//alert(response.pesan);
						$("#exampleModalLongw").scrollTop(0);
						$("#overlayn").LoadingOverlay("hide");
						toastr.error(response.pesan,"Kesalahan !");
						$('#btnAddbtl').removeAttr("disabled");
						$('#btnAddx').attr("data-dismiss","modal");
						$('#btnAdd').removeAttr("disabled").html(txt);
					}
				},
				error: function(xhr,err){
					alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n\n1:loading, 2:loaded, 3:interactive, 4:complete.\n404: not found, 500: server error, 200: ok.");
					alert("responseText: "+xhr.responseText);
				}
			});

		}
		
	});
	
});
</script>

<!-- Modal update tugas anggota -->
<div class="modal fade" id="exampleModaltgs" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Tambah Anggota & Tugas</h5>
        <button type="button" class="close ext" id="btnTgsx" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="anggu">
      <div class="modal-body" id="overlayu">
      
      	<div class="row">
      	  <div class="form-group col-md-12">
			<label for="nip" id="setnama"></label>
		  </div>
		  <div class="form-group col-md-12">
			<label for="nip">Ganti Dengan Anggota Lain</label>
			<select name="nipu" id="nipu" class="form-control custom-select teds">

			</select>
		  </div>
		</div>
    
    	<div class="row">
    		<div id="idu" style="display: none;"></div>
    		<div class="form-group col-md-12">
			  <label for="tgs">Deskripsi Tugas</label>
			  <div class="input-group">
			    <textarea class="form-control" id="tgsu" name="tgsu" rows="3" data-validation="required"></textarea>
			  </div>
		    </div>
		    <div class="form-group col-md-12">
			  <label for="tglx">Mulai Kerja</label>
			  <div class="input-group">
			    <input type="text" class="form-control" name="tglu" id="tglu" data-validation="date" placeholder="yyyy-mm-dd">
			  </div>
		    </div>
		    <div class="form-group col-md-12">
			  <label for="tglx2">Target Selesai</label>
			  <div class="input-group">
			    <input type="text" class="form-control" name="tglu2" id="tglu2" data-validation="date" placeholder="yyyy-mm-dd">
			  </div>
		    </div>
    	</div>
     
      </div>
      <div class="modal-footer">
        <button type="button" id="btnTgsbtl" class="btn btn-secondary ext" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Batal</button>
        <div id="btnplc"></div>
        <button type="submit" id="btnTgs" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Perbaharui Tugas</button>
      </div>
      </form>
    </div>
  </div>
</div>
<script>
$( document ).ready(function() {
	$('#exampleModaltgs').on('hidden.bs.modal', function (event) {
		$('#anggu').get(0).reset();
		$('#setnama').html('Nama Anggota');
		$('#idu').html('');
	});
	$('#exampleModaltgs').on('shown.bs.modal', function (event) {	
		var button = $(event.relatedTarget) // Button that triggered the modal
		var tgsidkrj = button.data('tgsidkrj')
		var tgsiddtl = button.data('tgsiddtl')
		var tgsnip = button.data('tgsnip')
		var tgsnm = button.data('tgsnm')
		var tgsket = button.data('tgsket')
		var tgstgl1 = button.data('tgstgl1')
		var tgstgl2 = button.data('tgstgl2')// Extract info from data-* attributes
		// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
		// Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
		var modal = $(this)
		modal.find('#idu').text(tgsiddtl)
		modal.find('#setnama').html('Nama Anggota<br><b>'+tgsnm+'</b>')
		modal.find('#tgsu').val(tgsket)
		modal.find('#tglu').val(tgstgl1)
		modal.find('#tglu2').val(tgstgl2)
		
		//var nowDate = new Date();
		//var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate());
		//alert(today);
		var dateDb = new Date(tgstgl1);
		var actDatedb = new Date(dateDb.getFullYear(), dateDb.getMonth(), dateDb.getDate());
		
		var dateDb2 = new Date(tgstgl2);
		var actDatedb2 = new Date(dateDb2.getFullYear(), dateDb2.getMonth(), dateDb2.getDate());
		
		//modal.find('#tglx2').val(dateDb.getFullYear()+'-'+dateDb.getMonth()+'-'+(dateDb.getDate()+1))
		/*
		actDatedb.setDate(actDatedb.getDate() - today.getDate());
		var fixDt = actDatedb.getDate();
		
		var newDate = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate()+fixDt);
		alert(newDate);*/
	
		$('#tglu, #tglu2').datepicker({
			format: "yyyy-mm-dd",
			startDate: actDatedb,
			endDate: actDatedb2,
			maxViewMode: 2,
			language: "id",
			autoclose: true,
			orientation: "auto",
			todayHighlight: true,
			forceParse: false
		});
		
		$('.teds').select2({
			dropdownParent: $("#exampleModaltgs"),
			ajax: {
				url: "incdo/srpegawai.php?noid="+tgsnip,
				dataType: 'json',
				multiple:true,
				delay: 250,
				data: function (params) {
					return {
						q: params.term // search term
					};
				},
				processResults: function (data) {
					// parse the results into the format expected by Select2.
					// since we are using custom formatting functions we do not need to
					// alter the remote JSON data
					return {
						results: data
					};
				},
				cache: true
			},
			minimumInputLength: 1
		});
		
		$.validate({
			form : '#anggu',
			modules : 'date',

			onError : function($form) {
				//alert('Kesalahan Penginputan Data, Perhatikan Kembali Data Yang Akan Dimasukkan !');
				toastr.error("Terdapat Data Yang Wajib Diisi, Perhatikan Kembali Data Yang Akan Dimasukkan","Kesalahan !");
				$("#exampleModaltgs").scrollTop(0);
			},
			onSuccess : function($form) {
				//alert('The form is valid!');
				$("#overlayu").LoadingOverlay("show", {
					image       : "",
					fontawesome : "fa fa-circle-o-notch fa-spin",
					maxSize	: "50px"
				});
				doUptugas();
				return false; // Will stop the submission of the form
			}
		});

		function doUptugas()	{
			
			toastr.clear();
			$('#btnTgsbtl').attr("disabled", true);
			$('#btnTgsx').removeAttr("data-dismiss");
			$('#btnTgs').attr("disabled", true).html('Sedang Memproses <i class="fa fa-spinner fa-pulse fa-fw"></i>');

			var data = new FormData();
			data.append('var1', $(".teds").val());
			data.append('var2', $("#tgsu").val());
			data.append('var3', $("#tglu").val());
			data.append('var4', $("#tglu2").val());
			data.append('var5', $("#idu").text());
			
			//alert($(".teds").val());

			var idak = tgsidkrj;
			var txt = '<i class="fa fa-plus" aria-hidden="true"></i> Perbaharui Tugas';
			$.ajax('incdo/doaddkerja.php?do=updatetugas', {
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
						$('#anggu').get(0).reset();
						$('select#nipu').empty();
						$('#setnama').html('Nama Anggota');
						$('#idu').html('');
						//alert('okelah');
						$("#overlayu").LoadingOverlay("hide");
						toastr.success(response.pesan,"Sukses !");
						$('#anggu').get(0).reset();
						$('#exampleModaltgs').modal('hide');
						$('#btnTgsbtl').removeAttr("disabled");
						$('#btnTgsx').attr("data-dismiss","modal");
						$('#btnTgs').removeAttr("disabled").html(txt);
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
						$("#exampleModaltgs").scrollTop(0);
						$("#overlayu").LoadingOverlay("hide");
						toastr.error(response.pesan,"Kesalahan !");
						$('#btnTgsbtl').removeAttr("disabled");
						$('#btnTgsx').attr("data-dismiss","modal");
						$('#btnTgs').removeAttr("disabled").html(txt);
					}
				},
				error: function(xhr,err){
					alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n\n1:loading, 2:loaded, 3:interactive, 4:complete.\n404: not found, 500: server error, 200: ok.");
					alert("responseText: "+xhr.responseText);
				}
			});

		}
		
	});
	
});
</script>


<!-- Modal add data berkas after 100% -->
<div class="modal fade" id="exampleModalLongwx" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Unggah Berkas</h5>
        <button type="button" class="close ext" id="btnDtux" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="anggx">
      <div class="modal-body" id="overlayns">
      
      	<div class="row" id="doload">
		  
		</div>
    
    	<div class="row">
    		<div id="idkx" style="display: none;"></div>
    		<div id="idkrjx" style="display: none;"></div>
    		<div id="nipc" style="display: none;"></div>
    		<input type="hidden" name="statusrev" id="statusrev">
    	</div>
     
      </div>
      <div class="modal-footer">
        <button type="button" id="btnDtubtl" class="btn btn-secondary ext" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Batal</button>
        <div id="btnplc"></div>
        <button type="submit" id="btnDtu" class="btn btn-success"><i class="fa fa-download" aria-hidden="true"></i> Unggah dan Selesai</button>
      </div>
      </form>
    </div>
  </div>
</div>
<script>
$( document ).ready(function() {
	$('#exampleModalLongwx').on('show.bs.modal', function (event) {	
		var button = $(event.relatedTarget) // Button that triggered the modal
		var idz = button.data('iddtlz')
		var idz2 = button.data('idkrjz')
		var nipc = button.data('nipc')
		var sts = button.data('sts')
		var rev = button.data('rev')// Extract info from data-* attributes
		// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
		// Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
		var modal = $(this)
		modal.find('#idkx').text(idz)
		modal.find('#idkrjx').text(idz2)
		modal.find('#nipc').text(nipc)
		modal.find('#statusrev').val(rev)
		$("#doload").LoadingOverlay("show", {
			image       : "",
			fontawesome : "fa fa-circle-o-notch fa-spin",
			maxSize	: "50px"
		});
		$( "#doload" ).load("incpart/loadformberkas.php?sts="+sts+"&iddtl="+idz, function() {
			//console.log('sip');
			$("#doload").LoadingOverlay("hide");
		});
		
	});
	
});
</script>

<!-- Modal do revisi koor -->
<div class="modal fade" id="exampleModals" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Revisi Tugas</h5>
        <button type="button" class="close ext" id="btnRevx" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="anggx2">
      <div class="modal-body" id="overlayns2">
      
      	<div class="row">
      	  <div class="form-group col-md-12">
            <label for="rev" class="form-control-label">Keterangan Revisi</label>
            <textarea class="form-control" id="rev" name="rev" rows="3" data-validation="required"></textarea>
          </div>
		  <div class="form-group col-md-12">
            <label for="pers" class="form-control-label">Ubah Persentase Menjadi</label>
            <div class="input-group">
              <input type="number" class="form-control" name="pers" id="pers" data-validation="custom number required" data-validation-regexp="^[0-9]+$" data-validation-allowing="range[0;99]">
			  <div class="input-group-addon">%</div>
		    </div>
            <small class="form-text text-muted">
            	Angka dari 0 - 99
			</small>
          </div>
		</div>
    
    	<div class="row">
    		<div id="iddtlm" style="display: none;"></div>
    		<div id="idkrjm" style="display: none;"></div>
    	</div>
     
      </div>
      <div class="modal-footer">
        <button type="button" id="btnRevbtl" class="btn btn-secondary ext" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Batal</button>
        <div id="btnplc"></div>
        <button type="submit" id="btnRev" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Revisi Tugas</button>
      </div>
      </form>
    </div>
  </div>
</div>
<script>
$( document ).ready(function() {
	$('#exampleModals').on('show.bs.modal', function (event) {	
		var button = $(event.relatedTarget) // Button that triggered the modal
		var idm = button.data('iddtlm')
		var fornm = button.data('fornm')
		var idkrjm = button.data('idkrjm')// Extract info from data-* attributes
		// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
		// Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
		var modal = $(this)
		modal.find('#iddtlm').text(idm)
		modal.find('#idkrjm').text(idkrjm)
		modal.find('.modal-title').text('Revisi Tugas Untuk '+fornm)
		
		
		$.validate({
			form : '#anggx2',

			onError : function($form) {
				//alert('Kesalahan Penginputan Data, Perhatikan Kembali Data Yang Akan Dimasukkan !');
				toastr.error("Terdapat Data Yang Wajib Diisi, Perhatikan Kembali Data Yang Akan Dimasukkan","Kesalahan !");
				$("#exampleModals").scrollTop(0);
			},
			onSuccess : function($form) {
				//alert('The form is valid!');
				$("#overlayns2").LoadingOverlay("show", {
					image       : "",
					fontawesome : "fa fa-circle-o-notch fa-spin",
					maxSize	: "50px"
				});
				doAddsx2();
				return false; // Will stop the submission of the form
			}
		});

		function doAddsx2()	{
			
			toastr.clear();
			$('#btnRevbtl').attr("disabled", true);
			$('#btnRevx').removeAttr("data-dismiss");
			$('#btnRev').attr("disabled", true).html('Sedang Memproses <i class="fa fa-spinner fa-pulse fa-fw"></i>');

			var data = new FormData();
			data.append('var1', $("#iddtlm").text());
			data.append('var2', $("#rev").val());
			data.append('var3', $("#pers").val());

			var idam = $("#idkrjm").text();
			var txt = '<i class="fa fa-plus" aria-hidden="true"></i> Revisi Tugas';
			$.ajax('incdo/doaddkerja.php?do=revisi', {
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
						$("#overlayns2").LoadingOverlay("hide");
						$('#anggx2').get(0).reset();
						$('#exampleModals').modal('hide');
						toastr.success(response.pesan,"Sukses !");
						$('#btnRevbtl').removeAttr("disabled");
						$('#btnRevx').attr("data-dismiss","modal");
						$('#btnRev').removeAttr("disabled").html(txt);
						setTimeout(function(){
							$("#overlay").LoadingOverlay("show", {
								image       : "",
								fontawesome : "fa fa-circle-o-notch fa-spin",
								maxSize	: "50px"
							});
							$( "#here" ).load("incpart/dtlkerja.php?id="+idam, function() {
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
	
});
</script>

<!-- Konfirm Modal -->
<div class="modal fade" id="selesaidonex" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
	<div class="modal-content">
	  <div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
		<button type="button" class="close ext" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
	  </div>
	  <div class="modal-body">
		Yakin untuk menyelesaikan project ini ?
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-secondary ext" id="donesx" data-dismiss="modal">Batal</button>
		<button type="button" class="btn btn-success" id="dones" idkrjc="">Selesai</a>
	  </div>
	</div>
  </div>
</div>
<script>
$(document).ready(function(){
	$('#selesaidonex').on('show.bs.modal', function (event) {	
		var button = $(event.relatedTarget) // Button that triggered the modal
		var idkrjg = button.data('idkrjg')// Extract info from data-* attributes
		// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
		// Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
		var modal = $(this)
		modal.find('#dones').attr('idkrjc',idkrjg)
	});
	
	$('button#dones').click(function (eventx){ 
		eventx.preventDefault(); 
		toastr.clear();
		var idkrjc= $(this).attr('idkrjc');
		var data = new FormData();
			data.append('var1', idkrjc);
		
		$('#donesx').attr("disabled", true);
		$('.ext').removeAttr("data-dismiss");
		$('#dones').attr("disabled", true).html('Sedang Memproses <i class="fa fa-spinner fa-pulse fa-fw"></i>');
		$.ajax('incdo/doaddkerja.php?do=selesaidone', {
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
					toastr.success(response.pesan,"Sukses !");
					$('#donesx').removeAttr("disabled");
					$('.ext').attr("data-dismiss","modal");
					$('#dones').removeAttr("disabled");
					$('#myModal2').modal('hide');
					$('#selesaidonex').modal('hide');

					setTimeout(function() {
						$( "#ui-view" ).load("incpart/dtkerja.php?to=7", function() {
							//console.log('sip');
						});
					}, 300);
				} else	{
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