<?php
include_once 'config/class.php';

/*$user = new User();
if ($user->get_sesi())
{
header("location:index.php");
}else{

}*/

$page=htmlentities(@$_GET['page']);
$halaman="page/$page.php";

if(!file_exists($halaman) || empty($page)){
	include "page/home.php";
}else{
	include "$halaman";
}
?>