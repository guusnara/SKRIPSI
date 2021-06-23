<!-- Edit -->
<div class="modal fade" id="exampleEdit" tabindex="-1" role="dialog" aria-labelledby="Tambah Admin" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"></h5>
        <button id="btnEdtx" type="button" class="close ext" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <ul class="nav nav-pills justify-content-center mt-2" id="pills-tab" role="tablist">
	  <li class="nav-item">
		<a class="nav-link active" id="infopribadi-tab" data-toggle="pill" href="#infopribadi" role="tab" aria-controls="infopribadi" aria-expanded="true">Informasi Pribadi</a>
	  </li>
	  <li class="nav-item">
		<a class="nav-link" id="infoimg-tab" data-toggle="pill" href="#infoimg" role="tab" aria-controls="infoimg" aria-expanded="true">Ubah Foto Profil</a>
	  </li>
	  <li class="nav-item">
		<a class="nav-link" id="infopass-tab" data-toggle="pill" href="#infopass" role="tab" aria-controls="infopass" aria-expanded="true">Ubah Password</a>
	  </li>
	</ul>
	<div class="tab-content" id="pills-tabContent">
	  <div class="tab-pane fade show active" id="infopribadi" role="tabpanel" aria-labelledby="infopribadi">
	  		<form id="editad">
			  <div class="modal-body">
			  
				  <div class="form-row">
				  	  <div class="form-group col-md-5">
						<label for="nipe" class="form-control-label">NIP</label>
						<input type="text" class="form-control" name="nipe" id="nipe" data-validation="custom length" data-validation-regexp="^[0-9]+$" data-validation-length="18">
					  </div>
					  <div class="form-group col-md-7">
						<label for="pegawaie" class="form-control-label">Nama Pegawai</label>
						<input type="text" class="form-control" name="pegawaie" id="pegawaie" data-validation="custom length" data-validation-regexp="^[A-z,.\s]+$" data-validation-length="max30">
					  </div>
					  <div class="form-group col-md-12">
						  <label for="jke" class="form-control-label">Jenis Kelamin</label>
						  <div class="form-check">
							<label class="custom-control custom-radio">
							  <input id="cwoe" name="jke" type="radio" class="custom-control-input" value="L">
							  <span class="custom-control-indicator"></span>
							  <span class="custom-control-description">Laki-Laki</span>
							</label>
							<label class="custom-control custom-radio">
							  <input id="cwoe" name="jke" type="radio" class="custom-control-input" value="P">
							  <span class="custom-control-indicator"></span>
							  <span class="custom-control-description">Perempuan</span>
							</label>
						  </div>
					  </div>
					  <div class="form-group col-md-6">
						<label for="bidange" class="form-control-label">Bidang</label>
						<select class="form-control custom-select" name="bidange" id="bidange" data-validation="required">
							<option value="">Pilih Bidang</option>
						<?php $lo = mysql_query("select * from dt_bidang");
						while($ce = mysql_fetch_array($lo))	{ ?>
						  <option value="<?= $ce[0] ?>"><?= $ce[1] ?></option>
						<?php } ?>
						</select>
					  </div>
					  <div class="form-group col-md-6">
						<label for="jabatane" class="form-control-label">Jabatan</label>
						<select class="form-control custom-select" name="jabatane" id="jabatane" data-validation="required">
							<option value="">Pilih Jabatan</option>
						<?php $los = mysql_query("select * from dt_jabatan");
						while($ces = mysql_fetch_array($los))	{ ?>
						  <option value="<?= $ces[0] ?>"><?= $ces[1] ?></option>
						<?php } ?>
						</select>
					  </div>
					  <div class="form-group col-md-12">
						<label for="alamate" class="form-control-label">Alamat</label>
						<textarea class="form-control" id="alamate" name="alamate" rows="3" data-validation="required"></textarea>
					  </div>
					  <div class="form-group col-md-4">
						<label for="tlpe" class="form-control-label">Nomor Telepon</label>
						<input type="text" class="form-control" name="tlpe" id="tlpe" data-validation="custom length" data-validation-regexp="^[0-9]+$" data-validation-length="max12">
					  </div>
					  <div class="form-group col-md-8">
						<label for="emaile" class="form-control-label">E-mail</label>
						<input type="text" class="form-control" name="emaile" id="emaile" data-validation="email">
					  </div>
					  <div class="form-group col-md-12">
						<label for="usernamee" class="form-control-label">Username</label>
						<input type="text" class="form-control" name="usernamee" id="usernamee" data-validation="alphanumeric length server" data-validation-allowing="_" data-validation-length="5-16" data-validation-url="incdo/dtpegawai-cuser.php">
					  </div>
					  <div class="form-group col-md-12">
						<label for="pwd1e" class="form-control-label">Masukkan Password Untuk Melakukan Proses</label>
						<input type="password" name="pwd1e" id="pwd1e" class="form-control" data-validation="length" data-validation-length="min8">
						<input type="hidden" name="id" id="id" class="form-control">
					  </div>
				  </div>

			  </div>
			  <div class="modal-footer">
				<button type="button" id="btnEdtbtl" class="btn btn-secondary ext" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Batal</button>
				<div id="btnplc"></div>
				<button type="submit" id="btnEdt" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Perbaharui Data</button>
			  </div>
			</form>
	  </div>
	  <div class="tab-pane fade" id="infoimg" role="tabpanel" aria-labelledby="infoimg">
	  		<form id="editimg">
			  <div class="modal-body">
			  
			  	  <div class="form-group col-md-12">
			  	  	<input type="hidden" name="idcp" id="idcp" class="form-control">
					<div id="previewe">

					</div>
					<div class="file-loading">
					  <input id="fotov" name="fotov" accept=".jpg,.jpeg" type="file" data-validation="mime size required" data-validation-max-size="1000kb" data-validation-allowing="jpg">
					</div>

				  </div>

			  </div>
			  <div class="modal-footer">
				<button type="button" id="btnImgbtl" class="btn btn-secondary ext" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Batal</button>
				<div id="btnplcs"></div>
				<button type="submit" id="btnImg" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Unggah Foto</button>
			  </div>
			</form>
	  </div>
	  <div class="tab-pane fade" id="infopass" role="tabpanel" aria-labelledby="infopass">
	  		<form id="editpwd">
			  <div class="modal-body">

				<div id="hidemsgep" role="alert">
				  <span id="msgep"></span>
				</div>

				  <div class="form-group">
					<label for="pwdlm" class="form-control-label">Password Lama</label>
					<input type="password" name="pwdlm" id="pwdlm" class="form-control" data-validation="length" data-validation-length="min8">
					<input type="hidden" name="idc" id="idc" class="form-control">
				  </div>
				  <div class="form-group">
					<label for="pwdbr" class="form-control-label">Password Baru</label>
					<input type="password" name="pwdbr" id="pwdbr" class="form-control" data-validation="length" data-validation-length="min8">
				  </div>
				  <div class="form-group">
					<label for="pwdbrk" class="form-control-label">Konfirmasi Password Baru</label>
					<input type="password" name="pwdbrk" id="pwdbrk" class="form-control" data-validation="confirmation" data-validation-confirm="pwdbr">
				  </div>

			  </div>
			  <div class="modal-footer">
				<button type="button" id="btnPwdbtl" class="btn btn-secondary ext" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Batal</button>
				<div id="btnplcs"></div>
				<button type="submit" id="btnPwd" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Perbaharui Data</button>
			  </div>
			</form>
	  </div>
	</div>
      
    </div>
  </div>
</div>
<script>
	$(document).ready(function(){
		
		$('#fotov').on('change', function () { 
			var reader = new FileReader();
			reader.onload = function (e) {
				$('#previewe').empty();
				$('#previewe').attr("style", "height: 380px;").html('<div class="text-center"><label class="form-control-label"><strong>ATUR POSISI FOTO</strong></label></div>');
				
				$uploadCrop = $('#previewe').croppie({
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
		$("#fotov").fileinput({
			theme: "fa",
			language: "id",
			showPreview: false,
			showUpload: false,
			showRemove: false,
			removeClass: "btn btn-danger",
			allowedFileExtensions: ["jpg", "jpeg"]
			//uploadUrl: '/site/file-upload-single'
		});
		
		$('#exampleEdit').on('show.bs.modal', function (event) {	
		  var button = $(event.relatedTarget) // Button that triggered the modal
		  var nip = button.data('nip')
		  var nm = button.data('nm')
		  var bidang = button.data('bidang')
		  var jabatan = button.data('jabatan')
		  var jk = button.data('jk')
		  var alamat = button.data('alamat')
		  var tlp = button.data('tlp')
		  var email = button.data('email')
		  var url = button.data('url')
		  var user = button.data('user')// Extract info from data-* attributes
		  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
		  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
		  var modal = $(this)
		  modal.find('.modal-title').text('Perbaharui Data ' + nm)
		  modal.find('#id').val(nip)
		  modal.find('#idc').val(nip)
		  modal.find('#idcp').val(nip)
		  modal.find('#nipe').val(nip)
		  modal.find('#pegawaie').val(nm)
		  //modal.find('#bidange').val(bidang)
		  $('select[name="bidange"] option[value="'+bidang+'"]').prop('selected',true);
		  //modal.find('#jabatane').val(jabatan)
		  $('select[name="jabatane"] option[value="'+jabatan+'"]').prop('selected',true);
		  //modal.find('#jke').val(jk)
		  $('input[name="jke"][value="'+jk+'"]').prop('checked',true);
		  modal.find('#alamate').val(alamat)
		  modal.find('#tlpe').val(tlp)
		  modal.find('#emaile').val(email)
		  modal.find('#pegawaie').val(nm)
		  //modal.find('#fotoe').val(url)
		  modal.find('#usernamee').val(user)
		  $('#usernamee').attr("data-validation-url","incdo/dtpegawai-cuserup.php?id="+nip)
			
		  $('#previewe').html('<div class="text-center mb-3"><label class="form-control-label"><strong>FOTO PROFIL</strong></label><br /><img src="pegawaidb/'+url+'?'+new Date().getTime()+'" class="img-fluid img-thumbnail"></div>')
		});
		
		$.validate({
			form : '#editad',
			
			onError : function($form) {
				$("#exampleEdit").scrollTop(0);
			 	//alert('Kesalahan Penginputan Data, Perhatikan Kembali Data Yang Akan Dimasukkan !');
				toastr.error("Terdapat Data Yang Wajib Diisi, Perhatikan Kembali Data Yang Akan Dimasukkan","Kesalahan !");
			},
			onSuccess : function($form) {
			  	//alert('The form is valid!');
				doUpdate();
			  	return false; // Will stop the submission of the form
			}
		});
		$.validate({
			form : '#editimg',
			
			onError : function($form) {
			 	//alert('Kesalahan Penginputan Data, Perhatikan Kembali Data Yang Akan Dimasukkan !');
				toastr.error("Terdapat Data Yang Wajib Diisi, Perhatikan Kembali Data Yang Akan Dimasukkan","Kesalahan !");
			},
			onSuccess : function($form) {
			  	//alert('The form is valid!');
				doImg();
			  	return false; // Will stop the submission of the form
			}
		});
		$.validate({
			form : '#editpwd',
			modules : 'security',
			
			onError : function($form) {
			 	//alert('Kesalahan Penginputan Data, Perhatikan Kembali Data Yang Akan Dimasukkan !');
				toastr.error("Terdapat Data Yang Wajib Diisi, Perhatikan Kembali Data Yang Akan Dimasukkan","Kesalahan !");
			},
			onSuccess : function($form) {
			  	//alert('The form is valid!');
				doPwd();
			  	return false; // Will stop the submission of the form
			}
		});
		
		function doUpdate()	{
			toastr.clear();
			$('#btnEdtbtl').attr("disabled", true);
			$('#btnEdtx').removeAttr("data-dismiss");
			$('#btnEdt').attr("disabled", true).html('Sedang Memproses <i class="fa fa-spinner fa-pulse fa-fw"></i>');

			var data = new FormData();
			data.append('var1', $("#nipe").val());
			data.append('var2', $("#pegawaie").val());
			data.append('var3', $("input[name=jke]:checked").val());// JK ???
			data.append('var4', $("#bidange").val());
			data.append('var5', $("#jabatane").val());
			data.append('var6', $("#alamate").val());
			data.append('var7', $("#tlpe").val());
			data.append('var8', $("#emaile").val());
			//data.append('var9', resp);
			data.append('var10', $("#usernamee").val());
			data.append('var11', $("#pwd1e").val());
			data.append('var12', $("#id").val());

			var txt = '<i class="fa fa-plus" aria-hidden="true"></i> Perbaharui Data';
			$.ajax({
				url: 'incdo/dopegawai.php?do=update', // File tujuan
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
						$('#btnEdtbtl').removeAttr("disabled");
						$('#btnEdtx').attr("data-dismiss","modal");
						$('#btnEdt').removeAttr("disabled").html(txt);
						$('#exampleEdit').modal('hide');
						setTimeout(function() {
							$('#ui-view').load("incpart/dtpegawai.php");
						}, 500);
					}
					else{
						//alert(response.pesan);
						toastr.error(response.pesan,"Kesalahan !");
						$('#btnEdtbtl').removeAttr("disabled");
						$('#btnEdtx').attr("data-dismiss","modal");
						$('#btnEdt').removeAttr("disabled").html(txt);
					}
				},
				error: function(xhr,err){
					alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n\n1:loading, 2:loaded, 3:interactive, 4:complete.\n404: not found, 500: server error, 200: ok.");
					alert("responseText: "+xhr.responseText);
				}
			});
		}
		
		function doImg()	{
			toastr.clear();
			$uploadCrop.croppie('result', {
				type: 'canvas',
				size: 'viewport'
			}).then(function (resp) {
				$('#btnImgbtl').attr("disabled", true);
				$('#btnEdtx').removeAttr("data-dismiss");
				$('#btnImg').attr("disabled", true).html('Sedang Memproses <i class="fa fa-spinner fa-pulse fa-fw"></i>');

				var data = new FormData();
        		data.append('var1', resp);
				data.append('var2', $("#idcp").val());

				var txt = '<i class="fa fa-plus" aria-hidden="true"></i> Perbaharui Data';
				$.ajax({
					url: 'incdo/dopegawai.php?do=updateimg', // File tujuan
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
							$('#btnImgbtl').removeAttr("disabled");
							$('#btnEdtx').attr("data-dismiss","modal");
							$('#btnImg').removeAttr("disabled").html(txt);
							$('#exampleEdit').modal('hide');
							setTimeout(function() {
								$('#ui-view').load("incpart/dtpegawai.php");
							}, 500);
						}
						else{
							//alert(response.pesan);
							toastr.error(response.pesan,"Kesalahan !");
							$('#btnImgbtl').removeAttr("disabled");
							$('#btnEdtx').attr("data-dismiss","modal");
							$('#btnImg').removeAttr("disabled").html(txt);
						}
					},
					error: function(xhr,err){
						alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n\n1:loading, 2:loaded, 3:interactive, 4:complete.\n404: not found, 500: server error, 200: ok.");
						alert("responseText: "+xhr.responseText);
					}
				});
			});
		}
		
		function doPwd()	{
			toastr.clear();
			$('#btnPwdbtl').attr("disabled", true);
			$('#btnEdtx').removeAttr("data-dismiss");
			$('#btnPwd').attr("disabled", true).html('Sedang Memproses <i class="fa fa-spinner fa-pulse fa-fw"></i>');
			
			var data = new FormData();
        	data.append('var1', $("#pwdlm").val());
			data.append('var2', $("#pwdbrk").val());
			data.append('var3', $("#idc").val());
			
			var txt = '<i class="fa fa-plus" aria-hidden="true"></i> Perbaharui Data';
			$.ajax({
				url: 'incdo/dopegawai.php?do=updatepass', // File tujuan
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
						$('#btnPwdbtl').removeAttr("disabled");
						$('#btnEdtx').attr("data-dismiss","modal");
						$('#btnPwd').removeAttr("disabled").html(txt);
						$('#exampleEdit').modal('hide');
						setTimeout(function() {
							$('#ui-view').load("incpart/dtadmin.php");
						}, 500);
					}
					else{
						//alert(response.pesan);
						toastr.error(response.pesan,"Kesalahan !");
						$('#btnPwdbtl').removeAttr("disabled");
						$('#btnEdtx').attr("data-dismiss","modal");
						$('#btnPwd').removeAttr("disabled").html(txt);
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