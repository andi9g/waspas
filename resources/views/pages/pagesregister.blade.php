@extends('layout.login2')

@section('title')
    Login
@endsection
@section('headers')
<style>
    body {
    font-family: "Lato", sans-serif;
}

.main-head{
    height: 150px;
    background: #FFF;

}

.sidenav {
    height: 100%;
    background-color: #000;
    overflow-x: hidden;
    padding-top: 20px;
}


.main {
    padding: 0px 10px;
}

@media screen and (max-height: 450px) {
    .sidenav {padding-top: 15px;}
}

@media screen and (max-width: 450px) {
    .login-form{
        margin-top: 10%;
    }

    .register-form{
        margin-top: 10%;
    }
}

@media screen and (min-width: 768px){
    .main{
        margin-left: 40%;
    }

    .sidenav{
        width: 40%;
        position: fixed;
        z-index: 1;
        top: 0;
        left: 0;
    }

    .login-form{
        margin-top: 20%;
    }

    .register-form{
        margin-top: 20%;
    }
}


.login-main-text{
    margin-top: 10%;
    padding: 60px;
    color: #fff;
}

.login-main-text h2{
    font-weight: 300;
}

.btn-black{
    background-color: #000 !important;
    color: #fff;
}
</style>
@endsection

@section('content')
<div class="sidenav">
    <div class="login-main-text">
       <h2>DAFTAR KERJA ONLINE <br> Login Page</h2>
       <p>Login here to access.</p>
       <a href="{{ url('/login', []) }}" class="btn btn-danger btn-sm my-1">Halaman Login</a>
       <a href="{{ url('/datapelamar', []) }}" class="btn btn-success btn-sm">HASIL PENILAIAN PELAMAR</a>
    </div>
 </div>
 <div class="main">
    <div class="col-md-6 col-sm-12">
       <div class="login-form">
            <form action="{{ route('daftar.akun', []) }}" method="post">
                @csrf
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" class="form-control @error('namaakun')
                        is-invalid
                    @enderror" name="namaakun" placeholder="Nama lengkap">
                </div>

                <div class="form-group">
                    <label>Tanggal Lahir</label>
                    <input type="date" class="form-control @error('tanggallahir')
                    is-invalid
                @enderror" name="tanggallahir" placeholder="">
                </div>

                <fieldset class="form-group row">
                    <label class="col-form-label col-12 float-sm-left pt-0">Kelamin</label>
                    <div class="col-12">
                      <div class="form-check d-inline">
                        <input class="form-check-input" type="radio" name="jk" id="jk1" value="l" checked>
                        <label class="form-check-label mr-2" for="jk1">
                          Laki-laki
                        </label>
                      </div>
                      <div class="form-check d-inline">
                        <input class="form-check-input" type="radio" name="jk" id="jk2" value="p">
                        <label class="form-check-label" for="jk2">
                          Perempuan
                        </label>
                      </div>

                    </div>
                  </fieldset>

                <div class="form-group">
                    <label>HP/WA</label>
                    <input type="number" class="form-control @error('hp')
                    is-invalid
                @enderror" name="hp" placeholder="no hp">
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control @error('email')
                        is-invalid
                    @enderror" name="email" placeholder="User Name">
                </div>

                <div class="form-group ">
                    <label for="inputPassword1">Password</label>
                    <div class="">
                      <input type="password" class="form-control @error('password1')
                        is-invalid
                    @enderror" onkeyup="cek()" name="password1" id="inputPassword1" placeholder="password">
                    </div>
                  </div>
                <div class="form-group ">
                <label for="inputPassword2">Ulangi Password</label>
                <div class="">
                    <input type="password" class="form-control @error('password2')
                        is-invalid
                    @enderror" onkeyup="cek();" name="password2" id="inputPassword2" placeholder="ulangi password">
                </div>
                </div>

                <div class="d-inline">
                    <button type="submit" class="btn btn-black mb-5 d-inline">DAFTAR AKUN</button>

                </div>
            </form>
       </div>
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
@endsection
