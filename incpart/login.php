<body class="app flex-row align-items-center">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card-group">
          <div class="card p-4">
            <div class="card-body">
              <h1>Login</h1>
              <p class="text-muted">Aplikasi Manajemen Kelompok Kerja</p>
              <div class="input-group mb-3">
                <span class="input-group-addon"><i class="icon-user"></i></span>
                <input type="text" name="var_usn" class="form-control" id="exampleInputText1" placeholder="Username">
              </div>
              <div class="input-group mb-3">
                <span class="input-group-addon"><i class="icon-lock"></i></span>
                <input type="password" name="var_pwd" class="form-control" id="exampleInputPassword1" placeholder="Password">
              </div>
              <div class="input-group mb-2">
              	<label class="custom-control custom-checkbox">
				  <input type="checkbox" name="setcookie" class="custom-control-input">
				  <span class="custom-control-indicator"></span>
				  <span class="custom-control-description">Ingat saya nanti</span>
				</label>
              </div>
              <div class="row">
                <div class="col-6">
                  <button type="button" id="btnLogin" onclick="check_login();" class="btn btn-primary px-4">Login</button>
                </div>
              </div>
            </div>
          </div>
          <div class="card text-white py-5 d-md-down-none" style="background-color: #15455C; width:44%;">
            <div class="card-body text-center">
              <img class="img-fluid" src="img/logo_login.png">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</body> 
<script>
	 $(document).ready(function(){
	    toastr.options = {
		  "closeButton": true,
		  "progressBar": true,
		  "positionClass": "toast-top-center",
		  "preventDuplicates": true,
		  "onclick": null,
		  "showDuration": "300",
		  "hideDuration": "0",
		  "timeOut": "3000",
		  "extendedTimeOut": "1000",
		  "showMethod": "fadeIn",
		  "hideMethod": "fadeOut"
		}
		//toastr.success("Isinya","Judul");
	 });
  </script>
<script>
	$('#exampleInputText1').keypress(function(e) {
		if(e.which == 13) {
			$('#btnLogin').click();
		}
	});
	$('#exampleInputPassword1').keypress(function(e) {
		if(e.which == 13) {
			$('#btnLogin').click();
		}
	});
	
	function check_login()
	{
		toastr.clear();
		//Mengambil value dari input username & Password
		var username = $('#exampleInputText1').val();
		var password = $('#exampleInputPassword1').val();
		//Ubah alamat url berikut, sesuaikan dengan alamat script pada komputer anda
		var url_login	 = 'incdo/login.php';
		var url_admin	 = 'index.php';

		//Ubah tulisan pada button saat click login
		$('#btnLogin').html('Sedang Memproses <i class="fa fa-spinner fa-pulse fa-fw"></i>');

		//Gunakan jquery AJAX
		$.ajax({
			url		: url_login,
			//mengirimkan username dan password ke script login.php
			data	: 'var_usn='+username+'&var_pwd='+password, 
			//Method pengiriman
			type	: 'POST',
			//Data yang akan diambil dari script pemroses
			dataType: 'html',
			//Respon jika data berhasil dikirim
			success	: function(pesan){
				if(pesan=='ok'){
					//Arahkan ke halaman admin jika script pemroses mencetak kata ok
					window.location = url_admin;
				}
				else{
					//Cetak peringatan untuk username & password salah
					//alert(pesan);
					toastr.error(pesan,"Kesalahan !");
					$('#btnLogin').html('Login');
				}
			},
		});
	}
</script>