<?php
    include_once '../config/class.php';
    include_once'../config/lib.php';
?>

<div class="row">
    <div class="col-md-12">
        <h1 class="page-head-line">DATA USER</h1>
        <h1 class="page-subhead-line">
            <ol class="breadcrumb">
                <li><a style="text-decoration: none;" href="./">Home</a></li>
                <li class="active">Data User</li>
            </ol>
        </h1>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
    <a class="btn btn-primary" href="index.php?mod=tambah-user"><i class="fa fa-plus "></i> User</a><br /><br />
        <table class="table table-responsive" id="data-user">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Nama</th>
                    <th>Foto</th>
                    <th>Kelompok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $arrayUser=$user->tampilSemuaUser();
            $no = 1;
            if(count($arrayUser)){
                foreach($arrayUser AS $data):
            ?>
                <tr>
                    <td><?=$no?></td>
                    <td><?=$data['username'];?></td>
                    <td><?=$data['nama_user'];?></td>
                    <td><?=$data['foto'];?></td>
                    <td><?=$data['nama_kelompok'];?></td>
                    <td><a href="index.php?mod=ubah-user&aksi=edit&idusr=<?=$data['id_user'];?>"><span class="fa fa-edit"></span></a> | <a href="index.php?mod=ubah-user&aksi=hapus&idusr=<?=$data['id_user'];?>"><span class="fa fa-trash" onclick="return confirm('Apakah Anda Yakin?')"></span></a></td>
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
    $(document).ready(function() {
	    $('#data-user').dataTable();
    });
</script>