<?php
include_once '../config/class.php';
include_once '../config/lib.php';

$id_kelompok = $_SESSION['id_kelompok'];
?>
<div class="row">
    <div class="col-md-12">
        <h1 class="page-head-line">DATA ANGSURAN</h1>
        <h1 class="page-subhead-line">
            <ol class="breadcrumb">
                <li><a style="text-decoration: none;" href="./">Home</a></li>
                <li class="active">Data Agsuran</li>
            </ol>
        </h1>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        
        <table class="table table-responsive" id="lihat-angsuran">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Id Paket</th>
                    <th>Nama</th>
                    <th>Tgl. Bayar</th>
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
            $angsur = new Angsuran();
            $arrayAngsuran=$angsur->tampilSemuaAngsuran($id_kelompok);
            if(count($arrayAngsuran))
            {
                foreach($arrayAngsuran AS $data):
                if($data['status']!='DIAMBIL' && $data['status']!='TIDAK AKTIF'){
                $bayarTot = $data['harga'] * $data['jml_hari']; 
                $totAng = $totAng + $bayarTot;
                
            ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $data['id_pelanggan'] ?></td>
                    <td><?php echo $data['nama']; ?></td>
                    <td><?php echo date('d-m-Y',strtotime($data['tgl_angsuran'])); ?></td>
                    <td><?php echo format_angka($data['harga']); ?></td>
                    <td><?php echo $data['jml_hari']; ?></td>
                    <td><?php echo format_angka($bayarTot); ?></td>
                    <td><?php echo $data['nama_user']; ?></td>
                </tr>
            <?php
            $no++;
            }
            endforeach;
            }
            //$adm = $angsur->tampilPesanAngsur('adm',$no_psn);
            ?>
            </tbody>
        </table>
        <div class="form-group">
            <label>Total</label>
            <?php echo "Rp. ".format_angka($totAng).",-"; ?>
        </div>
        <!--
        <div class="form-group">
            <label>Administrasi :</label>
            <?php echo "Rp. ".format_angka($adm).",-"; ?>
        </div>
        
        <div class="form-group">
            <label>Sisa Uang :</label>
            <?php
            $totSisa = $totAng - $adm;
            echo "Rp. ".format_angka($totSisa).",-";
            ?>
        </div>
        -->
    </div>
    <!-- ./COL-MD-12 -->
</div>
<!-- ./ROW -->
<script>
    $(document).ready(function() {
    $('#lihat-angsuran').dataTable();
    });
</script>