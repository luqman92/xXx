<?php
if($_SESSION['level'] == 'admin'){
?>
                    <li>
                        <div class="user-img-div">
                        <?php
                        //$result = $db->query("SELECT * FROM tb_user WHERE username='".$_SESSION['username']."'");
//                        $row = $result->fetch_assoc();
                        ?>
                            <img src="../assets/img/<?php echo $_SESSION['foto']; ?>" class="img-thumbnail" />

                            <div class="inner-text">
                                <?php echo $_SESSION['nama_user']; ?>
                            <br />
                            <?php
                            date_default_timezone_set("Asia/jakarta");
                            $date = date("d-M-Y");
                            ?>
                                <small><?php echo $date."<div id='clock'></div>" ?> </small>
                            </div>
                        </div>

                    </li>


                    <li>
                        <a <?php if(@$_GET['mod']=='home'){ echo "class='active-menu'";} ?> href="./"><i class="fa fa-dashboard "></i>Dashboard</a>
                    </li>
                    
                    <li>
                        <a href="#" <?php if(@$_GET['mod']=='data-pelanggan'){ echo "class='active-menu-top'";}else if(@$_GET['mod']=='data-paket'){ echo "class='active-menu-top'";} ?>><i class="fa fa-desktop "></i>Master Data <span class="fa arrow"></span></a>
                         <ul <?php if(@$_GET['mod']=='data-pelanggan'){ echo "class='nav nav-second-level collapse in'";}else if(@$_GET['mod']=='data-paket'){ echo "class='nav nav-second-level collapse in'";}else{ echo "class='nav nav-second-level collapse'";} ?>>
                            <li>
                                <a <?php if(@$_GET['mod']=='data-kelompok'){ echo "class='active-menu'";} ?> href="index.php?mod=data-kelompok"><i class="fa fa-toggle-on"></i>Data Kelompok</a>
                            </li>
                            <li>
                                <a <?php if(@$_GET['mod']=='data-user'){ echo "class='active-menu'";} ?> href="index.php?mod=data-user"><i class="fa fa-toggle-on"></i>Data User</a>
                            </li>
                            <li>
                                <a <?php if(@$_GET['mod']=='data-pelanggan'){ echo "class='active-menu'";} ?> href="index.php?mod=data-pelanggan"><i class="fa fa-toggle-on"></i>Data Nasabah</a>
                            </li>
                            <li>
                                <a <?php if(@$_GET['mod']=='data-paket'){ echo "class='active-menu'";} ?> href="index.php?mod=data-paket"><i class="fa fa-bell "></i>Data Paket</a>
                            </li>
                             <!--li>
                                <a href="index.php?mod=data-isi-paket"><i class="fa fa-bell "></i>Data Isi Paket</a>
                            </li-->
                        </ul>
                    </li>
                    
                    <li>
                        <a href="#" <?php if(@$_GET['mod']=='data-pemesanan'){ echo "class='active-menu-top'";}else if(@$_GET['mod']=='data-angsuran'){ echo "class='active-menu-top'";} ?>><i class="fa fa-desktop "></i>Transaksi <span class="fa arrow"></span></a>
                         <ul <?php if(@$_GET['mod']=='data-pemesanan'){ echo "class='nav nav-second-level collapse in'";}else if(@$_GET['mod']=='data-angsuran'){ echo "class='nav nav-second-level collapse in'";}else{ echo "class='nav nav-second-level collapse'";} ?>>
                            <li>
                                <a <?php if(@$_GET['mod']=='data-pemesanan'){ echo "class='active-menu'";} ?> href="index.php?mod=data-pemesanan"><i class="fa fa-toggle-on"></i>Data Pemesanan</a>
                            </li>
                            <li>
                                <a <?php if(@$_GET['mod']=='data-angsuran'){ echo "class='active-menu'";} ?> href="index.php?mod=data-angsuran"><i class="fa fa-bell "></i>Data Angsuran</a>
                            </li>
                        </ul>
                    </li>
                    
                    <li>
                        <a href="#" <?php if(@$_GET['mod']=='lap-harian'){ echo "class='active-menu-top'";}else if(@$_GET['mod']=='lap-bulanan'){ echo "class='active-menu-top'";} ?>><i class="fa fa-desktop "></i>Laporan <span class="fa arrow"></span></a>
                         <ul <?php if(@$_GET['mod']=='lap-harian'){ echo "class='nav nav-second-level collapse in'";}else if(@$_GET['mod']=='lap-bulanan'){ echo "class='nav nav-second-level collapse in'";}else{ echo "class='nav nav-second-level collapse'";} ?>>
                            <li>
                                <a <?php if(@$_GET['mod']=='lap-harian'){ echo "class='active-menu'";} ?> href="index.php?mod=lap-harian"><i class="fa fa-toggle-on"></i>Laporan Harian</a>
                            </li>
                            <li>
                                <a <?php if(@$_GET['mod']=='lap-bulanan'){ echo "class='active-menu'";} ?> href="index.php?mod=lap-bulanan"><i class="fa fa-toggle-on "></i>Laporan Bulanan</a>
                            </li>
                            <!-- <li>
                                <a <?php if(@$_GET['mod']=='lap-pengambilan'){ echo "class='active-menu'";} ?> href="index.php?mod=lap-pengambilan"><i class="fa fa-toggle-on "></i>Laporan Pengambilan</a>
                            </li>
                            <li>
                                <a <?php if(@$_GET['mod']=='lap-blmlunas'){ echo "class='active-menu'";} ?> href="index.php?mod=lap-blmlunas"><i class="fa fa-toggle-on "></i>Laporan Belum Lunas</a>
                            </li>
                            <li>
                                <a <?php if(@$_GET['mod']=='lap-pelunasan'){ echo "class='active-menu'";} ?> href="index.php?mod=lap-pelunasan"><i class="fa fa-toggle-on "></i>Laporan Pelunasan</a>
                            </li>
                            <li>
                                <a <?php if(@$_GET['mod']=='lap-perpelanggan'){ echo "class='active-menu'";} ?> href="index.php?mod=lap-perpelanggan"><i class="fa fa-toggle-on "></i>Laporan Per Nasabah</a>
                            </li> -->
                            <li>
                                <a <?php if(@$_GET['mod']=='lap-semua-nasabah'){ echo "class='active-menu'";} ?> href="index.php?mod=lap-nasabah"><i class="fa fa-toggle-on "></i>Laporan Nasabah</a>
                            </li>
                        </ul>
                    </li>
<?php
}elseif($_SESSION['level']=='subadmin'){
    ?>
                        <li>
                        <div class="user-img-div">
                        <?php
                        //$result = $db->query("SELECT * FROM tb_user WHERE username='".$_SESSION['username']."'");
//                        $row = $result->fetch_assoc();
                        ?>
                            <img src="../assets/img/<?php echo $_SESSION['foto']; ?>" class="img-thumbnail" />

                            <div class="inner-text">
                                <?php echo $_SESSION['nama_user']; ?>
                            <br />
                            <?php
                            date_default_timezone_set("Asia/jakarta");
                            $date = date("d-M-Y");
                            ?>
                                <small><?php echo $date."<div id='clock'></div>" ?> </small>
                            </div>
                        </div>

                    </li>


                    <li>
                        <a <?php if(@$_GET['mod']=='home'){ echo "class='active-menu'";} ?> href="./"><i class="fa fa-dashboard "></i>Dashboard</a>
                    </li>
                    
                    <li>
                        <a href="#" <?php if(@$_GET['mod']=='data-pelanggan'){ echo "class='active-menu-top'";}else if(@$_GET['mod']=='data-paket'){ echo "class='active-menu-top'";} ?>><i class="fa fa-desktop "></i>Master Data <span class="fa arrow"></span></a>
                         <ul <?php if(@$_GET['mod']=='data-pelanggan'){ echo "class='nav nav-second-level collapse in'";}else if(@$_GET['mod']=='data-paket'){ echo "class='nav nav-second-level collapse in'";}else{ echo "class='nav nav-second-level collapse'";} ?>>
                            <li>
                                <a <?php if(@$_GET['mod']=='data-pelanggan'){ echo "class='active-menu'";} ?> href="index.php?mod=data-pelanggan"><i class="fa fa-toggle-on"></i>Data Nasabah</a>
                            </li>
                            <li>
                                <a <?php if(@$_GET['mod']=='data-kelompok'){ echo "class='active-menu'";} ?> href="index.php?mod=data-kelompok"><i class="fa fa-toggle-on"></i>Data Kelompok</a>
                            </li>
                        </ul>
                    </li>
                    
                    <li>
                        <a href="#" <?php if(@$_GET['mod']=='data-pemesanan'){ echo "class='active-menu-top'";}else if(@$_GET['mod']=='data-angsuran'){ echo "class='active-menu-top'";} ?>><i class="fa fa-desktop "></i>Transaksi <span class="fa arrow"></span></a>
                         <ul <?php if(@$_GET['mod']=='data-pemesanan'){ echo "class='nav nav-second-level collapse in'";}else if(@$_GET['mod']=='data-angsuran'){ echo "class='nav nav-second-level collapse in'";}else{ echo "class='nav nav-second-level collapse'";} ?>>
                            <li>
                                <a <?php if(@$_GET['mod']=='data-pemesanan'){ echo "class='active-menu'";} ?> href="index.php?mod=data-pemesanan"><i class="fa fa-toggle-on"></i>Data Pemesanan</a>
                            </li>
                        </ul>
                    </li>
                    
                    <li>
                        <a href="#" <?php if(@$_GET['mod']=='lap-harian'){ echo "class='active-menu-top'";}else if(@$_GET['mod']=='lap-bulanan'){ echo "class='active-menu-top'";} ?>><i class="fa fa-desktop "></i>Laporan <span class="fa arrow"></span></a>
                         <ul <?php if(@$_GET['mod']=='lap-harian'){ echo "class='nav nav-second-level collapse in'";}else if(@$_GET['mod']=='lap-bulanan'){ echo "class='nav nav-second-level collapse in'";}else{ echo "class='nav nav-second-level collapse'";} ?>>

                            <li>
                                <a <?php if(@$_GET['mod']=='lap-harian'){ echo "class='active-menu'";} ?> href="index.php?mod=lap-harian"><i class="fa fa-toggle-on"></i>Laporan Harian</a>
                            </li>
                            
                            <li>
                                <a <?php if(@$_GET['mod']=='lap-bulanan'){ echo "class='active-menu'";} ?> href="index.php?mod=lap-bulanan"><i class="fa fa-toggle-on "></i>Laporan Bulanan</a>
                            </li>

                            <li>
                                <a <?php if(@$_GET['mod']=='lap-semua-nasabah'){ echo "class='active-menu'";} ?> href="index.php?mod=lap-nasabah"><i class="fa fa-toggle-on "></i>Laporan Nasabah</a>
                            </li>
                        </ul>
                    </li>
    <?php
}else{
    ?>
                        <li>
                        <div class="user-img-div">
                        <?php
                        //$result = $db->query("SELECT * FROM tb_user WHERE username='".$_SESSION['username']."'");
//                        $row = $result->fetch_assoc();
                        ?>
                            <img src="../assets/img/<?php echo $_SESSION['foto']; ?>" class="img-thumbnail" />

                            <div class="inner-text">
                                <?php echo $_SESSION['nama_user']; ?>
                            <br />
                            <?php
                            date_default_timezone_set("Asia/jakarta");
                            $date = date("d-M-Y");
                            ?>
                                <small><?php echo $date."<div id='clock'></div>" ?> </small>
                            </div>
                        </div>

                    </li>


                    <li>
                        <a <?php if(@$_GET['mod']=='home'){ echo "class='active-menu'";} ?> href="./"><i class="fa fa-dashboard "></i>Dashboard</a>
                    </li>
                    
                    <li>
                        <a href="#" <?php if(@$_GET['mod']=='data-pelanggan'){ echo "class='active-menu-top'";}else if(@$_GET['mod']=='data-paket'){ echo "class='active-menu-top'";} ?>><i class="fa fa-desktop "></i>Master Data <span class="fa arrow"></span></a>
                         <ul <?php if(@$_GET['mod']=='data-pelanggan'){ echo "class='nav nav-second-level collapse in'";}else if(@$_GET['mod']=='data-paket'){ echo "class='nav nav-second-level collapse in'";}else{ echo "class='nav nav-second-level collapse'";} ?>>
                            <li>
                                <a <?php if(@$_GET['mod']=='data-pelanggan'){ echo "class='active-menu'";} ?> href="index.php?mod=data-pelanggan"><i class="fa fa-toggle-on"></i>Data Nasabah</a>
                            </li>
                        </ul>
                    </li>
                    
                    <li>
                        <a href="#" <?php if(@$_GET['mod']=='data-pemesanan'){ echo "class='active-menu-top'";}else if(@$_GET['mod']=='data-angsuran'){ echo "class='active-menu-top'";} ?>><i class="fa fa-desktop "></i>Transaksi <span class="fa arrow"></span></a>
                         <ul <?php if(@$_GET['mod']=='data-pemesanan'){ echo "class='nav nav-second-level collapse in'";}else if(@$_GET['mod']=='data-angsuran'){ echo "class='nav nav-second-level collapse in'";}else{ echo "class='nav nav-second-level collapse'";} ?>>
                            <li>
                                <a <?php if(@$_GET['mod']=='data-pemesanan'){ echo "class='active-menu'";} ?> href="index.php?mod=data-pemesanan"><i class="fa fa-toggle-on"></i>Data Pemesanan</a>
                            </li>
                        </ul>
                    </li>
                    
                    <li>
                        <a href="#" <?php if(@$_GET['mod']=='lap-harian'){ echo "class='active-menu-top'";}else if(@$_GET['mod']=='lap-bulanan'){ echo "class='active-menu-top'";} ?>><i class="fa fa-desktop "></i>Laporan <span class="fa arrow"></span></a>
                         <ul <?php if(@$_GET['mod']=='lap-harian'){ echo "class='nav nav-second-level collapse in'";}else if(@$_GET['mod']=='lap-bulanan'){ echo "class='nav nav-second-level collapse in'";}else{ echo "class='nav nav-second-level collapse'";} ?>>

                            <li>
                                <a <?php if(@$_GET['mod']=='lap-harian'){ echo "class='active-menu'";} ?> href="index.php?mod=lap-harian"><i class="fa fa-toggle-on"></i>Laporan Harian</a>
                            </li>
                            
                            <li>
                                <a <?php if(@$_GET['mod']=='lap-bulanan'){ echo "class='active-menu'";} ?> href="index.php?mod=lap-bulanan"><i class="fa fa-toggle-on "></i>Laporan Bulanan</a>
                            </li>

                            <li>
                                <a <?php if(@$_GET['mod']=='lap-semua-nasabah'){ echo "class='active-menu'";} ?> href="index.php?mod=lap-nasabah"><i class="fa fa-toggle-on "></i>Laporan Nasabah</a>
                            </li>
                        </ul>
                    </li>
    <?php
}
?>