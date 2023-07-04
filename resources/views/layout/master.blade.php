<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>WASPAS</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="icon" href="" type="image/x-icon">
  @include('layout.header')
  @yield('headers')
</head>
<body class="sidebar-mini sidebar-closed text-sm">

  <!-- Modal -->
<div class="modal fade" id="ubahpassword" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Ubah Password</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>
      <form class="form-horizontal" action="{{ route('ubah.password') }}" method="post">
        @csrf
        @method('PUT')
      <div class="modal-body">
          <div class="form-group row">
            <label for="inputPassword1" class="col-sm-4 col-form-label">Password Baru</label>
            <div class="col-sm-8">
              <input type="password" class="form-control" onkeyup="cek()" name="password1" id="inputPassword1" placeholder="password baru">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputPassword2" class="col-sm-4 col-form-label">Ulangi Password Baru</label>
            <div class="col-sm-8">
              <input type="password" class="form-control" onkeyup="cek();" name="password2" id="inputPassword2" placeholder="ulangi password baru">
            </div>
          </div>


      <script>
          function cek(){
              var pass1 = document.getElementById('inputPassword1').value;
              var pass2 = document.getElementById('inputPassword2').value;

              if(pass1.length >=5 ){
                      document.getElementById('inputPassword1').className="form-control";
                  if(pass1 == pass2){
                      document.getElementById('inputPassword1').className="form-control is-valid";
                      document.getElementById('inputPassword2').className="form-control is-valid";
                  }else if(pass2.length == 0){
                      document.getElementById('inputPassword2').className="form-control";

                  }else {
                       document.getElementById('inputPassword2').className="form-control is-invalid";
                  }
              }else if(pass1.length==0){
                      document.getElementById('inputPassword1').className="form-control";
              }else {
                  document.getElementById('inputPassword1').className="form-control is-invalid";

              }
          }
      </script>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-danger">Ubah Password</button>
      </div>
    </form>
    </div>
  </div>
</div>
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light pinkku ">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>

    </ul>

    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar text-bold text-center" type="search" placeholder="Search" aria-label="Search" disabled value="{{ strtoupper(Session::get('posisi')) }} {{empty(Session::get('urutan'))?'':Session::get('urutan')}}">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="refresh">
            <i class="fas fa-sync"></i>
          </button>
        </div>
      </div>

    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->

      <li class="nav-item">
        <a class="nav-link" href="{{ url('logout', []) }}" role="button">
          <i class="fa fa-power-off"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar text-dark  pinkku2 elevation-1">
    <!-- Brand Logo -->
    <a href="{{ url('/home', []) }}" class="brand-link pink-gelapku">
      <h3 class="brand-image rounded-circle bg-info px-1 text-bold bg-danger border-none ml-2" style="padding-top:2px "><font color="gold">SI</font></h3>
      <span class="brand-text text-bold text-white" style="font-size: 17px;letter-spacing: 2px">WASPAS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-1 mb-3 d-flex">
        <div class="image">
        </div>
        <div class="info mt-1">
          <a href="#" class="d-block">
             {{strtoupper(Session::get('posisi'))}}
          </a>
          <span>
            <button type="button" class="badge badge-danger badge-btn border-0" data-toggle="modal" data-target="#ubahpassword">
              Ubah Password
            </button>
          </span>
        </div>
      </div>
      <hr>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-flat nav-legacy" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item hoverku">
              <a href="{{ url('home', []) }}" class="nav-link @yield('activekuHome')">
                <i class="nav-icon fa fa-home"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>
            @if (Session::get('posisi')=='user')

            <li class="nav-item hoverku">
                <a href="{{ url('lamaran', []) }}" class="nav-link @yield('activekuLamaran')">
                  <i class="nav-icon fa fa-id-card"></i>
                  <p>
                    Data Lamaran
                  </p>
                </a>
              </li>
            @endif

            @if (Session::get('posisi')=='superadmin')
            <li class="nav-item hoverku">
                <a href="{{ url('pelamar', []) }}" class="nav-link @yield('activekuPelamar')">
                  <i class="nav-icon fa fa-users"></i>
                  <p>
                    Data Pelamar
                  </p>
                </a>
            </li>

            <li class="nav-item hoverku">
                <hr>
                <a href="{{ url('nilai', []) }}" class="nav-link @yield('activekuNilai')">
                  <i class="nav-icon fa fa-edit"></i>
                  <p>
                    Penilaian
                  </p>
                </a>
            </li>

            <li class="nav-item hoverku">
                <a href="{{ url('ranking', []) }}" class="nav-link @yield('activekuRanking')">
                  <i class="nav-icon fa fa-trophy"></i>
                  <p>
                    Ranking
                  </p>
                </a>
              </li>





            {{-- <li class="nav-item hoverku">
              <hr>
              <a href="{{ url('pengaturan', []) }}" class="nav-link @yield('activekupengaturan')">
                <i class="nav-icon fas fa-wrench"></i>
                <p>
                  Pengaturan
                </p>
              </a>
            </li> --}}
            <li class="nav-item hoverku">
                <a href="{{ url('kriteria', []) }}" class="nav-link @yield('activekuKriteria')">
                    <i class="nav-icon fa fa-laptop"></i>
                    <p>
                    Kriteria
                    </p>
                </a>
            </li>
            <li class="nav-item hoverku">
                <a href="{{ url('lowongan', []) }}" class="nav-link @yield('activekuLowongan')">
                    <i class="nav-icon fa fa-users"></i>
                    <p>
                    Lowongan
                    </p>
                </a>
            </li>

            @endif

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="container">
        <section class="content-header">
          <div class="">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>@yield('judul')</h1>
              </div>
            </div>
          </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container">
                @yield('content')
            </div>



        </section>
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer text-sm footerku">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 2.0
    </div>
    <strong>Copyright &copy; <strong>{{date('Y')}}</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

@include('layout.script')

@yield('footers')
@yield('script')
</body>
</html>
