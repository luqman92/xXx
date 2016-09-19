<script src="../assets/js/jquery-1.8.2.js"></script>
<script src="../assets/js/jquery-ui-1.9.0.custom.js"></script>
<script src="../assets/js/jquery.ui.datepicker-id.js"></script>

<!--script type="text/javascript">
    function showLaphari(str){
        if(str==""){
            document.getElementById("txtCari").innerHTML = "";
            return;
        } else {
            if("window.XMLHttpRequest") {
                //code for IE7+, Firefox, Chrome, Opera, Safari
                xmlHttp = new XMLHttpRequest();
            } else {
                //code for IE6,IE5
                xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function(){
                if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
                    document.getElementById("txtCari").innerHTML =xmlhttp.responseText;
                }
            }
            xmlhttp.open("GET",)
        }
    }
</script-->

<?php
include_once '../config/class.php';
include_once '../config/lib.php';

$id_kelompok = $_SESSION['id_kelompok'];
$Lap = new Laporan();
?>
<div class="row">
    <div class="col-md-12">
        <h1 class="page-head-line">LAPORAN HARIAN</h1>
        <h1 class="page-subhead-line">
            <ol class="breadcrumb">
                <li><a style="text-decoration: none;" href="./">Home</a></li>
                <li class="active">Laporan Harian</li>
            </ol>
        </h1>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <form action="?mod=lap-harian" method="post" onsubmit="if(this.q.value)return true;else return false;">
            <div class="form-group">
            	<div class="input-group">
           		   <input class="form-control" type="text" name="tgl_awal" id="tgl_awal" placeholder="Pilih Tanggal" autocomplete="off" required="required" />
                   <input type="hidden" name="do" value="find" />
            	   <span class="input-group-btn">
            	       <button class="btn btn-primary">Cari</button>
            	   </span>
           		</div>
       	    </div>
        </form>
    </div>
</div>

<div class="row">
    <?php
    if(@$_POST['do']=='find'){
        
    ?>    
    <div class="col-md-12">
        <div class="form-group">
            <label>Tanggal :</label>
            <?php echo date("d-M-Y",strtotime($_POST['tgl_awal'])); ?>
        </div>
        <table class="table table-responsive" id="lihat-angsuran">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Id Paket</th>
                    <th>Nama</th>
                    <th>Angsuran</th>
                    <th>Jml. Hari</th>
                    <th>Total Pembayaran</th>
                    <th>User</th>
                </tr>
            </thead>
            
            <tbody>
            <?php
            $no = 1;
            $totAng = 0;
            $arrayLapHarian = $Lap->tampilLapHariFilter($_POST['tgl_awal'],$id_kelompok);
            if(count($arrayLapHarian))
            {
                foreach($arrayLapHarian AS $data):
                $bayarTot = $data['harga'] * $data['jml_hari']; 
                $totAng = $totAng + $bayarTot;
                
            ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $data['id_pelanggan'] ?></td>
                    <td><?php echo $data['nama']; ?></td>
                    <td><?php echo format_angka($data['harga']); ?></td>
                    <td><?php echo $data['jml_hari']; ?></td>
                    <td><?php echo format_angka($bayarTot); ?></td>
                    <td><?php echo $data['nama_user']; ?></td>
                </tr>
            <?php
            $no++;
            endforeach;
            }else{
                echo "Data Kosong";
            }
            ?>
            </tbody>
            <tr>
                <td colspan="5" class="text-center">Total</td>
                <td colspan="2"><?php echo "Rp. ".format_angka($totAng).",-"; ?></td>
            </tr>
        </table>
    </div>
    <!-- ./COL-MD-12 -->
</div>
<!-- ./ROW -->
            <?php
            }
            ?>
<script type="text/javascript"> 
                $(document).ready(function(){
                   $("#tgl_awal").datepicker({
                      dateFormat: "yy-mm-dd",
                      changeMonth: true,
                      changeYear: true
                   });
                });
            </script>