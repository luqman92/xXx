<?php
include_once '../config/class.php';
include_once '../config/lib.php';

//PROSES HAPUS DATA
if(isset($_GET['aksi']))
{
    if($_GET['aksi'] == 'hapus')
    {
        //BACA ID DARI PARAMETER ID USER YANG AKAN DIHAPUS
        $idusr = $_GET['idusr'];
        //PROSES HAPUS DATA USER BERDASARKAN ID VIA METHOD
        $user->hapusUser($idusr);
        ?>
            <script>
                alert("Data User ID <?php echo $idusr; ?> sudah dihapus");
                document.location="?mod=data-user";
            </script>
        <?php
    }
    
    //PROSES EDIT DATA
    else if($_GET['aksi'] == 'edit')
    {
        //BACA ID USER YANG AKAN DI EDIT
        $idusr = $_GET['idusr'];
        //MENAMPILKAN FORM EDIT USER
        //UNTUK MENAMPILKAN DATA DETIL USER, GUNAKAN METHOD bacaDataPelanggan()
        global $arr_level;
        $arr_level["admin"] = "admin";
        $arr_level["pegawai"] = "pegawai";
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
        <h1 class="page-head-line">UBAH USER</h1>
        <h1 class="page-subhead-line">
            <ol class="breadcrumb">
                <li><a style="text-decoration: none;" href="./">Home</a></li>
                <li><a style="text-decoration: none;" href="?mod=data-user">Data User</a></li>
                <li class="active">Ubah User</li>
            </ol>
        </h1>
    </div>
</div>
<!-- /. ROW  -->
<div class="row">
    
    <div class="col-md-2">
    
    </div>
    
    <div class="col-md-8">
        <form name="user" role="form" action="?mod=ubah-user&aksi=update" method="post" onsubmit="return checkForm(this)">
        <input type="hidden" name="id_user" value="<?php echo $idusr; ?>" />

                        <div class="form-group">
                <label>Username</label>
                <input class="form-control" type="text" name="username" autofocus="on" value="<?php echo $user->bacaDataUser('username',$idusr) ?>" />
            </div>
           
            <div class="form-group">
                <label>Password</label>
                <input class="form-control" type="text" name="password" />
            </div>
           
            <div class="form-group">
                <label>Nama</label>
                <input class="form-control" type="text" name="nama_user" value="<?php echo $user->bacaDataUser('nama_user',$idusr) ?>" />
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
                    $kelompok= new kelompok();
                    $arrayKelompok=$kelompok->tampilKelompokSemua();
                    foreach($arrayKelompok AS $data):
                        $selkel = "";
                        if($data['id_kelompok'] == $user->bacaDataUser('id_kelompok',$idusr)){
                            $selkel="selected";
                        }
                    ?>
                    <option value="<?php echo $data['id_kelompok'] ?>" <?=$selkel;?>><?php echo $data['nama_kelompok']; ?></option>
                    <?php
                    endforeach;
                    ?>
                </select>    
            </div>
            
            <div class="form-group">
                <label>Level</label>
                <select class="form-control" name="level">
                    <?php $level = $user->bacaDataUser('level',$idusr); ?>
                    <?php
                    echo $level;
                    foreach ($arr_level as $k => $v) {
                       ?>
                        <option value="<?=$k?>" <?=$level==$k?"selected='selected'":""?> ><?=$v?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
            <input type="submit" name="btnsimpan" class="btn btn-info" value="Simpan" />
        </form>
       
    </div>
    
    <div class="col-md-2">
    
    </div>
</div>
<?php
    }
    else if($_GET['aksi'] == 'update') {
        if(!empty($_POST['password'])){
        //UPDATE DATA PELANGGAN VIA METHOD
        $user->updateDataUser( $_POST['id_user'], $_POST['username'], sha1($_POST['password']), $_POST['nama_user'], $_POST['id_kelompok'], $_POST['level']);    
    }else{
        //UPDATE DATA PELANGGAN VIA METHOD
        $user->updateDataUserNopwd( $_POST['id_user'], $_POST['username'], $_POST['nama_user'], $_POST['id_kelompok'], $_POST['level']);
    }
        ?>
        <script>
            alert("Data user sudah di update");
            document.location="?mod=data-user";
        </script>
        <?php
    }
}
?>