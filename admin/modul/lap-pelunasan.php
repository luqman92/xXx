<script src="../assets/js/jquery-1.8.2.js"></script>
<script src="../assets/js/jquery-ui-1.9.0.custom.js"></script>
<script src="../assets/js/jquery.ui.datepicker-id.js"></script>
<?php
include_once '../config/class.php';
include_once '../config/lib.php';

$user = new User();
$plg = new Pelanggan();
$iduser = $_SESSION['id_user'];
if (!$user->get_sesi())
{
header("location:../");
}
?>
<div class="row">
    <div class="col-md-12">
        <h1 class="page-head-line">LAPORAN PELUNASAN</h1>
        <h1 class="page-subhead-line">
            <ol class="breadcrumb">
                <li><a style="text-decoration: none;" href="./">Home</a></li>
                <li class="active">Laporan Pelunasan</li>
            </ol>
        </h1>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <form action="" method="post" onsubmit="if(this.q.value)return true;else return false;">
            <div class="form-group">
                <div class="input-group">
                  <input type="hidden" name="do" value="find" />
                  <input class="form-control" type="text" name="tgl_awal" id="tgl_awal" placeholder="Tanggal Awal" autocomplete="off" />
                  <div class="input-group-addon">S/D</div>
                  <input class="form-control" type="text" name="tgl_akhir" id="tgl_akhir" placeholder="Tanggal Akhir" autocomplete="off" />
                  
                  <span class="input-group-btn"><button class="btn btn-primary">Cetak</button></span>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="row">
    <?php
    if(@$_POST['do']=='find'){
        
    ?>    
    <div class="col-md-12">
        <div class="form-group">
            <label>Tanggal :</label>
            <?php echo date("d-M-Y",strtotime($_POST['tgl_awal']))." S/D ". date("d-M-Y",strtotime($_POST['tgl_akhir'])); ?>
        </div>
        <table class="table table-responsive" id="lap-bulanan">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Id Paket</th>
                    <th>Nama</th>
                    <!--th>Tgl. Bayar</th-->
                    <th>Angsuran</th>
                    <th>Jml. Hari</th>
                    <th>Total Pembayaran</th>
                    <th>User</th>
                </tr>
            </thead>
            
            <tbody>
            <?php
            $no = 1;
            $totAng = 0;
            $Lap = new Laporan();
            $arrayLapBulanan = $Lap->tampilLapPelunasanFilter($_POST['tgl_awal'],$_POST['tgl_akhir']);
            if(count($arrayLapBulanan))
            {
                foreach($arrayLapBulanan AS $data):
                if($data['status']=='LUNAS'){
                $bayarTot = $data['harga'] * $data['jml_hari']; 
                $totAng = $totAng + $bayarTot;    

                
                
            ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $data['id_pelanggan'] ?></td>
                    <td><?php echo $data['nama']; ?></td>
                    <!--td><?php echo date('d-m-Y',strtotime($data['tgl_angsuran'])); ?></td-->
                    <td><?php echo format_angka($data['harga']); ?></td>
                    <td><?php echo $data['jml_hari']; ?></td>
                    <td><?php echo format_angka($bayarTot); ?></td>
                    <td><?php echo $data['nama_user']; ?></td>
                </tr>
            <?php
            $no++;
            }
            endforeach;
            }else{
                echo "Data Kosong";
            }
            ?>
            </tbody>
            <tr>
                <td colspan="5" class="text-center"><b>Total</b></td>
                <td colspan="2"><?php echo "<b>Rp. ".format_angka($totAng).",-</b>"; ?></td>
            </tr>
        </table>
    </div>
    <!-- ./COL-MD-12 -->
</div>
<!-- ./ROW -->

<?php 
}
?>
<script type="text/javascript"> 
$(document).ready(function(){
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

<script>
    $(document).ready(function(){
        $("#lap-bulanan").dataTable()
    });
</script>

