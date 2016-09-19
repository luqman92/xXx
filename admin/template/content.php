<?php
include_once '../config/class.php';
$user = new User();
if (!$user->get_sesi())
{
header("location:index.php");
}
$mod=htmlentities(@$_GET['mod']);
$halaman="modul/$mod.php";

if(!file_exists($halaman) || empty($mod)){
	include "modul/home.php";
}else{
	include "$halaman";
	?>
	<!-- <div class="alert alert-danger" role="alert">
    	<strong>Sorry!</strong> Pages not found. <a href="javascript:history.back(-1)">Back to Previous</a>
    </div> -->
	<?php
}
?>