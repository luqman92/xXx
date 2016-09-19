<?php
include_once '../config/class.php';
include_once '../config/lib.php';

// instance objek user
$user = new User();

// instance objek pelanggan
$pelanggan = new Pelanggan();

//instance objek paket
$paket = new Paket();

//instance objek kelompok
$kelompok = new Kelompok();

$iduser = $_SESSION['id_user'];
if (!$user->get_sesi()) {
  header("location:../");
}
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
        <h1 class="page-head-line">TAMBAH NASABAH</h1>
        <h1 class="page-subhead-line">
            <ol class="breadcrumb">
                <li><a style="text-decoration: none;" href="./">Home</a></li>
                <li><a style="text-decoration: none;" href="?mod=data-pelanggan">Data Nasabah</a></li>
                <li class="active">Tambah Nasabah</li>
            </ol>
        </h1>
    </div>
</div>
<!-- /. ROW  -->
<div class="row">
    
    <div class="col-md-2">
    
    </div>
    
    <div class="col-md-8">
        <form name="pelanggan" role="form" action="?mod=tambah-pelanggan" method="post" onsubmit="return checkForm(this)">
            
            <div class="form-group">
                <!-- <label>ID Nasabah</label> -->
                <label>Kode Paket</label>
                <input class="form-control" type="text" name="id_pelanggan" value="<?php echo kdauto('tb_pelanggan','') ?>" autofocus="on" />
            </div>
           
            <div class="form-group">
                <label>Nama</label>
                <input class="form-control" type="text" name="nama" />
                <p class="help-block">Masukkan Nama Lengkap.</p>
            </div>
           
            <div class="form-group">
                <label>Alamat</label>
                <textarea class="form-control" rows="3" name="alamat"></textarea>
            </div>
            
            <div class="form-group">
                <label>Telepon</label>
                <input class="form-control" type="text" name="telepon" />
                <p class="help-block">Masukkan nomor telepon yang valid.</p>
            </div>
           
            
            <div class="form-group">
                <label>Paket</label>
                <select id="paket" class="form-control" name="id_paket">
                    <option>-- Pilih Paket --</option>
                    <?php
                    $arrayPaket=$paket->tampilPaketSemua();
                    foreach($arrayPaket AS $data):
                    ?>
                    <option value="<?php echo $data['id_paket'] ?>"><?php echo $data['nama_paket']; ?></option>
                    <?php
                    endforeach;
                    ?>
                </select>    
                <p class="help-block">Masukkan paket yang diminati.</p>
            </div>
            
            <div class="form-group">
                <label>Keterangan</label>
                <textarea class="form-control" name="keterangan"></textarea>
                <p class="help-block">Masukkan keterangan apa bila ada perubahan paket.</p>
            </div>

            <div class="form-group">
                <label>Kelompok</label>
                <select class="form-control" name="id_kelompok">
                <?php
                $arrayKelompok = $kelompok->tampilKelompokSemua();
                foreach ($arrayKelompok as $data) {
                ?>
                    <option value="<?php echo $data['id_kelompok']; ?>"><?php echo $data['nama_kelompok']; ?></option>
                <?php
                }
                ?>
                </select>
            </div>
            <input type="submit" name="btnsimpan" class="btn btn-info" value="Simpan" />
        </form>
        <?php
    if(isset($_POST['btnsimpan'])){
        $kd_buku = rand(0,1000000);
        //TAMBAH DATA PELANGGAN VIA METHOD
        $pelanggan->tambahDataPelanggan($_POST['id_pelanggan'],$_POST['nama'],$_POST['alamat'],$_POST['telepon'],$_POST['id_paket'],$_POST['keterangan'],$_POST['id_kelompok'],$kd_buku,$iduser);
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=?mod=data-pelanggan">'; 
    }
?>
    </div>
    
    <div class="col-md-2">
    
    </div>
</div>
<script>
    $(document).ready(function(){
       $("#paket").select2({
            placeholder:"Please Select"
       }); 
    });
</script>