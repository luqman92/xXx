<?php
include_once '../config/class.php';
include_once '../config/lib.php';

$user = new User();
$angsur = new Angsuran();

$iduser = $_SESSION['id_user'];
if (!$user->get_sesi())
{
header("location:../");
}
$no_psn = $_GET['no_psn'];
//ambil data nasabah berdasarkan nomor pinjam
$id_plg=$angsur->tampilPesanAngsur('id_pelanggan',$no_psn);
?>
<div class="row">
    <div class="col-md-12">
        <h1 class="page-head-line">LIHAT DATA PEMBAYARAN ANGSURAN</h1>
        <h1 class="page-subhead-line">
            <ol class="breadcrumb">
                <li><a style="text-decoration: none;" href="./">Home</a></li>
                <li><a style="text-decoration: none;" href="?mod=data-pemesanan">Data Pemesanan</a></li>
                <li class="active">Lihat Agsuran</li>
            </ol>
        </h1>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
    <?php
    if($angsur->tampilPesanAngsur('status',$no_psn)=='LUNAS'){
    ?>
    
    <?php
    }else{
    ?>
    <a class="btn btn-primary" href="?mod=input-angsuran&no_psn=<?php echo $no_psn ?>" title="Bayar Angsuran">Bayar Angsuran</a>
    <?php
    }
    ?>
        <div class="form-group">
            <label>No. Pemesanan :</label>
            <?php echo $angsur->tampilPesanAngsur('id_pemesanan',$no_psn); ?>
        </div>
        
        <div class="form-group">
            <label>Nama Pelanggan :</label>
            <?php echo $angsur->tampilPesanPelanggan('nama',$id_plg); ?>
        </div>
        
        <div class="form-group">
            <label>Angsuran :</label>
            <?php echo $angsur->tampilPesanAngsur('harga',$no_psn)." /Hari"; ?>
        </div>
        
        <div class="form-group">
            <label>Kode Buku :</label>
            <?php echo $angsur->tampilPesanAngsur('kd_buku',$no_psn); ?>
        </div>
        
        <table class="table table-responsive" id="lihat-angsuran">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tgl. Bayar</th>
                    <th>Tgl. Awal</th>
                    <th>Tgl. Akhir</th>
                    <th>Jml. Hari</th>
                    <th>Total Pembayaran</th>
                    <th>User</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            
            <tbody>
            <?php
            $no = 1;
            $totAng = 0;
            $totHari = 0;
            $totSisa = 0;
            $arrayAngPelanggan=$angsur->tampilPerPelanggan($no_psn);
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
                    <td><?php echo date('d-M-Y',strtotime($data['tgl_awal'])); ?></td>
                    <td><?php echo date('d-M-Y',strtotime($data['tgl_akhir'])); ?></td>
                    <td><?php echo $data['jml_hari']; ?></td>
                    <td><?php echo format_angka($bayarTot); ?></td>
                    <td><?php echo $data['nama_user']; ?></td>
                    <td><a href="?mod=ubah-angsuran&no_ang=<?php echo $data['no_ang']; ?>"><span class="fa fa-edit"></span></a></td> <!-- data-toggle="modal" data-target="#myModal" -->
                </tr>
            <?php
            $no++;
            endforeach;
            }
            $adm = $angsur->tampilPesanAngsur('adm',$no_psn);
            ?>
            </tbody>
        </table>
        <!-- MODALS -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="" method="post">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Ubah Angsuran</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Tanggal</label>
                            <input class="form-control" type="text" name="tgl_angsuran" value="<?php ?>" />
                        </div>
                        
                        <div class="form-group">
                            <label>Nama</label>
                            <input class="form-control" type="text" name="nama" value="<?php ?>" />
                        </div>
                        
                        <div class="form-group">
                            <label>Tanggal Awal</label>
                            <input class="form-control" type="text" name="tgl_awal" value="<?php ?>" />
                        </div>
                        
                        <div class="form-group">
                            <label>Tanggal Akhir</label>
                            <input class="form-control" type="text" name="tgl_akhir" value="<?php ?>" />
                        </div>
                        
                        <div class="form-group">
                            <label>Angsuran</label>
                            <input class="form-control" type="text" name="angsuran" value="<?php ?>" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- ./MODALS -->
        <div class="form-group">
            <label>Total selama 300 Hari :</label>
            <?php
            $tot300 = 300*$angsur->tampilPesanAngsur('harga',$no_psn);
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
        
        <div class="form-group">
            <label>Uang yang diterima :</label>
            <?php
            $totSisa = $totAng - $adm;
            echo "Rp. ".format_angka($totSisa).",-";
            ?>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
    $('#lihat-angsuran').dataTable();
    });
</script>