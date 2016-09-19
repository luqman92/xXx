<?php
include_once '../config/class.php';
include_once'../config/lib.php';

$newKelompok = new Kelompok();

?>

<div class="row">
    <div class="col-md-12">
        <h1 class="page-head-line">DATA KELOMPOK</h1>
        <h1 class="page-subhead-line">
            <ol class="breadcrumb">
                <li><a style="text-decoration: none;" href="./">Home</a></li>
                <li class="active">Data Kelompok</li>
            </ol>
        </h1>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
    <a class="btn btn-primary" href="index.php?mod=tambah-kelompok"><i class="fa fa-plus "></i> Kelompok</a><br /><br />
        <table class="table table-bordered" id="data-kelompok">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kelompok</th>
                    <th>Total Nasabah</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $arrayKelompok=$newKelompok->tampilKelompokSemua();
            $no = 1;
            if(count($arrayKelompok)){
                foreach($arrayKelompok AS $data):
                    $id_kelompok = $data['id_kelompok'];

                    $newPemesanan = new Pemesanan();
                    $arrcount=$newPemesanan->tampilCountByIdKelompok($id_kelompok);
                    foreach($arrcount AS $data2){
            ?>
                <tr>
                    <td><?=$no?></td>
                    <td><?=$data['nama_kelompok'];?></td>
                    <td><?=$data2['jml'];?></td>
                    <td><a href="index.php?mod=ubah-kelompok&aksi=edit&idkel=<?=$data['id_kelompok'];?>"><span class="fa fa-edit"></span></a> | <a href="index.php?mod=ubah-kelompok&aksi=hapus&idkel=<?=$data['id_kelompok'];?>"><span class="fa fa-trash" onclick="return confirm('Apakah Anda Yakin?')"></span></a></td>
                </tr>
            <?php
            $no++;
            }
            endforeach;
            }else{
                
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    $(document).ready(function() {
	    $('#data-kelompok').dataTable();
    });
</script>