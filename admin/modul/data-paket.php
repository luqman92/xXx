<?php
include_once "../config/class.php";
include_once "../config/lib.php";

$paket = new Paket();

?>
<div class="row">
    <div class="col-md-12">
        <h1 class="page-head-line">DATA PAKET</h1>
        <h1 class="page-subhead-line">
            <ol class="breadcrumb">
                <li><a style="text-decoration: none;" href="./">Home</a></li>
                <li class="active">Data Paket</li>
            </ol>
        </h1>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
    <div class="text-left"><a class="btn btn-primary" href="index.php?mod=tambah-paket"><span class="fa fa-plus"></span></a></div>
    <br />
        <table class="table table-responsive" id="data-paket">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Paket</th>
                    <th>Harga /hari</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $no = 1;
            $arrayPaket = $paket->tampilPaketSemua();
            foreach($arrayPaket AS $data):
            ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $data['nama_paket'] ?></td><!-- <a style="text-decoration: none;" href="#" id=" <?php echo $data['id_paket'] ?>" data-toggle="modal" data-target="#myModal"><?php echo $data['nama_paket'] ?></a> -->
                    <td><?php echo format_angka($data['harga_paket']); ?></td>
                    <td><a href="?mod=ubah-paket&aksi=edit&id=<?php echo $data['id_paket']; ?>"><span class="fa fa-edit"></span></a> | <a href="?mod=ubah-paket&aksi=hapus&id=<?php echo $data['id_paket']; ?>" onClick="return confirm('Apakah Anda Yakin?');"><span class="fa fa-trash"></span></a></td>
                </tr>
                    <!-- Modal -->
<!--div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <?php echo $_POST['id']; ?>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div-->
<!-- ./MODAL -->
            <?php
            $no++;
            endforeach;
            ?>
            </tbody>
        </table>
    </div>

</div>
<script>
    $(document).ready(function(){
        $('#data-paket').dataTable(); 
    });
</script>