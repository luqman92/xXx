<?php
include_once '../config/class.php';
include_once '../config/lib.php';

//instance objek kelompok
$newKelompok = new Kelompok();
?>
<script>
    function checkForm(formZ){
        if(formZ.nama.value==''){
            alert('Nama Kelompok tidak boleh kosong.');
            formZ.nama.focus();
            return false;
        }
        
    }
</script>

<div class="row">
    <div class="col-md-12">
        <h1 class="page-head-line">TAMBAH KELOMPOK</h1>
        <h1 class="page-subhead-line">
            <ol class="breadcrumb">
                <li><a style="text-decoration: none;" href="./">Home</a></li>
                <li><a style="text-decoration: none;" href="?mod=data-pelanggan">Data Kelompok</a></li>
                <li class="active">Tambah Kelompok</li>
            </ol>
        </h1>
    </div>
</div>
<!-- /. ROW  -->
<div class="row">
    
    <div class="col-md-2">
    
    </div>
    
    <div class="col-md-8">
        <form name="pelanggan" role="form" action="?mod=tambah-kelompok" method="post" onsubmit="return checkForm(this)">
            
            <div class="form-group">
                <label>Kelompok</label>
                <input class="form-control" type="text" name="nama_kelompok" autofocus="on" />
            </div>
            <input type="submit" name="btnsimpan" class="btn btn-info" value="Simpan" />
        </form>
        <?php
    if(isset($_POST['btnsimpan'])){
        //TAMBAH DATA PELANGGAN VIA METHOD
        $newKelompok->tambahDataKelompok($_POST['nama_kelompok'],$iduser);
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=?mod=data-kelompok">'; 
    }
?>
    </div>
    
    <div class="col-md-2">
    
    </div>
</div>