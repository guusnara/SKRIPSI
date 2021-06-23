<?php session_start(); include('../incdo/config.php'); ?>

<div class="animated fadeIn">
<div class="row">
	<div class="col-md-12">
		<button id="tmb" href="#" class="btn btn-outline-success btn-lg" data-toggle="modal" data-target="#exampleModalLong" role="button" data-backdrop="static" data-keyboard="false"><i class="fa fa-fw fa-user-plus"></i> Tambah Admin</button>
	</div>
</div>

<div class="mb-3"></div>

<div class="row">
<div class="col-md-12">
<div class="table-responsive">
<table class="table table-bordered table-striped table-hover" width="100%" id="dataTable" cellspacing="0">
<thead>
  <tr>
	<th>Nama Admin</th>
	<th>Nomor Telepon</th>
	<th class="act">Aksi</th>
  </tr>
</thead>
<tbody>
<?php $a = mysql_query("select * from dt_admin");
while($b = mysql_fetch_array($a))	{ ?>
  <tr>
	<td><?= $b[1]; ?></td>
	<td><?= $b[2]; ?></td>
	<td>
		<button class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleEdit" data-id="<?= $b[0]; ?>" data-nm="<?= $b[1]; ?>" data-tlp="<?= $b[2]; ?>" data-user="<?= $b[3]; ?>" title="Perbaharui Data" data-backdrop="static" data-keyboard="false">
			<i class="fa fa-fw fa-pencil-square-o"></i>
			<span class="shw-mobile"> Perbaharui Data</span>
		</button>
		<button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exampleDelete" data-id="<?= $b[0]; ?>" title="Hapus Data" data-backdrop="static" data-keyboard="false">
			<i class="fa fa-fw fa-trash-o"></i>
			<span class="shw-mobile"> Hapus Data</span>
		</button>
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
<script>
	$(document).ready(function(){
		$(".ext").click(function(){
			$('#add').get(0).reset();
			$('#editad').get(0).reset();
			$('#editpwd').get(0).reset();
		});
	});
</script>
<script>
  // Call the dataTables jQuery plugin
  $(document).ready(function() {
	$('#dataTable').DataTable();
  });
</script>

<!-- Modal ADD -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="Tambah Admin" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Tambah Admin</h5>
        <button id="btnDox" type="button" class="close ext" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="add">
      <div class="modal-body">

          <div class="form-group">
            <label for="admin" class="form-control-label">Nama Admin</label>
            <input type="text" class="form-control" name="admin" id="admin" data-validation="custom length" data-validation-regexp="^[A-z\s]+$" data-validation-length="max30">
          </div>
          <div class="form-group">
            <label for="tlp" class="form-control-label">Nomor Telepon</label>
            <input type="text" class="form-control" name="tlp" id="tlp" data-validation="custom length" data-validation-regexp="^[0-9]+$" data-validation-length="max12">
          </div>
          <div class="form-group">
            <label for="username" class="form-control-label">Username</label>
            <input type="text" class="form-control" name="username" id="username" data-validation="alphanumeric length server" data-validation-allowing="_" data-validation-length="5-16" data-validation-url="incdo/dtadmin-cuser.php">
          </div>
          <div class="form-group">
            <label for="pwd1" class="form-control-label">Password</label>
            <input type="password" name="pwd1" id="pwd1" class="form-control" data-validation="length" data-validation-length="min8">
          </div>
          <div class="form-group">
            <label for="pwd2" class="form-control-label">Konfirmasi Password</label>
            <input type="password" name="pwd2" id="pwd2" class="form-control" data-validation="confirmation" data-validation-confirm="pwd1">
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
		$.validate({
			form : '#add',
			modules : 'security',
			
			onError : function($form) {
			 	//alert('Kesalahan Penginputan Data, Perhatikan Kembali Data Yang Akan Dimasukkan !');
				toastr.error("Terdapat Data Yang Wajib Diisi, Perhatikan Kembali Data Yang Akan Dimasukkan","Kesalahan !");
			},
			onSuccess : function($form) {
			  	//alert('The form is valid!');
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
        	data.append('var1', $("#admin").val());
			data.append('var2', $("#tlp").val());
			data.append('var3', $("#username").val());
			data.append('var4', $("#pwd2").val());
			
			var txt = '<i class="fa fa-plus" aria-hidden="true"></i> Tambah Data';
			$.ajax({
				url: 'incdo/doadmin.php?do=add', // File tujuan
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
						$('#btnDobtl').removeAttr("disabled");
						$('#btnDox').attr("data-dismiss","modal");
						$('#btnDo').removeAttr("disabled").html(txt);
						$('#exampleModalLong').modal('hide');
						setTimeout(function() {
							$('#ui-view').load("incpart/dtadmin.php");
						}, 500);
					}
					else{
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
		}
	});
</script>

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
		<a class="nav-link" id="infopass-tab" data-toggle="pill" href="#infopass" role="tab" aria-controls="infopass" aria-expanded="true">Ubah Password</a>
	  </li>
	</ul>
	<div class="tab-content" id="pills-tabContent">
	  <div class="tab-pane fade show active" id="infopribadi" role="tabpanel" aria-labelledby="infopribadi">
	  		<form id="editad">
			  <div class="modal-body">

				  <div class="form-group">
					<label for="admine" class="form-control-label">Nama Admin</label>
					<input type="text" class="form-control" name="admine" id="admine" data-validation="custom length" data-validation-regexp="^[A-z\s]+$" data-validation-length="max30">
				  </div>
				  <div class="form-group">
					<label for="tlpe" class="form-control-label">Nomor Telepon</label>
					<input type="text" class="form-control" name="tlpe" id="tlpe" data-validation="custom length" data-validation-regexp="^[0-9]+$" data-validation-length="max12">
				  </div>
				  <div class="form-group">
					<label for="usernamee" class="form-control-label">Username</label>
					<input type="text" class="form-control" name="usernamee" id="usernamee" data-validation="alphanumeric length server" data-validation-allowing="_" data-validation-length="5-16">
				  </div>
				  <div class="form-group">
					<label for="pwd1e" class="form-control-label">Masukkan Password Untuk Melakukan Proses</label>
					<input type="password" name="pwd1e" id="pwd1e" class="form-control" data-validation="length" data-validation-length="min8">
					<input type="hidden" name="id" id="id" class="form-control">
				  </div>

			  </div>
			  <div class="modal-footer">
				<button type="button" id="btnEdtbtl" class="btn btn-secondary ext" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Batal</button>
				<div id="btnplc"></div>
				<button type="submit" id="btnEdt" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Perbaharui Data</button>
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
		$('#exampleEdit').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) // Button that triggered the modal
		  var id = button.data('id')
		  var nm = button.data('nm')
		  var tlp = button.data('tlp')
		  var user = button.data('user')// Extract info from data-* attributes
		  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
		  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
		  var modal = $(this)
		  modal.find('.modal-title').text('Perbaharui Data ' + nm)
		  modal.find('#id').val(id)
		  modal.find('#idc').val(id)
		  modal.find('#admine').val(nm)
		  modal.find('#tlpe').val(tlp)
		  modal.find('#usernamee').val(user)
		  $('#usernamee').attr("data-validation-url","incdo/dtadmin-cuserup.php?id="+id);
		});
		
		$.validate({
			form : '#editad',
			
			onError : function($form) {
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
        	data.append('var1', $("#admine").val());
			data.append('var2', $("#tlpe").val());
			data.append('var3', $("#usernamee").val());
			data.append('var4', $("#pwd1e").val());
			data.append('var5', $("#id").val());
			
			var txt = '<i class="fa fa-plus" aria-hidden="true"></i> Perbaharui Data';
			$.ajax({
				url: 'incdo/doadmin.php?do=update', // File tujuan
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
							$('#ui-view').load("incpart/dtadmin.php");
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
				url: 'incdo/doadmin.php?do=updatepass', // File tujuan
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
				url: 'incdo/doadmin.php?do=delete', // File tujuan
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
							$('#ui-view').load("incpart/dtadmin.php");
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