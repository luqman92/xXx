<?php
include_once '../config/class.php';
include_once '../config/lib.php';

$newKelompok = new Kelompok();

//PROSES HAPUS DATA
if(isset($_GET['aksi']))
{
    if($_GET['aksi'] == 'hapus')
    {
        //BACA ID DARI PARAMETER ID KELOMPOK YANG AKAN DIHAPUS
        $idkel = $_GET['idkel'];
        //PROSES HAPUS DATA KELOMPOK BERDASARKAN ID VIA METHOD
        $newKelompok->hapusKelompok($idkel,$iduser);
        ?>
            <script>
                alert("Data Kelompok ID <?php echo $idkel; ?> sudah dihapus");
                document.location="?mod=data-kelompok";
            </script>
        <?php
    }
    
    //PROSES EDIT DATA
    else if($_GET['aksi'] == 'edit')
    {
        //BACA ID KELOMPOK YANG AKAN DI EDIT
        $idkel = $_GET['idkel'];
        //MENAMPILKAN FORM EDIT KELOMPOK
        //UNTUK MENAMPILKAN DATA DETIL KELOMPOK, GUNAKAN METHOD bacaDataPelanggan()
?>
<script>
    function checkForm(formZ){
        if(formZ.nama.value==''){
            alert('Nama Kelompok tidak boleh kosong.');
            formZ.nama.focus();
            return false;
        }
        
    }
</script>
<div class="row">
    <div class="col-md-12">
        <h1 class="page-head-line">UBAH KELOMPOK</h1>
        <h1 class="page-subhead-line">
            <ol class="breadcrumb">
                <li><a style="text-decoration: none;" href="./">Home</a></li>
                <li><a style="text-decoration: none;" href="?mod=data-user">Data Kelompok</a></li>
                <li class="active">Ubah Kelompok</li>
            </ol>
        </h1>
    </div>
</div>
<!-- /. ROW  -->
<div class="row">
    
    <div class="col-md-2">
    
    </div>
    
    <div class="col-md-8">
        <form name="kelompok" role="form" action="?mod=ubah-kelompok&aksi=update" method="post" onsubmit="return checkForm(this)">
        <input type="hidden" name="id_kelompok" value="<?php echo $idkel; ?>" />
            <div class="form-group">
                <label>Nama Kelompok</label>
                <input class="form-control" type="text" name="nama_kelompok" autofocus="on" value="<?php echo $newKelompok->bacaDataKelompok('nama_kelompok',$idkel) ?>" />
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
        //UPDATE DATA PELANGGAN VIA METHOD
        $newKelompok->updateDataKelompok($_POST['id_kelompok'], $_POST['nama_kelompok'],$iduser);    
    ?>
        <script>
            alert("Data kelompok sudah di update");
            document.location="?mod=data-kelompok";
        </script>
        <?php
    }
}
?>