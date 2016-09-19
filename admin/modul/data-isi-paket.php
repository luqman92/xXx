<div class="row">
    <div class="col-md-12">
        <h1 class="page-head-line">DATA ISI PAKET</h1>
        <h1 class="page-subhead-line">
            <ol class="breadcrumb">
                <li><a style="text-decoration: none;" href="./">Home</a></li>
                <li class="active">Data Isi Paket</li>
            </ol>
        </h1>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
    <div class="text-left"><a class="btn btn-primary" href="index.php?mod=tambah-isi-paket"><span class="fa fa-plus"></span> Isi Paket</a></div>
    <br />
        <table class="table table-responsive" id="data-paket">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Isi Paket</th>
                    <th>Isi</th>
                    <th>Paket</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $result = $db->query("SELECT
                                a.id_paket_detail,
                                a.id_paket,
                                a.nama_paket_detail,
                                a.isi,
                                b.nama_paket
                                FROM
                                tb_paket_detail AS a
                                Left Join tb_paket AS b ON a.id_paket = b.id_paket
                                ");
            $row    = $result->fetch_all(MYSQLI_ASSOC);
            $no = 1;
            foreach($row AS $data):
            ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $data['nama_paket_detail']; ?></td>
                    <td><?php echo $data['isi']; ?></td>
                    <td><?php echo $data['nama_paket']; ?></td>
                    <td><a href=""><span class="fa fa-edit"></span></a> | <a href=""><span class="fa fa-trash"></span></a></td>
                </tr>
                    
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