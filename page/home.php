<div class="row">
	<div class="col-md-12">
		<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
          <li data-target="#carousel-example-generic" data-slide-to="1"></li>
          <li data-target="#carousel-example-generic" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
          <div class="item active">
            <img class="img-rounded" src="assets/img/sembako.png" style="width:100%; height:300px;" alt="First slide">
          </div>
          <div class="item">
            <img class="img-rounded" src="assets/img/sembako2.jpg" style="width:100%; height:300px;" alt="Second slide">
          </div>
          <div class="item">
            <img class="img-rounded" src="assets/img/sembako3.jpg" style="width:100%; height:300px;" alt="Third slide">
          </div>
        </div>
        
      </div>
	</div>
</div>
<br />
<div class="row">

	<div class="col-md-7">
		<div class="panel panel-default">
                        <div class="panel-body">
                        <h3>Selamat Datang, Paket Lebaran Setiawati 2015-2016</h3>
                        <hr>
                            <p class="text-justify">Website ini kami buat untuk memudahkan member untuk pengecekan Cicilan pembayaran secara realtime. <br> Tujuannya agar data yang di input valid atau sesuai dengan yang dibuku tabungan yang telah di TTD oleh pegawai Setiawati</p>
                        </div>
                        <div class="panel-footer">
                            Ditulis Oleh : Administrator
                        </div>
                    </div>

	</div>
	<div class="col-md-5">
		<div class="panel panel-default">
                        <div class="panel-heading">
                            Cek Cicilan Pembayaran
                        </div>
                        <div class="panel-body">
                            <form action="cek-pembayaran" method="post">
                            	<div class="form-group">
	                            	<label>ID Paket</label>
	                            	<input class="form-control" type="text" name="id_pemesanan" autocomplete="off" autofocus required>
                            	</div>

                            	<div class="form-group">
	                            	<label>Kode Validasi</label>
	                            	<input class="form-control" type="text" name="kd_validasi" autocomplete="off" required>
                                    <small>* Tertera di buku tabungan anda</small>
                            	</div>

                            	<div class="form-group">
                            	<input class="btn btn-primary" type="submit" name="btn-search" value="Search">
                            	</div>
                            </form>
                        </div>
                        <div class="panel-footer">
                            <small class="center">
                            Dihimbau kepada seluruh pengguna paket setiawati TIDAK meminjamkan ID Paket dan atau kode validasi kepada siapapun.
                            </small>
                        </div>
                    </div>
	</div>
	
</div>
