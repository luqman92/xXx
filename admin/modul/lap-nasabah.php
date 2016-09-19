<script src="../assets/js/jquery-1.8.2.js"></script>
<script src="../assets/js/jquery-ui-1.9.0.custom.js"></script>
<script src="../assets/js/jquery.ui.datepicker-id.js"></script>
<?php
include_once '../config/class.php';
include_once '../config/lib.php';

$id_kelompok = $_SESSION['id_kelompok'];
?>
<div class="row">
    <div class="col-md-12">
        <h1 class="page-head-line">LAPORAN NASABAH</h1>
        <h1 class="page-subhead-line">
            <ol class="breadcrumb">
                <li><a style="text-decoration: none;" href="./">Home</a></li>
                <li class="active">Laporan Nasabah</li>
            </ol>
        </h1>
    </div>
</div>
<div class="row">
<div class="col-md-4">
    <table class="table table-responsive">
        <tr>
            <td>Kelompok</td>
            <td>:</td>
            <td>
                <select class="form-control" name="id_kelompok">
                    <option>-- Pilih --</option>    
                </select>
            </td>
        </tr>
        <tr>
            <td>Status</td>
            <td>:</td>
            <td>
                <select class="form-control" name="id_kelompok">
                    <option>-- Pilih --</option>    
                </select>
            </td>
        </tr>
    </table>
</div>
</div>
<div class="row">
    <div class="col-md-12">
        <p class="text-right"><a class="btn btn-primary" href="modul/print/cetak-lap-semua-nasabah.php" target="_blank">Cetak Laporan</a></p>
        <table class="table table-responsive" id="lap-bulanan">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Id Paket</th>
                    <th>Nama</th>
                    <th>Paket</th>
                    <th>Jml</th>
                    <th>Total</th>
                    <th>Status</th>
                </tr>
            </thead>
            
            <tbody>
            <?php
            $no = 1;
            $totAng = 0;
            $totADM = 0;
            $Lap = new Pelanggan();
            $arrayLapBulanan = $Lap->tampilPelangganSemua($id_kelompok);
            if(count($arrayLapBulanan))
            {
                foreach($arrayLapBulanan AS $data):
                    $id_pelanggan = $data['id_pelanggan'];
                    
                    $clslap = new Laporan();
                    $arraynsb = $clslap->tampilLapSemuaNasabahFilter($id_pelanggan);
                    foreach($arraynsb AS $data2) {
                        $id_pemesanan = $data2['id_pemesanan'];

                        $clspem = new Pemesanan();
                        $arraypem = $clspem->tampilPemesananById($id_pemesanan);
                        foreach($arraypem AS $data3){
                            $tot = $data3['harga'] * $data2['jml'];
                            $totAdm = $data3['tadm'];
                            $totAng = $totAng + $tot;
                            $totADM = $totADM + $totAdm;
            ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $data['id_pelanggan']; ?></td>
                    <td><?php echo $data['nama']; ?></td>
                    <td><?php echo $data3['nama_paket']." (".$data3['harga'].")"; ?></td>
                    <td><?php echo $data2['jml']; ?></td>
                    <td><?php echo format_angka($tot); ?></td>
                    <td><?php echo $data3['status']; ?></td>
                </tr>
            <?php
            $no++;
                    }
                }
            endforeach;

            }else{
                echo "Data Kosong";
            }
            ?>
            </tbody>
        </table>
        <?php
        if($_SESSION['level']=='admin'){
            ?>
        <table>
            <tr>
                <td><b>Total</b></td>
                <td>: </td>
                <td><?php echo "<b>Rp. ".format_angka($totAng).",-</b>"; ?></td>
            </tr>
            <tr>
                <td><b>Total ADM</b></td>
                <td>: </td>
                <td><?php echo "<b>Rp. ".format_angka($totADM).",-</b>"; ?></td>
            </tr>
            <tr>
                <td><b>Total Setoran</b></td>
                <td>: </td>
                <td><?php echo "<b>Rp. ".format_angka($totAng - $totADM).",-</b>"; ?></td>
            </tr>
        </table>
            <?php
        }
        ?>

    </div>
    <!-- ./COL-MD-12 -->
</div>
<!-- ./ROW -->

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

