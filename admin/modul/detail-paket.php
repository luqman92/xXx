<div class="row">
    <div class="col-md-12">
        <h1 class="page-head-line">DETAIL PAKET</h1>
        <h1 class="page-subhead-line">
            <ol class="breadcrumb">
                <li><a style="text-decoration: none;" href="./">Home</a></li>
                <li><a style="text-decoration: none;" href="javascript:history.back(-1)">Data Paket</a></li>
                <li class="active">Detail Paket</li>
            </ol>
        </h1>
    </div>
</div>

<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
    <?php
    $result = $db->query("SELECT * FROM tb_paket WHERE id_paket='".$_GET['id']."'");
    $row    = $result->fetch_assoc();
    
    $result2 = $db->query("SELECT
                        a.id_paket,
                        a.nama_paket,
                        a.harga_paket,
                        b.id_paket_detail,
                        b.nama_paket_detail,
                        b.isi
                        FROM
                        tb_paket AS a
                        Left Join tb_paket_detail AS b ON a.id_paket = b.id_paket
                        WHERE a.id_paket='".$_GET['id']."'
                        ");
    $row2 = $result2->fetch_all(MYSQLI_ASSOC);
    ?>
        <div class="panel panel-primary">
                        <div class="panel-heading">
                            <?php echo $row['nama_paket']." Rp.".number_format($row['harga_paket'],0)."/Hari"; ?>
                        </div>
                        <div class="panel-body">
                            <ul>
                            <?php
                            foreach($row2 AS $data):
                            ?>
                            <li><?php echo $data['nama_paket_detail']." (".$data['isi'].")"; ?></li>
                            <?php
                            endforeach;
                            ?>
                            </ul>
                        </div>
                        <div class="panel-footer">
                            Administrasi Rp. <?php echo number_format($row['administrasi'],0); ?>
                        </div>
                    </div>
    </div>
    <div class="col-md-3"></div>

</div>
<script>
    $(document).ready(function(){
        $('#data-paket').dataTable(); 
    });
</script>