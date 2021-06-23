<?php
session_start();
include('incdo/config.php');
?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Aplikasi Manajemen Kelompok Kerja Dinas Kominfo Dan Statistik Kota Denpasar">
  <meta name="author" content="Ida Bagus Putu Eka Narayana">
  <meta name="keyword" content="Kominfo,Denpasar">
  <meta name="theme-color" content="#15455C">
  <link rel="shortcut icon" href="img/favicon.png">
  <title>Login</title>

    <!-- Bootstrap core CSS -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/stylefix.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="vendor/simple-line-icon/css/simple-line-icons.css" rel="stylesheet" type="text/css">
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- Plugin CSS -->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <link href="vendor/toastr/toastr-CoreUI.min.css" rel="stylesheet">
    
    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/popper/popper.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/toastr/toastr.min.js"></script>

  </head>

<?php include('incpart/login.php'); ?>


</html>
