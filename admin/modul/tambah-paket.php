<?php
include_once '../config/class.php';
include_once '../config/lib.php';

// instance objek user
$user = new User();

//instance objek paket
$paket = new Paket();

$iduser = $_SESSION['id_user'];
if (!$user->get_sesi()) {
  header("location:../");
}
?>
<div class="row">
    <div class="col-md-12">
        <h1 class="page-head-line">TAMBAH PAKET</h1>
        <h1 class="page-subhead-line">
            <ol class="breadcrumb">
                <li><a style="text-decoration: none;" href="./">Home</a></li>
                <li><a style="text-decoration: none;" href="?mod=data-paket">Data Paket</a></li>
                <li class="active">Tambah Paket</li>
            </ol>
        </h1>
    </div>
</div>

<form action="" method="post">
    <div class="form-group">
        <label>Nama Paket</label>
        <input class="form-control" type="text" name="nama_paket" />
    </div>
    
    <div class="form-group">
        <label>Harga</label>
        <input class="form-control" type="text" name="harga_paket" />
    </div>
    
    <div class="form-group">
        <label>Administrasi</label>
        <input class="form-control" type="text" name="administrasi" />
    </div>
    
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="btnSimpan" value="Simpan" />
    </div>
</form>
<?php
if(isset($_POST['btnSimpan'])){
    $nama_paket     = $_POST['nama_paket'];
    $harga_paket    = $_POST['harga_paket'];
    $administrasi   = $_POST['administrasi'];
    $paket->simpanPaket($nama_paket,$harga_paket,$administrasi);
    ?>
    <script>
        alert("Paket sudah ditambah");
        document.location="?mod=tambah-paket";
    </script>
    <?php
}
?>