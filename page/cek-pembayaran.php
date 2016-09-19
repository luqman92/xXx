<?php

$angsur = new Angsuran();
if(isset($_POST['btn-search'])){
$id_pemesanan 	= $_POST['id_pemesanan'];
$kd_validasi	= $_POST['kd_validasi'];
$kd_buku        = $angsur->tampilPesanAngsur('kd_buku',$id_pemesanan);
if($kd_buku == $kd_validasi){
//ambil data pelanggan berdasarkan nomor pesan
$id_plg=$angsur->tampilPesanAngsur('id_pelanggan',$id_pemesanan);
?>
<div class="row">
    <div class="col-md-12">
        <h3 class="page-head-line">DATA PEMBAYARAN</h3>
    </div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="form-group">
            <label>No. Paket :</label>
            <?php echo $angsur->tampilPesanAngsur('id_pemesanan',$id_pemesanan); ?>
        </div>
        
        <div class="form-group">
            <label>Nama Pelanggan :</label>
            <?php echo $angsur->tampilPesanPelanggan('nama',$id_plg); ?>
        </div>

        <div class="form-group">
            <label>Paket :</label>
            <?php echo $angsur->tampilPesanAngsur('nama_paket',$id_pemesanan); ?>
        </div>
        
        <div class="form-group">
            <label>Angsuran :</label>
            <?php echo $angsur->tampilPesanAngsur('harga',$id_pemesanan)." /hari"; ?>
        </div>
        
		<table class="table table-responsive" id="cek-pembayaran">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tgl. Bayar</th>
                    <!--th>Tgl. Awal</th>
                    <th>Tgl. Akhir</th-->
                    <!--th>Angsuran</th-->
                    <th>Jumlah</th>
                    <th>Total</th>
                    <th>Pegawai</th>
                </tr>
            </thead>
            
            <tbody>
            <?php
            $no = 1;
            $totAng = 0;
            $totHari = 0;
            $totSisa = 0;
            $arrayAngPelanggan=$angsur->tampilPerPelanggan($id_pemesanan);
            if(count($arrayAngPelanggan))
            {
                foreach($arrayAngPelanggan AS $data):
                $bayarTot = $data['harga'] * $data['jml_hari']; 
                $totAng = $totAng + $bayarTot;
                $totHari = $totHari + $data['jml_hari'];
            ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo date('d-M-Y',strtotime($data['tgl_angsuran'])); ?></td>
                    <!--td><?php echo date('d-M-Y',strtotime($data['tgl_awal'])); ?></td>
                    <td><?php echo date('d-M-Y',strtotime($data['tgl_akhir'])); ?></td>
                    <td><?php echo format_angka($data['harga']); ?></td-->
                    <td><?php echo $data['jml_hari']." Hari"; ?></td>
                    <td><?php echo format_angka($bayarTot); ?></td>
                    <td><?php echo $data['nama_user']; ?></td>
                    <!-- data-toggle="modal" data-target="#myModal" -->
                </tr>
            <?php
            $no++;
            endforeach;
            $adm = $angsur->tampilPesanAngsur('adm',$id_pemesanan);
            }
            ?>
            </tbody>
        </table>

        <div class="form-group">
            <label>Total selama 300 Hari :</label>
            <?php
            $tot300 = 300*$angsur->tampilPesanAngsur('harga',$id_pemesanan);
            echo "Rp. ".format_angka($tot300).",-";
            ?>
        </div>
        
        <div class="form-group">
            <label>Total terkumpul <?php echo $totHari ?> Hari :</label>
            <?php echo "Rp. ".format_angka($totAng).",-"; ?>
        </div>
        
        <div class="form-group">
            <label>Kurang <?php echo 300-$totHari ?> Hari :</label>
            <?php echo "Rp. ".format_angka($tot300-$totAng).",-"; ?>
        </div>
        
        <div class="form-group">
            <label>Administrasi :</label>
            <?php echo "Rp. ".format_angka($adm).",-"; ?>
        </div>
        
        <!--div class="form-group">
            <label>Uang yang diterima :</label>
            <?php
            $totSisa = $totAng - $adm;
            echo "Rp. ".format_angka($totSisa).",-";
            ?>
        </div-->
    </div>
</div>
<script>
    $(document).ready(function() {
    $('#cek-pembayaran').dataTable();
    });
</script>
    </div>
    <?php
	}else{
		?>
		<script type="text/javascript">
		alert('Validasi tidak valid silahkan ulangi kembali');
		document.location="javascript:history.back(-1)";
		</script>
		<?php
	}
}else{
?>
		<script type="text/javascript">
		document.location="javascript:history.back(-1)";
		</script>
		<?php
}
    ?>
