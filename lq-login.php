<?php
session_start();
include_once 'config/class.php';
include_once 'config/class.validasi.php';

//INSTANCE OBJEK DB DAN USER
$user = new User();
$validasi = new Validasi();
$db = new Database();

//KONEKSI KE MYSQL BIA METHOD
$db->connectMySQL();

//CEK APAKAH USER LOGIN ATAU TIDAK VIA METHOD
if($user->get_sesi()){
    header("location:admin/");
}
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $username = $validasi->validSql($_POST['username']);
    $login = $user->cek_login($username, $_POST['password']);
    if($login) {
        //LOGIN SUKSES, ARAHKAN KE FOLDER ADMIN
        header("location:admin/index.php?mod=home");                
     }else{
        //LOGIN GAGAL, BERI TAHU PERINGATAN ke FILE LOGIN.PHP
        ?>
            <script>
                alert("Maaf, User Atau Password Anda salah!!");
                document.location="lq-login";                                
            </script>
        <?php                                
        }        
    }    

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Paket Setiawati</title>

    <!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

</head>
<body style="background-color: #E2E2E2;">
    <div class="container">
        <div class="row text-center " style="padding-top:100px;">
            <div class="col-md-12">                            
                <img src="assets/img/logo-setiawati.png" />
            </div>
        </div>
         <div class="row ">                                    
                                                                                         
                <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                           
                            <div class="panel-body">
                                <form role="form" method="post" name="login">
                                    <hr />
                                    <h5>Enter Details to Login</h5>
                                       <br />
                                     <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-tag"  ></i></span>
                                            <input type="text" class="form-control" placeholder="Your Username " name="username" required="on" autofocus="on" autocomplete="off" />
                                        </div>
                                                                              <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                                            <input type="password" class="form-control"  placeholder="Your Password" name="password" required="on" />
                                        </div>
                                    <div class="form-group">
                                            <label class="checkbox-inline">
                                                <input type="checkbox" /> Remember me
                                            </label>
                                            
                                        </div>
                                     
                                     <button class="btn btn-primary" type="submit">Login Now</button>
                                    <hr />
                                    </form>
                            </div>
                           
                        </div>
                
                
        </div>
    </div>

</body>
</html>
