<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Welcome to DAFTAR KERJA ONLINE</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Daftar Kerja Online</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav">
            <li class="nav-item active">
              <a class="nav-link" href="#">Hasil Penilaian Pelamar<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ url('login', []) }}">Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ url('register', []) }}">Daftar</a>
            </li>
          </ul>
        </div>
      </nav>

      <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6 mt-3">
                        <form action="{{ url()->current() }}" method="get">
                            <div class='form-group'>
                                <select name='lowongan' id='forlowongan' onchange="submit()" class='form-control'>
                                    <option value=''>Semua Lowongan</option>
                                    @foreach ($lowongan as $item)
                                        <option value="{{$item->idlowongan}}" @if ($idlowongan == $item->idlowongan)
                                            selected
                                        @endif>{{$item->judullowongan}}</option>
                                    @endforeach
                                <select>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

            <div class="col-12">
                <table class="table table-hover table-sm table-striped table-bordered">
                    <thead>
                        <th>No</th>
                        <th>Nama</th>
                    </thead>

                    <tbody>
                        @foreach ($data as $item)
                        <tr>

                            <td colspan="2" style="background: rgb(162, 240, 162)">{{$item['judullowongan']}}</td>
                        </tr>
                        @foreach ($item['pelamar'] as $item2)
                            <tr>
                                <td width="5px">{{$item2['no']}}</td>
                                <td>{{$item2['namapelamar']}}</td>
                            </tr>
                        @endforeach

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
      </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
