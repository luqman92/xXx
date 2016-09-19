<?php
include_once '../config/class.php';
include_once '../config/lib.php';

//instance objek kelompok
$kelompok = new Kelompok();
?>
<script>
    function checkForm(formZ){
        if(formZ.nama.value==''){
            alert('Nama User tidak boleh kosong.');
            formZ.nama.focus();
            return false;
        }
        
    }
</script>

<div class="row">
    <div class="col-md-12">
        <h1 class="page-head-line">TAMBAH USER</h1>
        <h1 class="page-subhead-line">
            <ol class="breadcrumb">
                <li><a style="text-decoration: none;" href="./">Home</a></li>
                <li><a style="text-decoration: none;" href="?mod=data-pelanggan">Data User</a></li>
                <li class="active">Tambah User</li>
            </ol>
        </h1>
    </div>
</div>
<!-- /. ROW  -->
<div class="row">
    
    <div class="col-md-2">
    
    </div>
    
    <div class="col-md-8">
        <form name="pelanggan" role="form" action="?mod=tambah-user" method="post" onsubmit="return checkForm(this)">
            
            <div class="form-group">
                <label>Username</label>
                <input class="form-control" type="text" name="username" autofocus="on" />
            </div>
           
            <div class="form-group">
                <label>Password</label>
                <input class="form-control" type="text" name="password" />
                <p class="help-block">Masukkan Nama Lengkap.</p>
            </div>
           
            <div class="form-group">
                <label>Nama</label>
                <input class="form-control" type="text" name="nama_user" />
            </div>
            
            <!-- <div class="form-group">
                <label>Foto</label>
                <input class="form-control" type="file" name="foto" />
            </div> -->
           
            <div class="form-group">
                <label>Kelompok</label>
                <select id="kelompok" class="form-control" name="id_kelompok">
                    <option>-- Pilih Kelompok --</option>
                    <?php
                    $arrayKelompok=$kelompok->tampilKelompokSemua();
                    foreach($arrayKelompok AS $data):
                    ?>
                    <option value="<?php echo $data['id_kelompok'] ?>"><?php echo $data['nama_kelompok']; ?></option>
                    <?php
                    endforeach;
                    ?>
                </select>    
                <p class="help-block">Masukkan paket yang diminati.</p>
            </div>
            
            <div class="form-group">
                <label>Level</label>
                <select class="form-control" name="level">
                    <option value=""></option>
                    <option value="admin">admin</option>
                    <option value="subadmin">subadmin</option>
                    <option value="pegawai">pegawai</option>
                </select>
            </div>
            <input type="submit" name="btnsimpan" class="btn btn-info" value="Simpan" />
        </form>
        <?php
    if(isset($_POST['btnsimpan'])){
        //TAMBAH DATA PELANGGAN VIA METHOD
        $user->tambahDataUser($_POST['username'],sha1($_POST['password']),$_POST['nama_user'],$_POST['id_kelompok'],$_POST['level'],$iduser);
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=?mod=data-user">'; 
    }
?>
    </div>
    
    <div class="col-md-2">
    
    </div>
</div>
<script>
    $(document).ready(function(){
       $("#kelompok").select2({
            placeholder:"Please Select"
       }); 
    });
</script>