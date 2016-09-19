<?php
include_once '../config/class.php';
include_once '../config/lib.php';

$pemesanan = new Pemesanan();
$id_kelompok = $_SESSION['id_kelompok'];

$iduser = $_SESSION['id_user'];
if (!$user->get_sesi()) {
  header("location:../");
}
?>
<div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">DASHBOARD</h1>
                        <h1 class="page-subhead-line">
                            <ol class="breadcrumb">
                                <li class="active">Home</li>
                            </ol>
                        </h1>

                    </div>
                </div>
                <!-- /. ROW  -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="main-box mb-red">
                            <a href="?mod=tambah-pelanggan">
                                <i class="fa fa-bolt fa-5x"></i>
                                <h5>Daftar Nasabah</h5>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="main-box mb-dull">
                            <a href="?mod=data-pemesanan">
                                <i class="fa fa-plug fa-5x"></i>
                                <h5>
                                <?php 
                                $arrayPemesanan = $pemesanan->tampilCountPemesanan($id_kelompok); 
                                foreach($arrayPemesanan AS $data):
                                echo $data['jml_pemesanan'];
                                endforeach;
                                ?>
                                Pemesanan</h5>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="main-box mb-pink">
                            <a href="#">
                                <i class="fa fa-dollar fa-5x"></i>
                                <h5>laporan</h5>
                            </a>
                        </div>
                    </div>

                </div>
                <!-- /. ROW  -->
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-info">
                            <!-- TEXT IN HERE -->
                        </div>
                    </div>
                </div>
                <!-- /. ROW  -->