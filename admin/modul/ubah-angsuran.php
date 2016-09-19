<script src="../assets/js/jquery-1.8.2.js"></script>
<script src="../assets/js/jquery-ui-1.9.0.custom.js"></script>
<script src="../assets/js/jquery.ui.datepicker-id.js"></script>
<?php
include_once '../config/class.php';
include_once '../config/lib.php';

// instance objek user
$user = new User();

//instance objek paket
$angsur = new Angsuran();

$iduser = $_SESSION['id_user'];
if (!$user->get_sesi()) {
  header("location:../");
}

$no_ang = $_GET['no_ang'];
//AMBIL DATA PELANGGAN BERDASARKAN NOMOR PEMESANAN
$id_plg=$angsur->tampilAngsuran('id_pelanggan',$no_ang);
?>

<div class="row">
    <div class="col-md-12">
        <h1 class="page-head-line">UBAH ANGSURAN</h1>
        <h1 class="page-subhead-line">
            <ol class="breadcrumb">
                <li><a style="text-decoration: none;" href="./">Home</a></li>
                <li><a style="text-decoration: none;" href="javascript:history.back(-1)">Lihat Angsuran</a></li>
                <li class="active">Ubah Angsuran</li>
            </ol>
        </h1>
    </div>
</div>
<!-- /. ROW  -->
<div class="row">
    
    <div class="col-md-2">
    
    </div>
    
    <div class="col-md-8">
        <form action="" method="post">
        
        <input type="hidden" value="<?php echo $angsur->tampilAngsuran('no_ang',$no_ang); ?>" name="no_ang" />
        <input type="hidden" value="<?php echo $angsur->tampilAngsuran('id_pemesanan',$no_ang); ?>" name="id_pemesanan" />
        <input type="hidden" value="<?php echo $_SESSION['id_user']; ?>" name="id_user" />
        <!--input type="text" id="hari" name="hari" /-->
        <?php
        date_default_timezone_set("Asia/Jakarta");
        ?>

            <table class="table table-responsive">
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td><?php echo $angsur->tampilAngsuran('nama',$no_ang); ?> | Angsuran /hari <?php echo "<b>".format_angka($angsur->tampilAngsuran('harga',$no_ang))."</b>"; ?></td>
                </tr>
            </table>

            <div class="form-group">
                <label>Tanggal</label>
                <input class="form-control" type="text" name="tgl_angsuran" id="tgl_angsuran" value="<?php echo $angsur->tampilAngsuran('tgl_angsuran', $no_ang); ?>" autofocus="on" />
            </div>
            
            <div class="form-group">
                <div class="input-group">
                    <input class="form-control" type="text" name="tgl_awal" id="tgl_awal" value="<?php echo $angsur->tampilAngsuran('tgl_awal', $no_ang); ?>" />
                    <div class="input-group-addon">S/D</div>
                    <input class="form-control" type="text" name="tgl_akhir" id="tgl_akhir" value="<?php echo $angsur->tampilAngsuran('tgl_akhir', $no_ang); ?>" />
                </div>
            </div>
                   
            <div class="form-group">
                <button class="btn btn-primary" name="btnSimpan" type="submit">Simpan</button> 
                <a href="javascript:history.back(-1);" class="btn btn-primary">Batal</a>
            </div>
        </form>
    </div>
    
    <div class="col-md-2">
    
    </div>
</div>
<?php
if(isset($_POST['btnSimpan'])){
    $no_ang        = $_POST['no_ang'];
    $id_pemesanan  = $_POST['id_pemesanan'];
    $tgl_angsuran  = $_POST['tgl_angsuran'];
    $tgl_awal      = $_POST['tgl_awal'];
    $tgl_akhir     = $_POST['tgl_akhir'];
    $id_user       = $_POST['id_user'];
    $angsur->updateAngsuran($no_ang,$tgl_angsuran,$tgl_awal,$tgl_akhir,$id_user);
    ?>
        <script>
            alert("Data Angsuran sudah di update");
            document.location="?mod=lihat-angsuran&no_psn=<?php echo $id_pemesanan; ?>";
        </script>
        <?php
}
?>
<script type="text/javascript"> 
                $(document).ready(function(){
                   $("#tgl_angsuran").datepicker({
                      dateFormat: "yy-mm-dd",
                      changeMonth: true,
                      changeYear: true
                   });
                   $("#tgl_awal").datepicker({
                      dateFormat: "yy-mm-dd",
                      changeMonth: true,
                      changeYear: true
                   });
                   $("#tgl_akhir").datepicker({
                      dateFormat: "yy-mm-dd",
                      changeMonth: true,
                      changeYear: true
                   });
                });
</script>