<?php session_start(); include('../incdo/config.php'); ?>
<div class="animated fadeIn">
<div class="row">
	<div class="col-md-12">
		<button href="#" class="btn btn-outline-success btn-lg" data-toggle="modal" data-target="#exampleModalLong" role="button" data-backdrop="static" data-keyboard="false"><i class="fa fa-fw fa-user-plus"></i> Tambah Bidang</button>
	</div>
</div>

<div class="mb-3"></div>

<div class="row">
<div class="col-md-12">
<div class="table-responsive">
<table class="table table-bordered table-striped table-hover" width="100%" id="dataTable" cellspacing="0">
<thead>
  <tr>
	<th>Nama Bidang</th>
	<th class="act">Aksi</th>
  </tr>
</thead>
<tbody>
<?php $a = mysql_query("select * from dt_bidang");
while($b = mysql_fetch_array($a))	{ ?>
  <tr>
	<td><?= $b[1]; ?></td>
	<td>
		<button class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleEdit" data-id="<?= $b[0]; ?>" data-nya="<?= $b[1]; ?>" title="Perbaharui Data" data-backdrop="static" data-keyboard="false">
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
        <h5 class="modal-title" id="exampleModalLongTitle">Tambah Bidang</h5>
        <button id="btnDox" type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       
        <!--<form> -->
          <div class="form-group">
            <label for="bidang" class="form-control-label">Nama Bidang</label>
            <input type="text" class="form-control" name="bidang" id="bidang">
          </div>
        <!--</form> -->
        
      </div>
      <div class="modal-footer">
        <button type="button" id="btnDobtl" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Batal</button>
        <button type="button" id="btnDo" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Data</button>
      </div>
    </div>
  </div>
</div>
<script>
	$(document).ready(function(){
		$("#btnDo").click(function(){
			toastr.clear();
			$('#btnDobtl').attr("disabled", true);
			$('#btnDox').removeAttr("data-dismiss");
			$('#btnDo').attr("disabled", true).html('Sedang Memproses <i class="fa fa-spinner fa-pulse fa-fw"></i>');
			
			var data = new FormData();
        	data.append('var1', $("#bidang").val());
			
			var txt = '<i class="fa fa-plus" aria-hidden="true"></i> Tambah Data';
			$.ajax({
				url: 'incdo/dobidang.php?do=add', // File tujuan
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
							$('#ui-view').load("incpart/dtbidang.php");
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
		});
	});
</script>


<!-- Edit -->
<div class="modal fade" id="exampleEdit" tabindex="-1" role="dialog" aria-labelledby="Edit Admin" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Perbaharui Data</h5>
        <button id="btnEdtx" type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       
        <!--<form>-->
          <div class="form-group">
            <label for="bidangs" class="form-control-label">Nama Bidang</label>
            <input type="text" class="form-control" name="bidangs" id="bidangs">
            <input type="hidden" class="form-control" name="id" id="id">
          </div>
        <!--</form>-->
        
      </div>
      <div class="modal-footer">
        <button type="button" id="btnEdtbtl" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Batal</button>
        <button type="button" id="btnEdt" class="btn btn-success"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Perbaharui Data</button>
      </div>
    </div>
  </div>
</div>
<script>
	$('#exampleEdit').on('show.bs.modal', function (event) {
	  var button = $(event.relatedTarget) // Button that triggered the modal
	  var nya = button.data('nya')
	  var id = button.data('id')// Extract info from data-* attributes
	  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
	  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
	  var modal = $(this)
	  modal.find('.modal-title').text('Perbaharui Data ' + nya)
	  modal.find('#bidangs').val(nya)
	  modal.find('#id').val(id)
	});
	
	$(document).ready(function(){
		$("#btnEdt").click(function(){
			toastr.clear();
			$('#btnEdtbtl').attr("disabled", true);
			$('#btnEdtx').removeAttr("data-dismiss");
			$('#btnEdt').attr("disabled", true).html('Sedang Memproses <i class="fa fa-spinner fa-pulse fa-fw"></i>');
			
			var data = new FormData();
        	data.append('var1', $("#bidangs").val());
			data.append('id', $("#id").val());
			
			var txt = '<i class="fa fa-pencil-square-o" aria-hidden="true"></i>  Perbaharui Data';
			$.ajax({
				url: 'incdo/dobidang.php?do=update', // File tujuan
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
							$('#ui-view').load("incpart/dtbidang.php");
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
		});
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
				url: 'incdo/dobidang.php?do=delete', // File tujuan
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
							$('#ui-view').load("incpart/dtbidang.php");
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