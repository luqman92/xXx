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
//PROSES HAPUS DATA
if(isset($_GET['aksi']))
{
    if($_GET['aksi'] == 'hapus')
    {
        //BACA ID DARI PARAMETER ID PAKET YANG AKAN DIHAPUS
        $id_paket = $_GET['id'];
        //PROSES HAPUS DATA PAKET BERDASARKAN ID VIA METHOD
        $paket->hapusPaket($id_paket);
        ?>
            <script>
                alert("Data Paket ID <?php echo $id_paket; ?> sudah dihapus");
                document.location="?mod=data-paket";
            </script>
        <?php
    }
    
    //PROSES EDIT DATA
    else if($_GET['aksi'] == 'edit')
    {
        //BACA ID PAKET YANG AKAN DI EDIT
        $id_paket = $_GET['id'];
        //MENAMPILKAN FORM EDIT PAKET
        //UNTUK MENAMPILKAN DATA DETIL PAKET, GUNAKAN METHOD bacaDataPaket()
?>
<div class="row">
    <div class="col-md-12">
        <h1 class="page-head-line">UBAH DATA PAKET</h1>
        <h1 class="page-subhead-line">
            <ol class="breadcrumb">
                <li><a style="text-decoration: none;" href="./">Home</a></li>
                <li><a style="text-decoration: none;" href="?mod=data-paket">Data Paket</a></li>
                <li class="active">Ubah Data Paket</li>
            </ol>
        </h1>
    </div>
</div>

<form action="?mod=ubah-paket&aksi=update" method="post">
    <input type="hidden" name="id_paket" value="<?php echo $id_paket; ?>" />
    <div class="form-group">
        <label>Nama Paket</label>
        <input class="form-control" type="text" name="nama_paket" value="<?php echo $paket->bacaDataPaket('nama_paket',$id_paket) ?>" />
    </div>
    
    <div class="form-group">
        <label>Harga</label>
        <input class="form-control" type="text" name="harga_paket" value="<?php echo $paket->bacaDataPaket('harga_paket',$id_paket) ?>" />
    </div>
    
    <div class="form-group">
        <label>Administrasi</label>
        <input class="form-control" type="text" name="administrasi" value="<?php echo $paket->bacaDataPaket('administrasi',$id_paket) ?>" />
    </div>
    
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="btnSimpan" value="Simpan" />
    </div>
</form>
<?php
}else if($_GET['aksi']=='update'){
    //UPDATE DATA PAKET VIA METHOD
        $paket->updateDataPaket($_POST['id_paket'],$_POST['nama_paket'],$_POST['harga_paket'],$_POST['administrasi']);
        ?>
        <script>
            alert("Data Paket sudah di update");
            document.location="?mod=data-paket";
        </script>
        <?php
    }
}
?>