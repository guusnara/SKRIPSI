<div class="modal fade" id="exampleView" tabindex="-1" role="dialog" aria-labelledby="Tambah Admin" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Informasi Pegawai</h5>
        <button type="button" class="close ext" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<div class="card">
      	  <div id="preview">
      	  
		  </div>
		  <div class="card-body">
			<h5 class="card-title text-center" id="nam">Nama</h5>
			<h6 class="card-subtitle text-muted text-center" id="np">NIP</h6>
			<center><strong>
				<span class="small text-muted" id="jbt">Jabatan</span><br>
				<span class="smaller text-muted" id="bdg">Jabatan</span>
			</strong></center>
		  </div>
		  <ul class="list-group list-group-flush">
			<li class="list-group-item text-center" id="tel">Telp</li>
			<li class="list-group-item text-center" id="ml">Email</li>
			<li class="list-group-item text-center" id="al">Alamat</li>
		  </ul>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" id="btnDobtl" class="btn btn-success ext" data-dismiss="modal"><i class="fa fa-check" aria-hidden="true"></i> Selesai</button>
      </div>
    </div>
  </div>
</div>
<script>
	$(document).ready(function(){
		
		$('#exampleView').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) // Button that triggered the modal
		  var nip = button.data('nip')
		  var nm = button.data('nm')
		  var bidang = button.data('bidang')
		  var jabatan = button.data('jabatan')
		  var jk = button.data('jk')
		  var alamat = button.data('alamat')
		  var tlp = button.data('tlp')
		  var email = button.data('email')
		  var url = button.data('url') // Extract info from data-* attributes
		  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
		  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
		  var modal = $(this)
		  modal.find('#np').text(nip)
		  $( "#jbt" ).load("incdo/showbdgjbt.php?apa=1&val="+jabatan);
		  $( "#bdg" ).load("incdo/showbdgjbt.php?apa=2&val="+bidang);
		  modal.find('#al').text(alamat)
		  modal.find('#tel').text(tlp)
		  modal.find('#ml').text(email)
		  modal.find('#nam').text(nm)
		  $('#preview').html('<img src="pegawaidb/'+url+'?'+new Date().getTime()+'" class="card-img-top" alt="image">')
		  //modal.find('#pht').attr('src','pegawaidb/'+url)
		});
		
	});
</script>