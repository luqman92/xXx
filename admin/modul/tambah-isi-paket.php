<div class="row">
    <div class="col-md-12">
        <h1 class="page-head-line">TAMBAH ISI PAKET</h1>
        <h1 class="page-subhead-line">
            <ol class="breadcrumb">
                <li><a style="text-decoration: none;" href="./">Home</a></li>
                <li><a style="text-decoration: none;" href="index.php?mod=data-isi-paket">Data Isi paket</a></li>
                <li class="active">Tambah Isi Paket</li>
            </ol>
        </h1>
    </div>
</div>
<!-- /. ROW  -->
<div class="row">
    
    <div class="col-md-2">
    
    </div>
    
    <div class="col-md-8">
        <form role="form" action="index.php?mod=proses-tambah-isi-paket" method="post">
            
            <div class="form-group">
                <label>Paket</label>
                <select class="form-control" name="id_paket">
                    <option>-- Pilih Paket --</option>
                    <?php
                    $result = $db->query("SELECT * FROM tb_paket");
                    $row    = $result->fetch_All(MYSQLI_ASSOC);
                    foreach($row AS $data):
                    ?>
                    <option value="<?php echo $data['id_paket'] ?>"><?php echo $data['nama_paket']; ?></option>
                    <?php
                    endforeach;
                    ?>
                </select>    
                <p class="help-block">Masukkan paket.</p>
            </div>
            
            <div class="form-group">
                <label>Isi Paket</label>
                <input class="form-control" type="text" required="on" name="nama_paket_detail" />
                <p class="help-block">Masukkan Isi Paket.</p>
            </div>
           
            <div class="form-group">
                <label>Isi</label>
                <input class="form-control" type="text" required="on" name="isi" />
                <p class="help-block">Masukkan isi misal : Kg, Liter, Dus, Dll.</p>
            </div>
           
            <button type="submit" class="btn btn-info">Simpan </button>
        </form>
    </div>
    
    <div class="col-md-2">
    
    </div>
</div>