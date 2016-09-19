<html>
	<head>
		<title>Cetak Laporan Semua Nasabah</title>
		<!-- BOOTSTRAP STYLES-->
    <link href="../../../assets/css/bootstrap.css" rel="stylesheet" />
	</head>
	<style type="text/css">
	body{
		margin:0;
	}
	h3{
		margin-bottom: 50px;
	}
	</style>

	<script type="text/javascript">
	window.print();
	</script>
	<body>
	<?php
	session_start();
	error_reporting(0);
		include_once '../../../config/class.php';
		include_once '../../../config/lib.php';

		$db = new Database();

		// koneksi ke MySQL via method
		$db->connectMySQL();
		$user = new User();
		$iduser = $_SESSION['id_user'];
		if (!$user->get_sesi())
		{
		header("location:../../");
		}
	?>
		<h3 class="text-center">Laporan Semua Nasabah Periode (_________________)</h3>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>No</th>
					<th>Kode Paket</th>
					<th>Nama</th>
					<th>Paket</th>
					<th>Jml</th>
					<th>Total</th>
					<th>Status</th>
					<th>TTD</th>
				</tr>
			</thead>
			<tbody>
            <?php
            $no = 1;
            $totAng = 0;
            $totADM = 0;
            $Lap = new Pelanggan();
            $arrayLapBulanan = $Lap->tampilPelangganSemua();
            if(count($arrayLapBulanan))
            {
                foreach($arrayLapBulanan AS $data):
                    $id_pelanggan = $data['id_pelanggan'];
                    
                    $clslap = new Laporan();
                    $arraynsb = $clslap->tampilLapSemuaNasabahFilter($id_pelanggan);
                    foreach($arraynsb AS $data2) {
                        $id_pemesanan = $data2['id_pemesanan'];

                        $clspem = new Pemesanan();
                        $arraypem = $clspem->tampilPemesananById($id_pemesanan);
                        foreach($arraypem AS $data3){
                            $tot = $data3['harga'] * $data2['jml'];
                            $totAdm = $data3['tadm'];
                            $totAng = $totAng + $tot;
                            $totADM = $totADM + $totAdm;
            ?>			
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $data['id_pelanggan']; ?></td>
                    <td><?php echo $data['nama']; ?></td>
                    <td><?php echo $data3['nama_paket']." (".$data3['harga'].")"; ?></td>
                    <td><?php echo $data2['jml']; ?></td>
                    <td><?php echo format_angka($tot); ?></td>
                    <td><?php echo $data3['status']; ?></td>
                </tr>
            <?php
            $no++;
                    }
                }
            endforeach;

            }else{
                echo "Data Kosong";
            }
            ?>
            </tbody>
        </table>
        <table>
        	<tr>
                <td><b>Total</b></td>
                <td><?php echo "<b>Rp. ".format_angka($totAng).",-</b>"; ?></td>
            </tr>
            <tr>
                <td><b>Total ADM</b></td>
                <td>: </td>
                <td><?php echo "<b>Rp. ".format_angka($totADM).",-</b>"; ?></td>
            </tr>
            <tr>
                <td><b>Total Setoran</b></td>
                <td>: </td>
                <td><?php echo "<b>Rp. ".format_angka($totAng - $totADM).",-</b>"; ?></td>
            </tr>
        </table>
	</body>
</html>