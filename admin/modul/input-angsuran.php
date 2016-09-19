<script src="../assets/js/jquery-1.8.2.js"></script>
<script src="../assets/js/jquery-ui-1.9.0.custom.js"></script>
<script src="../assets/js/jquery.ui.datepicker-id.js"></script>
<script type="text/javascript">
    function bagi() {
        var txtbil1 = document.getElementById('bil1').value;
        var txtbil2 = document.getElementById('bil2').value;
        var result = parseInt(txtbil1) / parseInt(txtbil2);
        if (!isNaN(result)) {
            document.getElementById('hasil').value = result;
        };
    }
</script>
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

$idpsn = $_GET['no_psn'];
//AMBIL DATA PELANGGAN BERDASARKAN NOMOR PEMESANAN
$id_plg=$angsur->tampilPesanAngsur('id_pelanggan',$idpsn);
?>
<script>
            $(document).ready(function() {
			$('#hari').change(function(){
			$.post("./modul/ajax.php", { tgl_awal: $('#tgl_awal').val(), tgl_akhir:$('#tgl_akhir').val(), id_pemesanan:$('#id_pemesanan').val() })
				.done(function( data ) {
					$('#Tbayar').val(data);
					$('#Tkurang').val(data);
			});
		});
        )};
</script>
<div class="row">
    <div class="col-md-12">
        <h1 class="page-head-line">ANGSURAN</h1>
        <h1 class="page-subhead-line">
            <ol class="breadcrumb">
                <li><a style="text-decoration: none;" href="./">Home</a></li>
                <li><a style="text-decoration: none;" href="javascript:history.back(-1)">Lihat Angsuran</a></li>
                <li class="active">Angsuran</li>
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
        
        <input type="hidden" value="<?php echo $angsur->tampilPesanPelanggan('id_pelanggan',$id_plg); ?>" name="id_pelanggan" />
        <input type="hidden" value="<?php echo $angsur->tampilPesanAngsur('id_pemesanan',$idpsn); ?>" id="id_pemesanan" name="id_pemesanan" />
        <input type="hidden" value="<?php echo $_SESSION['id_user']; ?>" name="id_user" />
        <!--input type="text" id="hari" name="hari" /-->
        <?php
        date_default_timezone_set("Asia/Jakarta");
        $tgl_skr = date('Y-m-d');
        ?>
			<table class="table table-responsive">
                <tr>
                    <td>Kalkulator</td>
                    <td>:</td>
                    <td>
                        <input type="text" name="bil1" id="bil1" onkeyup="bagi();" />
                        <input type="text" name="bil2" id="bil2" onkeyup="bagi();" value="<?=$angsur->tampilPesanAngsur('harga',$idpsn)?>" readonly/> = <input type="text" name="hasil" id="hasil" /> 
                    </td>    
                </tr>
				<tr>
					<td>Nama</td>
					<td>:</td>
					<td><?php echo $angsur->tampilPesanPelanggan('nama',$id_plg); ?> | Angsuran /hari <?php echo "<b>".format_angka($angsur->tampilPesanAngsur('harga',$idpsn))."</b>"; ?></td>
				</tr>
			</table>
            <div class="form-group">
                <label>Tanggal</label>
                <input class="form-control" type="text" name="tgl_angsuran" id="tgl_angsuran" value="<?php echo $tgl_skr ?>" autofocus="on" autocomplete="of" />
            </div>
			<!--
            <div class="form-group">
                <label>Nama</label>
                <input class="form-control" type="text" name="nama" value="<?php echo $angsur->tampilPesanPelanggan('nama',$id_plg); ?>" readonly="on" />
            </div>
			-->
            <!--
            <div class="form-group">
                <label>Alamat</label>
                <textarea class="form-control" name="alamat" readonly="on"><?php echo $angsur->tampilPesanPelanggan('alamat',$id_plg); ?></textarea>
            </div>
            -->
            <div class="form-group">
                <label>Tanggal Awal</label>
                <input class="form-control" type="text" name="tgl_awal" id="tgl_awal" value="<?php echo $angsur->tglAngsurSelanjutnya('tgl_awal',$id_plg); ?>" autocomplete="off" />
            </div>
            
            <div class="form-group">
                <label>Tanggal Akhir</label>
                <input class="form-control" type="text" name="tgl_akhir" value="<?php echo $angsur->tglAngsurSelanjutnya('tgl_awal',$id_plg); ?>" id="tgl_akhir" autocomplete="off" />
            </div>
            <!-- 
            <div class="form-group">
                <label>Angsuran /hari</label>
                <input class="form-control" type="text" name="angsuran" value="<?php echo format_angka($angsur->tampilPesanAngsur('harga',$idpsn)); ?>" readonly="on" />
            </div>
            -->
            <!--div class="form-group">
                <label>Jumlah Bayar</label>
                <input class="form-control" type="text" name="jml_byr" id="jml_byr" readonly="on" />
            </div-->
            
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
    $id_pelanggan  = $_POST['id_pelanggan'];
    $id_pemesanan  = $_POST['id_pemesanan'];
    $tgl_angsuran  = $_POST['tgl_angsuran'];
    $tgl_awal      = $_POST['tgl_awal'];
    $tgl_akhir     = $_POST['tgl_akhir'];
	$id_user       = $_POST['id_user'];
    
    //TAMBAH DATA ANGSURAN VIA METHOD
    //CEK APAKAH ANGSURAN SUDAH LUNAS ATAU BELUM
    $angsur->simpanAngsuran($tgl_angsuran,$tgl_awal,$tgl_akhir,$id_pelanggan,$id_pemesanan,$id_user);
    ?>
    
    <script>
        document.location="?mod=lihat-angsuran&no_psn=<?php echo $id_pemesanan ?>";
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