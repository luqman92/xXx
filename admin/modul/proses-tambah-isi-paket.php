<?php
//echo "<pre>";
//print_r($_POST);
//echo "</pre>";
$id_paket           = $_POST['id_paket'];
$nama_paket_detail  = $_POST['nama_paket_detail'];
$isi                = $_POST['isi'];

$result = $db->query("INSERT INTO tb_paket_detail SET id_paket='".$id_paket."', nama_paket_detail='".$nama_paket_detail."', isi='".$isi."'");
if($result){
    ?>
        <script>
            //alert("Data tersimpan");
            document.location="index.php?mod=tambah-isi-paket";
        </script>
    <?php
}else{
    ?>
        <script>
            //alert("Data gagal  disimpan");
            document.location="javascript:history.back(-1)";
        </script>
    <?php
    
}
?>