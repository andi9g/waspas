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
        margin-top: 60%;
    }

    .register-form{
        margin-top: 10%;
    }
}


.login-main-text{
    margin-top: 20%;
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
       {{-- <a href="{{ url('/', []) }}" class="btn btn-danger btn-sm">Kembali Halaman Utama</a> --}}
    </div>
 </div>
 <div class="main">
    <div class="col-md-6 col-sm-12">
       <div class="login-form">
            <form action="{{ route('login.proses', []) }}" method="post">
                @csrf
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Email">
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Password">
                </div>
                <button type="submit" class="btn btn-black mb-5">LOGIN</button>
                <a href="{{ url('register', []) }}" class="btn btn-success mb-5">DAFTAR</a>
            </form>
       </div>
    </div>
 </div>
@endsection
