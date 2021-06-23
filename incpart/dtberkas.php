<?php session_start(); include('../incdo/config.php'); ?>
<?php $a=''; $nip = ''; if(isset($_SESSION['pegawai']))	{
	$nip = $_SESSION['pegawai']['NIP'];
	$a = mysql_query("select * from dt_berkas where NIP='$nip'");
} elseif(isset($_SESSION['admin']))	{
	$nip = $_SESSION['admin']['id_admin'];
	$a = mysql_query("select * from dt_berkas join dt_pegawai on dt_berkas.NIP = dt_pegawai.NIP order by dt_pegawai.nama_pegawai asc");
} ?>
<div class="animated fadeIn">
<div class="row">
<div class="col-md-12">
<div class="table-responsive">
<table class="table table-bordered table-striped table-hover" width="100%" id="dataTable" cellspacing="0">
<thead>
  <tr>
  	<th>No</th>
	<th>Nama Berkas</th>
	<th>Ekstensi</th>
	<th>Ukuran</th>
	<?php if(isset($_SESSION['admin']))	{ ?>
		<th>Pemilik</th>
	<?php } ?>
	<th class="act">Aksi</th>
  </tr>
</thead>
<tbody>
<?php $no = 1;
while($b = mysql_fetch_array($a))	{ ?>
  <tr>
    <td><?= $no; ?></td>
	<td><?= $b[1]; ?></td>
	<td><?= $b[2]; ?></td>
	<td><?= $b[3]; ?> mb</td>
	<?php if(isset($_SESSION['admin']))	{ ?>
		<td><?= $b[7]; ?></td>
	<?php } ?>
	<td>
		<a class="btn btn-info btn-sm" title="Download" href="pegawaidb/<?= $b[4]; ?>" target="_blank" role="button">
			<i class="fa fa-fw fa-download"></i>
			<span class="shw-mobile"> Download</span>
		</a>
		<button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exampleDelete" data-id="<?= $b[0]; ?>" title="Hapus Data" data-backdrop="static" data-keyboard="false">
			<i class="fa fa-fw fa-trash-o"></i>
			<span class="shw-mobile"> Hapus Berkas</span>
		</button>
	</td>
  </tr>
<?php $no++; } ?>
</tbody>
</table>
</div>
</div>
</div>
</div>

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
				url: 'incdo/doberkas.php?do=delete', // File tujuan
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
							$('#ui-view').load("incpart/dtberkas.php");
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


<script>
  // Call the dataTables jQuery plugin
  $(document).ready(function() {
	$('#dataTable').DataTable();
  });
</script>