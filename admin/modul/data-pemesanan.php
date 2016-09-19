<?php
include_once '../config/class.php';
include_once '../config/lib.php';

$id_kelompok = $_SESSION['id_kelompok'];
?>
<div class="row">
    <div class="col-md-12">
        <h1 class="page-head-line">DATA Pemesanan</h1>
        <h1 class="page-subhead-line">
            <ol class="breadcrumb">
                <li><a style="text-decoration: none;" href="./">Home</a></li>
                <li class="active">Data Pemesanan</li>
            </ol>
        </h1>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <table class="table table-responsive" id="data-pemesanan">
            <thead>
                <tr>
                    <th>No</th>
                    <th>No Paket</th>
                    <th>Nama</th>
                    <th>Paket</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $pemesanan = new Pemesanan();
            $arrayPemesanan=$pemesanan->tampilPemesananSemua($id_kelompok);
            $no = 1;
            $total = 0;
            $totalditerima = 0;
            if(count($arrayPemesanan)){
                foreach($arrayPemesanan AS $data):
                $total = $total + $data['adm'];
                $harga_paket_all = $data['harga'] * 300;
                $diterima = $harga_paket_all - $data['adm'];
                $totalditerima = $totalditerima + $diterima;
            ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $data['id_pelanggan'] ?></td>
                    <td><?php echo $data['nama'] ?></td>
                    <td><?php echo $data['nama_paket'] ?></td>
                    <?php
                    if($data['status']=='LUNAS'){
                    ?>
                    <td><?php echo "<span class='btn-success badgein'>".$data['status']."</span>"; ?></td>
                    <?php
                    }else if($data['status']=='BELUM'){
                    ?>
                    <td><?php echo "<span class='btn-danger badgeof'>".$data['status']."</span>"; ?></td>
                    <?php
                    }else if($data['status']=='DIAMBIL'){
                    ?>
                    <td><?php echo "<span class='btn-primary badgeof'>".$data['status']."</span>"; ?></td>
                    <?php    
                    }else{
                    ?>
                    <td><?php echo "<span class='btn-warning badgeof'>".$data['status']."</span>"; ?></td>
                    <?php    
                    }
                    ?>
                    <?php
                    if($data['status']=='TIDAK AKTIF'){
                    ?>
                    <td><a href="?mod=ubah-pemesanan&aksi=edit&id=<?php echo $data['id_pemesanan']; ?>" title="Edit"><span class="fa fa-edit fa-2x"></span></a></td>
                    <?php
                    }else if($data['status']=='DIAMBIL'){
                    ?>
                    <td></td>
                    <?php
                    }else{
                    ?>
                    <td>
                        <a href="?mod=lihat-angsuran&no_psn=<?php echo $data['id_pemesanan']; ?>" title="Lihat Angsuran"><span class="fa fa-calendar-check-o fa-2x"></span></a> | 
                        <a href="?mod=ubah-pemesanan&aksi=edit&id=<?php echo $data['id_pemesanan']; ?>" title="Edit"><span class="fa fa-edit fa-2x"></span></a>
                        <?php
                        if($_SESSION['level']=='admin'){
                            ?>
                            | <a href="?mod=data-pemesanan&aksi=hapus&id=<?php echo $data["id_pemesanan"]; ?>" title="Hapus" onClick="return confirm('Apakah Anda Yakin?');"><span class="fa fa-trash fa-2x"></span></a>
                            <?php
                        }
                        ?>
                    </td>
                    <?php    
                    }
                    ?>
                </tr>
            <?php
            $no++;
            endforeach;
            }
            ?>
            </tbody>
            <tr>
                <td colspan="9">
                    <span class="fa fa-calendar-check-o fa-2x"></span> Lihat Angsuran | 
                    <span class="fa fa-edit fa-2x"></span> Edit Pemesanan 
                    <?php
                        if($_SESSION['level']=='admin'){
                            ?>
                             | <span class="fa fa-trash fa-2x"></span> Hapus Pemesanan
                            <?php
                        }
                        ?>
                </td>
            </tr>
        </table>

        <?php
        $hapus = @$_GET['aksi']=='hapus';
        $id = @$_GET['id'];
        if(!empty($hapus)){
            $pemesanan->hapusPemesananById($id,$iduser);
            ?>
            <script type="text/javascript">
                alert('Data dihapus');
                document.location="index.php?mod=data-pemesanan";
            </script>
            <?php
        }
        ?>
    </div>
</div>
<script>
    $(document).ready(function() {
    $('#data-pemesanan').dataTable();
    });
</script>
