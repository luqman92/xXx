<?php
$nama       = $_POST['nama'];
$alamat     = $_POST['alamat'];
$telepon    = $_POST['telepon'];
$id_paket   = $_POST['id_paket'];
$keterangan = $_POST['keterangan'];

$result = $db->query("INSERT INTO tb_pendaftaran SET nama='".$nama."', alamat='".$alamat."', telepon='".$telepon."', id_paket='".$id_paket."', keterangan='".$keterangan."', tgl_daftar=now()");

if($result){
    ?>
        <script>
            alert("Tambah data berhasil");
            document.location="index.php?mod=pendaftaran";
        </script>
    <?php
}else{
    ?>
        <script>
            alert("Tambah data gagal");
            document.location="javascript:history.back(-1)";
        </script>
    <?php
}
?>