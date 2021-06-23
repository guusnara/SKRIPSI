<?php session_start(); include('../incdo/config.php');
if(isset($_SESSION['admin'])) {
  $sts = 1;
  //echo "<script type='text/javascript'>alert('Admin');</script>";
} elseif(isset($_SESSION['pegawai'])) {
  $sts = 0;
} ?>
<?php $nmuser = ''; if(isset($_SESSION['pegawai'])) {
  $nmuser = $_SESSION['pegawai']['nama_pegawai'];
  $nip = $_SESSION['pegawai']['NIP'];
} elseif(isset($_SESSION['admin'])) {
  $nmuser = $_SESSION['admin']['nama_admin'];
  $nip = $_SESSION['admin']['id_admin'];
} ?>
<div class="animated fadeIn">

<div class="row mb-3">
  <div class="col-md-12">
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <h5 class="alert-heading">Selamat Datang, <?= $nmuser; ?></h5>
      <hr style="margin-top: 0.5rem !important; margin-bottom: 0.5rem !important;">
      Anda dapat mengelola manajemen kerja anda pada dashboard ini.
    </div>
  </div>
  <div class="col-md-12">
  
  <?php if($sts == 1) { ?>
    
    <?php $dtnw = date("Y-m-d");
    $f = mysql_query("select * from dt_admin");
    $g = mysql_query("select * from dt_pegawai");
    $h = mysql_query("select * from dt_berkas");
    $i = mysql_query("select * from dt_kerja where tgl_mulai<='$dtnw' and status='0'");
    $j = mysql_query("select * from dt_kerja where tgl_mulai>'$dtnw' and status='0'");
    $k = mysql_query("select * from dt_kerja where status='1'");
    ?>
    <nav>
    <div class="row">
      <div class="col-md-4">
        <div class="card">
            <h5 class="card-header">Admin</h5>
          <ul class="list-group list-group-flush nav">
          <li class="list-group-item">Jumlah Admin : <?= mysql_num_rows($f); ?></li>
          <li class="list-group-item"><a class="btn btn-block btn-primary" href="dtadmin.php" role="button">Lihat Admin</a></li>
          </ul>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
            <h5 class="card-header">Pegawai</h5>
          <ul class="list-group list-group-flush nav">
          <li class="list-group-item">Jumlah Pegawai : <?= mysql_num_rows($g); ?></li>
          <li class="list-group-item"><a class="btn btn-block btn-primary" href="dtpegawai.php" role="button">Lihat Pegawai</a></li>
          </ul>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
            <h5 class="card-header">Berkas</h5>
          <ul class="list-group list-group-flush nav">
          <li class="list-group-item">Jumlah Berkas (Ukuran) : <?= mysql_num_rows($h); ?></li>
          <li class="list-group-item"><a class="btn btn-block btn-primary" href="dtberkas.php" role="button">Lihat Berkas</a></li>
          </ul>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
            <h5 class="card-header">Jumlah Project</h5>
          <ul class="list-group list-group-flush nav">
            <li class="list-group-item">Berlangsung : <?= mysql_num_rows($i); ?></li>
          <li class="list-group-item">Selesai : <?= mysql_num_rows($k); ?></li>
          <li class="list-group-item">Belum Berlangsung : <?= mysql_num_rows($j); ?></li>
          <li class="list-group-item"><a class="btn btn-block btn-primary" href="dtkerja.php" role="button">Lihat Project</a></li>
          </ul>
        </div>
      </div>
    </div>
    </nav>
  
  <?php } elseif($sts == 0) { ?>
  
    <div class="card">
      <h5 class="card-header bg-secondary text-white">Informasi Pribadi</h5>
      <div class="row">
          <div class="col-md-3">
            <?php $a = mysql_query("SELECT
            dt_pegawai.id_jabatan, dt_jabatan.nama_jabatan,
            dt_pegawai.id_bidang, dt_bidang.nama_bidang,
            dt_pegawai.email, dt_pegawai.no_telp, dt_pegawai.alamat, dt_pegawai.url_photo, dt_pegawai.jk, dt_pegawai.username
            FROM dt_pegawai
            JOIN dt_jabatan ON dt_pegawai.id_jabatan = dt_jabatan.id_jabatan
            JOIN dt_bidang ON dt_pegawai.id_bidang = dt_bidang.id_bidang
            WHERE dt_pegawai.NIP='$nip'
          "); $b = mysql_fetch_array($a); ?>
            <div class="card-body">
              <img class="mx-auto d-block img-fluid img-thumbnail" src="pegawaidb/<?= $b[7]; ?>" alt="Image">
            </div>
          </div>
          <div class="col-md-4">
            <ul class="list-group list-group-flush">
            <?php if($sts == 1) $lbnm = 'ID Admin'; else $lbnm = 'NIP'; ?>
            <li class="list-group-item"><strong><?= $lbnm; ?></strong> : <?= $nip; ?></li>
            <li class="list-group-item"><strong>Nama</strong> : <?= $nmuser; ?></li>
            <li class="list-group-item"><strong>Jabatan</strong> : <?= $b[1]; ?></li>
            <li class="list-group-item"><strong>Bidang</strong> : <?= $b[3]; ?></li>
            <li class="list-group-item"><strong>Email</strong> : <?= $b[4]; ?></li>
            </ul>
          </div>
          <div class="col-md-5">
            <ul class="list-group list-group-flush">
            <li class="list-group-item"><strong>No. Telp</strong> : <?= $b[5]; ?></li>
            <li class="list-group-item"><strong>Alamat</strong> : <?= $b[6]; ?></li>
            </ul>
            <div class="card-body">
              <?php $dt = 'data-nip="'.$nip.'" data-nm="'.$nmuser.'" data-bidang="'.$b[2].'" data-jabatan="'.$b[0].'" data-jk="'.$b[8].'" data-alamat="'.$b[6].'" data-tlp="'.$b[5].'" data-email="'.$b[4].'" data-url="'.$b[7].'" data-user="'.$b[9].'"'; ?>
              
            <button class="btn btn-info btn-block" data-toggle="modal" data-target="#exampleEdit" <?= $dt ?> title="Perbaharui Data" data-backdrop="static"><i class="fa fa-fw fa-pencil-square-o"></i> Perbaharui Data</button>
          </div>
          </div>
      </div>
    </div>
    
  <?php } ?>
    
  </div>
</div>

</div>

<?php if($sts == 0) { ?>
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
      $('#preview').empty();
      $('#preview').removeAttr("style class");
      $('#previewe').empty();
      $('#previewe').removeAttr("style class");
    });
  });
</script>

<?php include('loadedit.php'); ?>
<?php } ?>