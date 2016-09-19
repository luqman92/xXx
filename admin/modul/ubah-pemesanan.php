<?php
include_once '../config/class.php';
include_once '../config/lib.php';

// instance objek user
$user = new User();

//instance objek paket
$pemesanan  = new Pemesanan();
$iduser = $_SESSION['id_user'];
if (!$user->get_sesi()) {
  header("location:../");
}

global $arr_status;
$arr_status["TIDAK AKTIF"] = "TIDAK AKTIF";
$arr_status["BELUM"] = "BELUM";
$arr_status["LUNAS"] = "LUNAS";
$arr_status["DIAMBIL"] = "DIAMBIL";

//PROSES HAPUS DATA
if(isset($_GET['aksi']))
{
    if($_GET['aksi'] == 'edit')
    {
        //BACA ID PAKET YANG AKAN DI EDIT
        $id_pemesanan = $_GET['id'];
        //MENAMPILKAN FORM EDIT PAKET
        //UNTUK MENAMPILKAN DATA DETIL PAKET, GUNAKAN METHOD bacaDataPaket()
?>
<div class="row">
    <div class="col-md-12">
        <h1 class="page-head-line">UBAH DATA PEMESANAN</h1>
        <h1 class="page-subhead-line">
            <ol class="breadcrumb">
                <li><a style="text-decoration: none;" href="./">Home</a></li>
                <li><a style="text-decoration: none;" href="?mod=data-pemesanan">Data Pemesanan</a></li>
                <li class="active">Ubah Data Pemesanan</li>
            </ol>
        </h1>
    </div>
</div>

<form action="?mod=ubah-pemesanan&aksi=update" method="post">
    <input type="hidden" name="id_pemesanan" value="<?php echo $id_pemesanan; ?>" />
    <div class="form-group">
        <label>Nama Pemesan</label>
        <input class="form-control" type="text" value="<?php echo $pemesanan->tampilperpemesanan('nama',$id_pemesanan) ?>" readonly="">
    </div>
    <div class="form-group">
        <label>Nama Paket</label>
        <select class="form-control" name="id_paket">
            <?php
            $paket      = new Paket();
            $arraypaket = $paket->tampilPaketSemua();
            foreach ($arraypaket as $data) {
            $arrpaket = "";
            if($pemesanan->tampilperpemesanan('id_paket',$id_pemesanan) == $data['id_paket']){
                $arrpaket = "selected";
            }
            ?>
            <option value="<?php echo $data['id_paket']; ?>" <?php echo $arrpaket; ?> ><?php echo $data['nama_paket']  ?></option>
            <?php
            }
            ?>
        </select>
    </div>
    
    <div class="form-group">
        <label>Harga</label>
        <input class="form-control" type="text" name="harga" value="<?php echo $pemesanan->tampilperpemesanan('harga',$id_pemesanan) ?>" />
    </div>
    
    <div class="form-group">
        <label>Administrasi</label>
        <input class="form-control" type="text" name="adm" value="<?php echo $pemesanan->tampilperpemesanan('adm',$id_pemesanan) ?>" />
    </div>
    
    <div class="form-group">
        <label>Kelompok</label>
        <select class="form-control" name="id_kelompok">
        <?php
        $kelompok   = new Kelompok();
        $arrkelompok = $kelompok->tampilKelompokSemua();
        foreach ($arrkelompok as $data) {
            $arrkel = "";
            if($pemesanan->tampilperpemesanan('id_kelompok',$id_pemesanan) == $data['id_kelompok']){
                $arrkel = "selected";
            }
        ?>
            <option value="<?php echo $data['id_kelompok']; ?>" <?php echo $arrkel; ?> ><?php echo $data['nama_kelompok'] ?></option>
        <?php
        }
        ?>
        </select>
    </div>

    <div class="form-group">
        <label>Status</label>
        <select class="form-control" name="status">
        <?php $status = $pemesanan->tampilperpemesanan('status',$id_pemesanan); ?>
        <?php
        foreach ($arr_status as $k => $v) {
           ?>
            <option value="<?=$k?>" <?=$status==$k?"selected='selected'":""?> ><?=$v?></option>
            <?php
        }
        ?>
            <!-- <option></option>
            <option value="TIDAK AKTIF">TIDAK AKTIF</option>
            <option value="BELUM">BELUM</option>
            <option value="LUNAS">LUNAS</option>
            <option value="DIAMBIL">DIAMBIL</option> -->
        </select>
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="btnSimpan" value="Simpan" />
    </div>
</form>
<?php
}else if($_GET['aksi']=='update'){
    //UPDATE DATA PAKET VIA METHOD
        $pemesanan->updatePemesanan($_POST['id_pemesanan'],$_POST['id_paket'],$_POST['harga'],$_POST['adm'],$_POST['id_kelompok'],$_POST['status']);
        ?>
        <script>
            alert("Data Pemesanan sudah di update");
            document.location="?mod=data-pemesanan";
        </script>
        <?php
    }
}
?>