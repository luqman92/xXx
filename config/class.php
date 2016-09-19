<?php
class Database {
    //PROPERTI
    private $dbHost = "localhost";
    private $dbUser = "root";
    private $dbPass = "";
    private $dbName = "dbpaketsetiawati";
    
    //PROPERTI HOSTING
    #private $dbHost = "mysql.idhostinger.com";
    #private $dbUser = "u373450688_pkt";
    #private $dbPass = "ARNZDpxqhusW60za4r";
    #private $dbName = "u373450688_pkt";
    
    //METHOD KONEKSI MYSQL
    function connectMySQL() {
        mysql_connect($this->dbHost, $this->dbUser, $this->dbPass);
        mysql_select_db($this->dbName) or die ("Database Tidak Ditemukan di Server");
    }
}

class User {
    
    //PROSES LOGIN
    function cek_login($user, $password)
    {
        $password   = sha1($password);
        $sql = "SELECT a.id_user,a.username,a.password,a.nama_user,a.foto,a.level,a.id_kelompok
                FROM tb_user AS a
                WHERE a.username='$user' AND a.password='$password'";
        $qry = mysql_query($sql);
        $user_data  = mysql_fetch_array($qry);
        $no_rows = mysql_num_rows($qry);
        if($no_rows == 1) {
            $_SESSION['login'] = TRUE;
            $_SESSION['id_user'] = $user_data['id_user'];
            $_SESSION['nama_user'] = $user_data['nama_user'];
            $_SESSION['foto'] = $user_data['foto'];
            $_SESSION['level'] = $user_data['level'];
            $_SESSION['id_kelompok'] = $user_data['id_kelompok'];
            return true;
        }
        else{
            return false;    
        }
    }
    
    //AMBIL SESI
    function get_sesi() {
        return @$_SESSION['login'];
    }
    
    //LOGOUT
    function user_logout() {
        $_SESSION['login'] = false;
        session_destroy();
    }

    function tampilSemuaUser()
    {
        $sql="SELECT a.id_user,a.username,a.nama_user,a.foto,a.id_kelompok,a.`level`,b.nama_kelompok
            FROM tb_user AS a 
            LEFT JOIN tb_kelompok AS b ON a.id_kelompok = b.id_kelompok";
        $qry=mysql_query($sql);
        $numrows=mysql_num_rows($qry);
        if($numrows !=0){
            while($row=mysql_fetch_array($qry))
                $data[]=$row;
                return $data;

        }
    }

    function tambahDataUser($username,$password,$nama_user,$id_kelompok,$level,$iduser)
    {
        $sql="INSERT INTO tb_user SET username='$username', password='$password', nama_user='$nama_user', foto='user.png', id_kelompok='$id_kelompok', level='$level', create_at=now(), create_id_user='$iduser'";
        $qry=mysql_query($sql);

    }

    function bacaDatauser($field,$idusr)
    {
        $sql="SELECT * FROM tb_user WHERE id_user='$idusr'";
        $qry=mysql_query($sql);
        $data=mysql_fetch_array($qry);
        if($field == 'id_user') return $data['id_user'];
        elseif($field == 'username') return $data['username'];
        elseif($field == 'password') return $data['password'];
        elseif($field == 'nama_user') return $data['nama_user'];
        elseif($field == 'id_kelompok') return $data['id_kelompok'];
        elseif($field == 'level') return $data['level'];
    }

    function updateDataUser($id_user,$username,$password,$nama_user,$id_kelompok,$level)
    {
        $sql="UPDATE tb_user SET username='$username', password='$password', nama_user='$nama_user', id_kelompok='$id_kelompok', level='$level' WHERE id_user='$id_user'";
        //print_r($sql);
        $qry=mysql_query($sql);

    }

    function updateDataUserNopwd($id_user,$username,$nama_user,$id_kelompok,$level)
    {
        $sql="UPDATE tb_user SET username='$username', nama_user='$nama_user', id_kelompok='$id_kelompok', level='$level' WHERE id_user='$id_user'";
        //print_r($sql);
        $qry=mysql_query($sql);

    }

    function hapusUser($idusr)
    {
        $query = mysql_query("DELETE FROM tb_user WHERE id_user='$idusr'");
        //echo "Data Pelanggan ID".$id_user." sudah dihapus";
    }
}

class Pelanggan {
    
    //METHOD TAMPIL DATA PELANGGAN
    function tampilPelangganSemua($id_kelompok) {
        if($id_kelompok == '0'){
            $query = mysql_query("SELECT * FROM tb_pelanggan WHERE status_cd='normal' ORDER BY id_pelanggan");
            $numrows = mysql_num_rows($query);
            if($numrows !=0){
            while($row = mysql_fetch_array($query))
            $data[] = $row;
            return $data;
            }
        }else{
            $query = mysql_query("SELECT * FROM tb_pelanggan WHERE status_cd='normal' AND id_kelompok='$id_kelompok' ORDER BY id_pelanggan");
            $numrows = mysql_num_rows($query);
            if($numrows !=0){
            while($row = mysql_fetch_array($query))
            $data[] = $row;
            return $data;
            }
        }

    }
    
    //METHOD FILTER DATA PELANGGAN
    function tampilPelangganFilter($keyword) {
        $query = mysql_query("SELECT * FROM tb_pelanggan WHERE nama LIKE '%$keyword%'");
        $no_rows = mysql_num_rows($query);
        if($no_rows == 1) {
            while($row = mysql_fetch_array($query))
            $data[]=$row;
            return $data;
        }
    }
    
    //METHOD MENGAMBIL DATA PELANGGAN
    function bacaDataPelanggan($field,$id_pelanggan) {
        $query = mysql_query("SELECT * FROM tb_pelanggan WHERE id_pelanggan = '$id_pelanggan'");
        $data=mysql_fetch_array($query);
        if ($field == 'id_pelanggan') return $data['id_pelanggan'];                
        else if($field == 'nama') return $data['nama']; 
        else if($field == 'alamat') return $data['alamat'];     
        else if($field == 'telepon') return $data['telepon']; 
        else if($field == 'keterangan') return $data['keterangan'];        
    }
    
    //METHOD UNTUK PROSES UPDATE DATA PELANGGAN
    function updateDataPelanggan($id_pelanggan,$nama,$alamat,$telepon,$id_user) {
        $query = mysql_query("UPDATE tb_pelanggan SET nama='$nama', alamat='$alamat', telepon='$telepon', update_at=now(), update_id_user='$id_user' WHERE id_pelanggan='$id_pelanggan'");
        }
        //METHOD MENGHAPUS DATA PELANGGAN
    function hapusPelanggan($id_pelanggan,$iduser) {
        /*$query = mysql_query("DELETE FROM tb_pelanggan WHERE id_pelanggan='$id_pelanggan'");*/
        //echo "Data Pelanggan ID".$id_pelanggan." sudah dihapus";
        $sql = "UPDATE tb_pelanggan SET status_cd='nullified',nullified_id_user='$iduser' WHERE id_pelanggan='$id_pelanggan'";
        $qry = mysql_query($sql);
    }
    //METHOD UNTUK PROSES TAMBAH DATA PELANGGAN
    function tambahDataPelanggan($id_pelanggan,$nama,$alamat,$telepon,$id_paket,$keterangan,$id_kelompok,$kd_buku,$id_user) {
        $query_paket = mysql_query("SELECT * FROM tb_paket WHERE id_paket='$id_paket'");
        $data = mysql_fetch_assoc($query_paket);
        $harga = $data['harga_paket'];
        $adm = $data['administrasi'];
            
        $query_plg = "INSERT INTO tb_pelanggan SET id_pelanggan='$id_pelanggan', nama='$nama', alamat='$alamat', telepon='$telepon', tgl_daftar=now(), id_kelompok='$id_kelompok', create_at=now(), create_id_user='$id_user'";
        $hasil1 = mysql_query($query_plg);
        //print_r($query);
            
        $query_pemesanan = "INSERT INTO tb_pemesanan SET id_pemesanan='$id_pelanggan', id_pelanggan='$id_pelanggan',id_paket='$id_paket',harga='$harga', adm='$adm', keterangan='$keterangan', tgl_pesan=now(), id_kelompok='$id_kelompok', kd_buku='$kd_buku', create_at=now(), create_id_user='$id_user'";
        $hasil2 = mysql_query($query_pemesanan);
    }
}

class Kelompok {
    function tampilKelompokSemua() {
        $query = mysql_query("SELECT a.id_kelompok,a.nama_kelompok FROM tb_kelompok AS a WHERE a.status_cd='normal'");
        while($row=mysql_fetch_array($query)) $data[]=$row;
        return $data;
    }
    
    function tambahDataKelompok($nama_kelompok,$iduser)
    {
        $sql = "INSERT INTO tb_kelompok SET nama_kelompok='$nama_kelompok',create_at=now(),create_id_user='$iduser'";
        $qry = mysql_query($sql);
    }

    function bacaDataKelompok($field,$id_kelompok)
    {
        $sql = "SELECT a.id_kelompok,a.nama_kelompok FROM tb_kelompok AS a WHERE a.id_kelompok='$id_kelompok'";
        $qry = mysql_query($sql);
        $arr = mysql_fetch_array($qry);
        if($field == 'id_kelompok') return $arr['id_kelompok'];
        if($field == 'nama_kelompok') return $arr['nama_kelompok'];
    }

    function updateDataKelompok($id_kelompok,$nama_kelompok,$iduser)
    {
        $sql = "UPDATE tb_kelompok SET nama_kelompok='$nama_kelompok',update_at=now(),update_id_user='$iduser' WHERE id_kelompok='$id_kelompok'";
        $qry = mysql_query($sql);
    }

    function hapusKelompok($id_kelompok,$iduser)
    {
        /*$sql = "DELETE FROM tb_kelompok WHERE id_kelompok='$id_kelompok'";
        $qry = mysql_query($sql);*/
        $sql = "UPDATE tb_kelompok SET status_cd='nullified',nullified_at=now(),nullified_id_user='$iduser' WHERE id_kelompok='$id_kelompok'";
        $qry = mysql_query($sql);
    }
}

class Paket {
    function tampilPaketSemua() {
        $query = mysql_query("SELECT * FROM tb_paket ORDER BY id_paket");
        while($row=mysql_fetch_array($query)) $data[]=$row;
        return $data;
    }
    
    //METHOD MENGAMBIL BACA DATA PAKET
    function bacaDataPaket($field,$id_paket) {
        $query  = mysql_query("SELECT * FROM tb_paket WHERE id_paket='$id_paket'");
        $data   = mysql_fetch_array($query);
        if($field == 'nama_paket') return $data['nama_paket'];
        else if($field == 'harga_paket') return $data['harga_paket'];
        else if($field == 'administrasi') return $data['administrasi'];
    }
    
    //METHOD UNTUK PROSES UPDATE DATA PAKET
    function updateDataPaket($id_paket,$nama_paket,$harga_paket,$administrasi) {
        $query = mysql_query("UPDATE tb_paket SET nama_paket='$nama_paket', harga_paket='$harga_paket', administrasi='$administrasi' WHERE id_paket='$id_paket'");
    }
    
    //METHOD MENGHAPUS DATA PAKET
    function hapusPaket($id_paket) {
        $query = mysql_query("DELETE FROM tb_paket WHERE id_paket='$id_paket'");
    }
    
    function simpanPaket($nama_paket,$harga_paket,$administrasi) {
        $query = "INSERT INTO tb_paket SET nama_paket='$nama_paket', harga_paket='$harga_paket', administrasi='$administrasi'";
        $hasil = mysql_query($query);
    }
}

class Pemesanan {
    function tampilPemesananSemua($id_kelompok) {
        if($id_kelompok =='0'){
            $query = mysql_query("SELECT a.id_pemesanan,a.id_pelanggan,a.id_paket,a.keterangan,a.harga,a.status,a.adm,a.id_kelompok,b.nama,c.nama_paket
                                FROM tb_pemesanan AS a
                                Left Join tb_pelanggan AS b ON a.id_pelanggan = b.id_pelanggan
                                Left Join tb_paket AS c ON a.id_paket = c.id_paket
                                WHERE a.status_cd='normal' 
                    ");
            $numrows = mysql_num_rows($query);
            if($numrows !=0){
                while($row=mysql_fetch_array($query)) 
                    $data[]=$row;
                    return $data;
            }
        }else{
            $query = mysql_query("SELECT a.id_pemesanan,a.id_pelanggan,a.id_paket,a.keterangan,a.harga,a.status,a.adm,a.id_kelompok,b.nama,c.nama_paket
                                FROM tb_pemesanan AS a
                                Left Join tb_pelanggan AS b ON a.id_pelanggan = b.id_pelanggan
                                Left Join tb_paket AS c ON a.id_paket = c.id_paket
                                WHERE a.status_cd='normal' 
                                AND a.id_kelompok='$id_kelompok'
                    ");
            $numrows = mysql_num_rows($query);
            if($numrows !=0){
                while($row=mysql_fetch_array($query)) 
                    $data[]=$row;
                    return $data;
            }
        }

    }

    function tampilPemesananById($id_pemesanan) {
        $sql = "SELECT a.id_pemesanan, a.id_paket, a.harga, b.nama_paket, a.status, SUM(a.adm) AS tadm
                FROM tb_pemesanan AS a
                LEFT JOIN tb_paket AS b ON a.id_paket = b.id_paket
                WHERE id_pemesanan='$id_pemesanan'";
        $qry = mysql_query($sql);
        $numrows = mysql_num_rows($qry);
        if($numrows !=0)
        {
            while($row=mysql_fetch_array($qry))
                $data[]=$row;
            return $data;
        }

    }
    function tampilperpemesanan($field,$id_pemesanan) {
        $query = mysql_query("SELECT
                a.id_pemesanan,
                a.id_pelanggan,
                a.id_paket,
                a.keterangan,
                a.harga,
                a.status,
                a.id_kelompok,
                a.adm,
                b.nama,
                c.nama_paket
                FROM
                tb_pemesanan AS a
                Left Join tb_pelanggan AS b ON a.id_pelanggan = b.id_pelanggan
                Left Join tb_paket AS c ON a.id_paket = c.id_paket
                WHERE a.id_pemesanan='$id_pemesanan'");
        $data = mysql_fetch_array($query);
        if($field =='id_pemesanan') return $data['id_pemesanan'];
        else if($field == 'id_paket') return $data['id_paket'];
        else if($field == 'id_kelompok') return $data['id_kelompok'];
        else if($field == 'nama') return $data['nama'];
        else if($field == 'nama_paket') return $data['nama_paket'];
        else if($field == 'harga') return $data['harga'];
        else if($field == 'adm') return $data['adm'];
        else if($field == 'status') return $data['status'];

    }
    function tampilCountPemesanan($id_kelompok) {
        if($id_kelompok == '0'){
            $query = mysql_query("SELECT count(a.id_pemesanan) as jml_pemesanan FROM tb_pemesanan AS a");
            while($row=mysql_fetch_array($query)) $data[]=$row;
            return $data;
        }else{
            $query = mysql_query("SELECT count(a.id_pemesanan) as jml_pemesanan FROM tb_pemesanan AS a WHERE a.id_kelompok='$id_kelompok'");
            while($row=mysql_fetch_array($query)) $data[]=$row;
            return $data;
        }
    }

    function tampilCountByIdKelompok($id_kelompok)
    {
        $sql = "SELECT a.id_pemesanan, SUM(a.id_kelompok) AS jml
                FROM tb_pemesanan AS a
                WHERE a.id_kelompok='$id_kelompok'
                ";
        $qry = mysql_query($sql);
        $numrows = mysql_num_rows($qry); 
        if($numrows !=0){
            while($row=mysql_fetch_array($qry))
                $data[]=$row;
            return $data;
        }

    }

    function updatePemesanan($id_pemesanan,$id_paket,$harga,$adm,$id_kelompok,$status) {
        $query = "UPDATE tb_pemesanan SET id_paket='$id_paket', harga='$harga', adm='$adm', id_kelompok='$id_kelompok', status='$status' WHERE id_pemesanan='$id_pemesanan'";
        $hasil = mysql_query($query);
    }

    function hapusPemesananById($id,$id_user)
    {
        $sql = "UPDATE tb_pemesanan SET status_cd='nullified', nullified_at=now(),nullified_id_user='$id_user' WHERE id_pemesanan='$id'";
        $sql2 = "UPDATE tb_angsuran SET status_cd='nullified', nullified_at=now(),nullified_id_user='$id_user' WHERE id_pemesanan='$id'";
        $qry = mysql_query($sql);
        $qry2 = mysql_query($sql2);
    }
}

class Angsuran
{
    //METHOD TAMPIL DATA PEMESANAN ANGSURAN
    function tampilPesanAngsur($field,$idpsn)
    {
        $query = mysql_query("SELECT a.id_pemesanan,a.adm,a.harga,a.id_pelanggan,a.status,a.kd_buku,b.nama_paket FROM tb_pemesanan AS a LEFT JOIN tb_paket AS b ON a.id_paket = b.id_paket WHERE id_pemesanan='$idpsn'");
        $data=mysql_fetch_array($query);
        if($field == 'id_pemesanan') return $data['id_pemesanan'];
        else if($field == 'adm') return $data['adm'];
        else if($field == 'harga') return $data['harga'];
        else if($field == 'id_pelanggan') return $data['id_pelanggan'];
        else if($field == 'kd_buku') return $data['kd_buku'];
        else if($field == 'status') return $data['status'];
        else if($field == 'nama_paket') return $data['nama_paket'];
        
    }
    function tampilPesanPelanggan($field,$id_pelanggan)
    {
        $query = mysql_query("SELECT id_pelanggan, nama, alamat FROM tb_pelanggan WHERE id_pelanggan='$id_pelanggan'");
        $data=mysql_fetch_array($query);
        if($field == 'id_pelanggan') return $data['id_pelanggan'];
        else if($field == 'nama') return $data['nama'];
        else if($field == 'alamat') return $data['alamat'];
    }
    
    function cariAngsuran($nopsn)
    {
        $query=mysql_query("SELECT * FROM tb_angsuran WHERE id_pemesanan='$idpsn' AND item_id(SELECT MAX(item_id) FROM tb_angsuran WHERE id_pemesanan='$idpsn')");
        if(mysql_num_rows($query)>0)
        {
            //JIKA SUDAH PERNAH MEMBAYAR ANGSURAN, MAKA ANGSURAN DITAMBAH 1
            $data=mysql_fetch_array($query);
            $item_id = $data['item_id']+1;
            return $item_id;
        }else {
            //JIKA BELUM PERNAH MEMBAYAR ANGSURAN, MAKA SETTING MENJADI ANGSURAN PERTAMA
            $item_id = 1;
            return $item_id;
        }
    }
    //METHOD CARI SISA ANGSURAN
    function cariSisaAngsur($lama,$angsur_ke)
    {
        $sisa_ags = $lama - $angsur_ke;
        return $sisa_ags;
    }
    
    //METHOD SIMPAN DATA ANGSURAN
    function simpanAngsuran($tgl_angsuran,$tgl_awal,$tgl_akhir,$id_pelanggan,$id_pemesanan,$id_user)
    {
        $datediff = mysql_query("SELECT DATEDIFF('$tgl_akhir','$tgl_awal') AS jml_hari");
        $data = mysql_fetch_assoc($datediff);
        $jml_hari = $data['jml_hari']+1;
        
        $query = "INSERT INTO tb_angsuran SET id_pemesanan='$id_pemesanan', id_pelanggan='$id_pelanggan',tgl_awal='$tgl_awal',tgl_akhir='$tgl_akhir', tgl_angsuran='$tgl_angsuran', jml_hari='$jml_hari', id_user='$id_user' ,create_at=now()";
        $hasil2 = mysql_query($query);
    }
    function tampilPerPelanggan($no_psn)
    {
        $query = mysql_query("SELECT
                        a.no_ang,
                        a.id_pemesanan,
                        a.id_pelanggan,
                        a.tgl_awal,
                        a.tgl_akhir,
                        a.jml_hari,
                        a.item_id,
                        a.tgl_angsuran,
                        a.id_user,
                        b.harga,
                        b.adm,
                        c.nama_user
                        FROM
                        tb_angsuran AS a
                        Left Join tb_pemesanan AS b ON a.id_pemesanan = b.id_pemesanan
                        Left Join tb_user AS c ON a.id_user = c.id_user
                        WHERE a.id_pemesanan='$no_psn' ORDER BY a.tgl_angsuran DESC");
        $cekRow = mysql_num_rows($query);
        if($cekRow >0){
        while($row=mysql_fetch_array($query)) $data[]=$row;
        return $data;     
        }
    }
        function tampilSemuaAngsuran($id_kelompok)
    {
        if($id_kelompok =='0'){
            $query = mysql_query("SELECT
                            a.no_ang,a.id_pemesanan,a.id_pelanggan,a.tgl_awal,a.tgl_akhir,a.jml_hari,a.item_id,a.tgl_angsuran,a.id_user,b.harga,b.adm,b.status,c.nama_user,d.nama
                            FROM tb_angsuran AS a
                            Left Join tb_pemesanan AS b ON a.id_pemesanan = b.id_pemesanan
                            Left Join tb_user AS c ON a.id_user = c.id_user
                            Left Join tb_pelanggan AS d ON a.id_pelanggan = d.id_pelanggan
                            ORDER BY a.tgl_angsuran DESC");
            $cekRow = mysql_num_rows($query);
            if($cekRow >0){
            while($row=mysql_fetch_array($query)) $data[]=$row;
            return $data;     
            }
        }else{
            $query = mysql_query("SELECT
                            a.no_ang,a.id_pemesanan,a.id_pelanggan,a.tgl_awal,a.tgl_akhir,a.jml_hari,a.item_id,a.tgl_angsuran,a.id_user,b.harga,b.adm,b.status,c.nama_user,d.nama
                            FROM tb_angsuran AS a
                            Left Join tb_pemesanan AS b ON a.id_pemesanan = b.id_pemesanan
                            Left Join tb_user AS c ON a.id_user = c.id_user
                            Left Join tb_pelanggan AS d ON a.id_pelanggan = d.id_pelanggan
                            WHERE b.id_kelompok='$id_kelompok'
                            ORDER BY a.tgl_angsuran DESC");
            $cekRow = mysql_num_rows($query);
            if($cekRow >0){
            while($row=mysql_fetch_array($query)) $data[]=$row;
            return $data;     
            }
        }
    }
    //METHOD TAMPIL DATA ANGSURAN
    function tampilAngsuran($field,$no_ang)
    {
        $query = mysql_query("SELECT
                            a.no_ang,
                            a.id_pelanggan,
                            a.id_pemesanan,
                            a.tgl_angsuran,
                            a.tgl_awal,
                            a.tgl_akhir,
                            b.nama,
                            b.alamat,
                            c.harga
                            FROM tb_angsuran AS a
                            LEFT  JOIN tb_pelanggan AS b ON a.id_pelanggan = b.id_pelanggan
                            LEFT JOIN tb_pemesanan AS c ON a.id_pemesanan = c.id_pemesanan 
                            WHERE no_ang='$no_ang'");
        $data=mysql_fetch_array($query);
        if($field == 'no_ang') return $data['no_ang'];
        else if($field == 'id_pemesanan') return $data['id_pemesanan'];
        else if($field == 'nama') return $data['nama'];
        else if($field == 'alamat') return $data['alamat'];
        else if($field == 'tgl_angsuran') return $data['tgl_angsuran'];
        else if($field == 'tgl_awal') return $data['tgl_awal'];
        else if($field == 'tgl_akhir') return $data['tgl_akhir'];
        else if($field == 'harga') return $data['harga'];
        
        
    }
	
	//METHOD TANGGAL ANGSURAN SELANJUTNYA
	function tglAngsurSelanjutnya($field,$id_pelanggan){
	$query = mysql_query("SELECT DATE_ADD(tgl_akhir, INTERVAL 1 DAY) as 'tgl_awal' FROM `tb_angsuran`where id_pelanggan = '$id_pelanggan' order by tgl_akhir desc limit 1;");
	
	$data=mysql_fetch_array($query);
        if($field == 'id_pelanggan') return $data['id_pelanggan'];
        else if($field == 'tgl_awal') return $data['tgl_awal'];
        
	}
    function updateAngsuran($no_ang,$tgl_angsuran,$tgl_awal,$tgl_akhir,$id_user)
    {
        $datediff = mysql_query("SELECT DATEDIFF('$tgl_akhir','$tgl_awal') AS jml_hari");
        $data = mysql_fetch_assoc($datediff);
        $jml_hari = $data['jml_hari']+1;
        
        $query = mysql_query("UPDATE tb_angsuran SET tgl_angsuran='$tgl_angsuran', tgl_awal='$tgl_awal', tgl_akhir='$tgl_akhir', id_user='$id_user', jml_hari='$jml_hari',update_at=now() WHERE no_ang='$no_ang'");
        
    }
}

class Laporan
{
    	// method filter data laporan harian
	function tampilLapHariFilter($tgl_angsuran,$id_kelompok) {
		$query = mysql_query("SELECT
                            a.no_ang,
                            a.id_pemesanan,
                            a.id_pelanggan,
                            a.tgl_awal,
                            a.tgl_akhir,
                            a.jml_hari,
                            a.item_id,
                            a.tgl_angsuran,
                            a.id_user,
                            b.harga,
                            b.adm,
                            c.nama_user,
                            d.nama
                            FROM
                            tb_angsuran AS a
                            Left Join tb_pemesanan AS b ON a.id_pemesanan = b.id_pemesanan
                            Left Join tb_user AS c ON a.id_user = c.id_user
                            Left Join tb_pelanggan AS d ON a.id_pelanggan = d.id_pelanggan
                            WHERE a.tgl_angsuran='$tgl_angsuran'
                            ORDER BY a.tgl_angsuran ASC");
		$no_rows = mysql_num_rows($query);
		if ($no_rows !=0) {
		  while($row=mysql_fetch_array($query))
		    $data[]=$row;
		    return $data;
	  	
		}
	}
    
        	// method filter data laporan bulanan
	function tampilLapBulanFilter($tgl_angsuran1,$tgl_angsuran2,$id_kelompok) {
        if($id_kelompok == '0'){
            $query = mysql_query("SELECT
                                a.no_ang,
                                a.id_pemesanan,
                                a.id_pelanggan,
                                a.tgl_awal,
                                a.tgl_akhir,
                                a.jml_hari,
                                a.item_id,
                                a.tgl_angsuran,
                                a.id_user,
                                b.harga,
                                b.adm,
                                c.nama_user,
                                d.nama
                                FROM
                                tb_angsuran AS a
                                Left Join tb_pemesanan AS b ON a.id_pemesanan = b.id_pemesanan
                                Left Join tb_user AS c ON a.id_user = c.id_user
                                Left Join tb_pelanggan AS d ON a.id_pelanggan = d.id_pelanggan
                                WHERE a.tgl_angsuran >='$tgl_angsuran1' 
                                AND a.tgl_angsuran <= '$tgl_angsuran2'
                                ORDER BY a.tgl_angsuran ASC");
            $no_rows = mysql_num_rows($query);
            if ($no_rows !=0) {
              while($row=mysql_fetch_array($query))
                $data[]=$row;
                return $data;
            
            }
        }else{
            $query = mysql_query("SELECT
                                a.no_ang,
                                a.id_pemesanan,
                                a.id_pelanggan,
                                a.tgl_awal,
                                a.tgl_akhir,
                                a.jml_hari,
                                a.item_id,
                                a.tgl_angsuran,
                                a.id_user,
                                b.harga,
                                b.adm,
                                c.nama_user,
                                d.nama
                                FROM
                                tb_angsuran AS a
                                Left Join tb_pemesanan AS b ON a.id_pemesanan = b.id_pemesanan
                                Left Join tb_user AS c ON a.id_user = c.id_user
                                Left Join tb_pelanggan AS d ON a.id_pelanggan = d.id_pelanggan
                                WHERE a.tgl_angsuran >='$tgl_angsuran1' 
                                AND a.tgl_angsuran <= '$tgl_angsuran2'
                                AND b.id_kelompok= '$id_kelompok'
                                ORDER BY a.tgl_angsuran ASC");
            $no_rows = mysql_num_rows($query);
            if ($no_rows !=0) {
              while($row=mysql_fetch_array($query))
                $data[]=$row;
                return $data;
            
            }
        }
	}

                // method filter data laporan pengambilan
    function tampilLapPengambilanFilter($tgl_angsuran1,$tgl_angsuran2) {
        $query = mysql_query("SELECT
                            a.no_ang,
                            a.id_pemesanan,
                            a.id_pelanggan,
                            a.tgl_awal,
                            a.tgl_akhir,
                            a.jml_hari,
                            a.item_id,
                            a.tgl_angsuran,
                            a.id_user,
                            b.harga,
                            b.adm,
                            b.status,
                            c.nama_user,
                            d.nama
                            FROM
                            tb_angsuran AS a
                            Left Join tb_pemesanan AS b ON a.id_pemesanan = b.id_pemesanan
                            Left Join tb_user AS c ON a.id_user = c.id_user
                            Left Join tb_pelanggan AS d ON a.id_pelanggan = d.id_pelanggan
                            WHERE a.tgl_angsuran >='$tgl_angsuran1' AND a.tgl_angsuran <= '$tgl_angsuran2'
                            ORDER BY a.tgl_angsuran ASC");
        $no_rows = mysql_num_rows($query);
        if ($no_rows !=0) {
          while($row=mysql_fetch_array($query))
            $data[]=$row;
            return $data;
        
        }
    }

    //method filter data laporan pelunasan
    function tampilLapPelunasanFilter($tgl_angsuran1,$tgl_angsuran2)
    {
        $query = mysql_query("SELECT
                            a.no_ang,
                            a.id_pemesanan,
                            a.id_pelanggan,
                            a.tgl_awal,
                            a.tgl_akhir,
                            a.jml_hari,
                            a.item_id,
                            a.tgl_angsuran,
                            a.id_user,
                            b.harga,
                            b.adm,
                            b.status,
                            c.nama_user,
                            d.nama
                            FROM
                            tb_angsuran AS a
                            Left Join tb_pemesanan AS b ON a.id_pemesanan = b.id_pemesanan
                            Left Join tb_user AS c ON a.id_user = c.id_user
                            Left Join tb_pelanggan AS d ON a.id_pelanggan = d.id_pelanggan
                            WHERE a.tgl_angsuran >='$tgl_angsuran1' AND a.tgl_angsuran <= '$tgl_angsuran2'
                            ORDER BY a.tgl_angsuran ASC");
        $no_rows = mysql_num_rows($query);
        if ($no_rows !=0) {
          while($row=mysql_fetch_array($query))
            $data[]=$row;
            return $data;
        
        }        
    }

    //method filter data laporan belum lunas
    function tampilLapBlmLunasFilter($tgl_angsuran1,$tgl_angsuran2)
    {
        $query = mysql_query("SELECT
                            a.no_ang,
                            a.id_pemesanan,
                            a.id_pelanggan,
                            a.tgl_awal,
                            a.tgl_akhir,
                            a.jml_hari,
                            a.item_id,
                            a.tgl_angsuran,
                            a.id_user,
                            b.harga,
                            b.adm,
                            b.status,
                            c.nama_user,
                            d.nama
                            FROM
                            tb_angsuran AS a
                            Left Join tb_pemesanan AS b ON a.id_pemesanan = b.id_pemesanan
                            Left Join tb_user AS c ON a.id_user = c.id_user
                            Left Join tb_pelanggan AS d ON a.id_pelanggan = d.id_pelanggan
                            WHERE a.tgl_angsuran >='$tgl_angsuran1' AND a.tgl_angsuran <= '$tgl_angsuran2'
                            ORDER BY a.tgl_angsuran ASC");
        $no_rows = mysql_num_rows($query);
        if ($no_rows !=0) {
          while($row=mysql_fetch_array($query))
            $data[]=$row;
            return $data;
        
        }        
    }

    //method filter data laporan per pelanggan
    function tampilLapPerpelangganFilter($tgl_angsuran1,$tgl_angsuran2)
    {
        $query = mysql_query("SELECT
                            a.no_ang,
                            a.id_pemesanan,
                            a.id_pelanggan,
                            a.tgl_awal,
                            a.tgl_akhir,
                            a.jml_hari,
                            a.item_id,
                            a.tgl_angsuran,
                            a.id_user,
                            b.harga,
                            b.adm,
                            b.status,
                            c.nama_user,
                            d.nama
                            FROM
                            tb_angsuran AS a
                            Left Join tb_pemesanan AS b ON a.id_pemesanan = b.id_pemesanan
                            Left Join tb_user AS c ON a.id_user = c.id_user
                            Left Join tb_pelanggan AS d ON a.id_pelanggan = d.id_pelanggan
                            WHERE a.tgl_angsuran >='$tgl_angsuran1' AND a.tgl_angsuran <= '$tgl_angsuran2'
                            ORDER BY a.tgl_angsuran ASC");
        $no_rows = mysql_num_rows($query);
        if ($no_rows !=0) {
          while($row=mysql_fetch_array($query))
            $data[]=$row;
            return $data;
        
        }
    }

    //method filter data laporan semua nasabah
    function tampilLapSemuaNasabahFilter($id_pelanggan)
    {
        $sql = "SELECT a.no_ang, a.id_pelanggan, a.id_pemesanan, SUM(a.jml_hari)AS jml
                FROM tb_angsuran AS a
                WHERE a.id_pelanggan='$id_pelanggan'";
        $qry = mysql_query($sql);
        $numrows = mysql_num_rows($qry);
        if($numrows !=0)
        {
            while($row=mysql_fetch_array($qry))
                $data[]=$row;
            return $data;
        }
    }

}
?>