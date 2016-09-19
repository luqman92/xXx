<?php
session_start();
include_once '../config/class.php';

$db = new Database();

// koneksi ke MySQL via method
$db->connectMySQL();

$user = new User();
$iduser = $_SESSION['id_user'];
if (!$user->get_sesi())
{
header("location:../lq-login");
}
if (@$_GET['mod'] == 'logout')
{
$user->user_logout();
header("location:../lq-login");
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Paket Setiawati</title>

    <!-- BOOTSTRAP STYLES-->
    <link href="../assets/css/bootstrap.css" rel="stylesheet" />
    <!-- BOOTSTRAP STYLES-->
    <link href="../assets/css/select2.min.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="../assets/css/font-awesome.css" rel="stylesheet" />
       <!--CUSTOM BASIC STYLES-->
    <link href="../assets/css/basic.css" rel="stylesheet" />
    <!--CUSTOM MAIN STYLES-->
    <link href="../assets/css/custom.css" rel="stylesheet" />
    <!-- DATA TABLES STYLES -->
    <link href="../assets/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
    <!-- JQUERY UI STYLE -->
    <link href="../assets/css/jquery-ui.css" rel="stylesheet">
    

    <!-- JQUERY SCRIPTS -->
    <script src="../assets/js/jquery-1.10.2.js"></script>
    <!-- JQUERY SCRIPTS -->
    <script src="../assets/js/select2.min.js"></script>
    
    <!-- JQUERY SCRIPTS -->
    <script src="../assets/js/jqClock.min.js"></script>
<script>
  $(document).ready(function(){
    $("#clock").clock({"format":"24","calendar":"false"});
  });
</script>
    
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <?php include_once "topnav.php"; ?>
        </nav>
        <!-- /. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <?php include_once "sidenav.php" ?>
                </ul>

            </div>

        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">
                <?php include_once "content.php" ?>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->

    <div id="footer-sec">
        &copy; 2003 - 2015 Paket Setiawati | Develope By : <a href="#" target="_blank">Luqman Hakim Nadzari</a> Versi 1.1
    </div>
    <!-- /. FOOTER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="../assets/js/bootstrap.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="../assets/js/jquery.metisMenu.js"></script>
    <!-- CUSTOM SCRIPTS -->
    <script src="../assets/js/custom.js"></script>
    <!-- DATA TABLES SCRIPT -->
    <script src="../assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="../assets/js/dataTables/dataTables.bootstrap.js"></script>
</body>
</html>
