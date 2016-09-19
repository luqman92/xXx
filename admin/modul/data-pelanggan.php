<?php
include_once '../config/class.php';
include_once '../config/lib.php';

$pelanggan = new Pelanggan();
$iduser = $_SESSION['id_user'];
$id_kelompok = $_SESSION['id_kelompok'];
?>
<div class="row">
    <div class="col-md-12">
        <h1 class="page-head-line">DATA NASABAH</h1>
        <h1 class="page-subhead-line">
            <ol class="breadcrumb">
                <li><a style="text-decoration: none;" href="./">Home</a></li>
                <li class="active">Data Nasabah</li>
            </ol>
        </h1>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
    <a class="btn btn-primary" href="index.php?mod=tambah-pelanggan"><i class="fa fa-plus "></i> Nasabah</a><br /><br />
        <table class="table table-responsive" id="data-pelanggan">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Paket</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Telepon</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $arrayPelanggan=$pelanggan->tampilPelangganSemua($id_kelompok);
            $no = 1;
            if(count($arrayPelanggan)){
                foreach($arrayPelanggan AS $data):
            ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $data['id_pelanggan'] ?></td>
                    <td><?php echo $data['nama'] ?></td>
                    <td><?php echo $data['alamat'] ?></td>
                    <td><?php echo $data['telepon'] ?></td>
                    
                    <td><a href="?mod=ubah-pelanggan&aksi=edit&id_plg=<?php echo $data['id_pelanggan']; ?>"><span class="fa fa-edit"></span></a> | <a href="?mod=ubah-pelanggan&aksi=hapus&id_plg=<?php echo $data['id_pelanggan']; ?>"><span class="fa fa-trash" onclick="return confirm('Apakah Anda Yakin?')"></span></a></td>
                </tr>
            <?php
            $no++;
            endforeach;
            }else{
                
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    //$(document).ready(function(){
//        $('#data-pelanggan').dataTable();
//    });
    $(document).ready(function() {
    $('#data-pelanggan').dataTable();
    });
</script>

