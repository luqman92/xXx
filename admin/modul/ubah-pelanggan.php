<?php
include_once '../config/class.php';
include_once '../config/lib.php';

// instance objek user
$user = new User();

// instance objek pelanggan
$pelanggan = new Pelanggan();

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
        //BACA ID DARI PARAMETER ID NASABAH YANG AKAN DIHAPUS
        $id_plg = $_GET['id_plg'];
        //PROSES HAPUS DATA NASABAH BERDASARKAN ID VIA METHOD
        $pelanggan->hapusPelanggan($id_plg,$iduser);
        ?>
            <script>
                alert("Data Nasabah ID <?php echo $id_plg; ?> sudah dihapus");
                document.location="?mod=data-pelanggan";
            </script>
        <?php
    }
    
    //PROSES EDIT DATA
    else if($_GET['aksi'] == 'edit')
    {
        //BACA ID NASABAH YANG AKAN DI EDIT
        $id_plg = $_GET['id_plg'];
        //MENAMPILKAN FORM EDIT NASABAH
        //UNTUK MENAMPILKAN DATA DETIL NASABAH, GUNAKAN METHOD bacaDataPelanggan()
?>
<script>
    function checkForm(formZ){
        if(formZ.nama.value==''){
            alert('Nama Nasabah tidak boleh kosong.');
            formZ.nama.focus();
            return false;
        }
        
    }
</script>
<div class="row">
    <div class="col-md-12">
        <h1 class="page-head-line">UBAH NASABAH</h1>
        <h1 class="page-subhead-line">
            <ol class="breadcrumb">
                <li><a style="text-decoration: none;" href="./">Home</a></li>
                <li><a style="text-decoration: none;" href="?mod=data-pelanggan">Data Nasabah</a></li>
                <li class="active">Ubah Nasabah</li>
            </ol>
        </h1>
    </div>
</div>
<!-- /. ROW  -->
<div class="row">
    
    <div class="col-md-2">
    
    </div>
    
    <div class="col-md-8">
        <form name="pelanggan" role="form" action="?mod=ubah-pelanggan&aksi=update" method="post" onsubmit="return checkForm(this)">
            <div class="form-group">
                <label>ID Nasabah</label>
                <input class="form-control" type="text" name="id_pelanggan" value="<?php echo $pelanggan->bacaDataPelanggan('id_pelanggan',$id_plg) ?>" readonly="on" />
                <p class="help-block"></p>
            </div>
            
            <div class="form-group">
                <label>Nama</label>
                <input class="form-control" type="text" name="nama" value="<?php echo $pelanggan->bacaDataPelanggan('nama',$id_plg) ?>" />
                <p class="help-block"></p>
            </div>
           
            <div class="form-group">
                <label>Alamat</label>
                <textarea class="form-control" rows="3" name="alamat"><?php echo $pelanggan->bacaDataPelanggan('alamat',$id_plg) ?></textarea>
            </div>
            
            <div class="form-group">
                <label>Telepon</label>
                <input class="form-control" type="text" name="telepon" value="<?php echo $pelanggan->bacaDataPelanggan('telepon',$id_plg) ?>" />
                <p class="help-block">Masukkan nomor telepon yang valid.</p>
            </div>
           
            <input type="submit" name="btnsimpan" class="btn btn-info" value="Simpan" />
        </form>
       
    </div>
    
    <div class="col-md-2">
    
    </div>
</div>
<?php
    }
    else if($_GET['aksi'] == 'update') {
        //UPDATE DATA NASABAH VIA METHOD
        $pelanggan->updateDataPelanggan($_POST['id_pelanggan'],$_POST['nama'], $_POST['alamat'], $_POST['telepon'],$iduser);
        ?>
        <script>
            alert("Data Pelanggan sudah di update");
            document.location="?mod=data-pelanggan";
        </script>
        <?php
    }
}
?>