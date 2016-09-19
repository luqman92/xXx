<?php
session_start();
include_once 'config/class.php';
include_once 'config/lib.php';
$db = new Database();

// koneksi ke MySQL via method
$db->connectMySQL();

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <?php
    if(@$_GET['page'] == 'home'){ echo '<title>Home | Paket Setiawati</title>'; }
    elseif (@$_GET['page'] == 'tentang-kami') { echo '<title>Tentang kami | Paket Setiawati</title>'; }
    elseif (@$_GET['page'] == 'kontak') { echo '<title>Kontak | Paket Setiawati</title>';}
    elseif (@$_GET['page'] == 'persyaratan') { echo '<title>Persyaratan | Paket Setiawati</title>'; }
    elseif (@$_GET['page'] == 'daftar') { echo '<title>Daftar Online | Paket Setiawati</title>'; }
    else{  echo '<title>Home | Paket Setiawati</title>'; }
    ?>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap-united.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="assets/css/sticky-footer-navbar.css" rel="stylesheet">

    <!-- DATA TABLES STYLES -->
    <link href="assets/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
    <script src="assets/js/jquery-1.10.2.js"></script>
    <script type="text/javascript">
        function hitung() {
            var a = $("#jumlah").val();
            var b = $("#kurs_usd").val();
            hasil = a * b; //a kali b
            $("#hasil").val(hasil);
        }
</script>
  </head>

  <body>

    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
      <?php include "nav.php"; ?>
    </nav>

    <!-- Begin page content -->
    <div class="container">
      <?php
      include "content.php";
      ?>
    </div>

    <footer class="footer">
      <div class="container">
        <p class="text-muted">Paket Setiawati 2003 - 2015, Develope by <a target="_blank" href="http://twitter.com/@nadzari">Luqman Hakim Nadzari</a></p>
      </div>
    </footer>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/bootstrap.js"></script>
    <!-- DATA TABLES SCRIPT -->
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
  </body>
</html>
