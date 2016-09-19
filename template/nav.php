<div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="./">Paket Setiawati</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li <?php if(@$_GET['page']=='home'){echo 'class="active"';} ?> ><a href="home">Home</a></li>
            <li <?php if(@$_GET['page']=='tentang-kami'){echo 'class="active"';} ?> ><a href="tentang-kami">Tentang Kami</a></li>
            <li <?php if(@$_GET['page']=='kontak'){echo 'class="active"';} ?> ><a href="kontak">Kontak</a></li>
            <li <?php if(@$_GET['page']=='persyaratan'){echo 'class="active"';} ?> ><a href="persyaratan">Persyaratan</a></li>
            <li <?php if(@$_GET['page']=='daftar'){echo 'class="active"';} ?> ><a href="daftar">Daftar Online</a></li>
            <!--li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li class="divider"></li>
                <li class="dropdown-header">Nav header</li>
                <li><a href="#">Separated link</a></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li-->
          </ul>
        </div><!--/.nav-collapse -->
      </div>