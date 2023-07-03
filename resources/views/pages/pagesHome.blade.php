@extends('layout.master')

@section('activekuHome')
    activeku
@endsection

@section('judul')
    <i class="fa fa-home"></i> Dashboard
@endsection

@section('content')

@if (Session::get('posisi')=='user')
<div class="row">
    <div class="col-md-6">
        @php
            $daftarlamaran = DB::table('pelamar')->join('lowongan', 'lowongan.idlowongan','pelamar.idlowongan')->where('pelamar.idakun', Session::get('idakun'))->count();
        @endphp
        <a href="{{ url('lamaran', []) }}" class="btn btn-success px-4 text-bold">LIHAT DAFTAR LAMARAN
            <small class="badge badge-primary">{{$daftarlamaran}}</small>
        </a>
    </div>
    <div class="col-md-6">
        <form action="{{ url()->current() }}" class="form-inline justify-content-end">
            <div class="input-group mb-3">
                <input type="text" class="form-control" value="{{empty($_GET['keyword'])?'':$_GET['keyword']}}" name="keyword" aria-describedby="button-addon2">
                <div class="input-group-append">
                  <button class="btn btn-outline-success" type="submit" id="button-addon2">Cari</button>
                </div>
            </div>

        </form>
    </div>
</div>


<div class="card">
    <div class="card-header">
        <h4 class="my-0 py-0">INFORMASI LOWONGAN</h4>
    </div>
    <div class="card-body p-0">
        @foreach ($lowongan as $item)
            @php
                $pelamar = DB::table('pelamar')
                ->where('idlowongan', $item->idlowongan)
                ->where('idakun', Session::get('idakun'));
                $persyaratan = DB::table('upload')->where('idlowongan', $item->idlowongan)->get();
            @endphp
            <blockquote class="bg-light" style="" disabled>
                <div >
                    <h2 class="mb-0 pb-0">{{$item->judullowongan}} @if ($pelamar->count() === 1)
                        <font class="text-success">(TELAH TERDAFTAR)</font>
                    @endif</h2>
                    <p class="my-0 py-0 text-bold">Tanggal Pendaftaran : </p>

                    <p class="my-0 py-0">
                        <i>
                            {{\Carbon\Carbon::parse($item->tanggalbuka)->isoFormat('dddd, DD MMMM Y')}} s/d {{\Carbon\Carbon::parse($item->tanggaltutup)->isoFormat('dddd, DD MMMM Y')}}
                        </i>
                    </p>
                    <!-- Button trigger modal -->
                    @if ($pelamar->count() !== 1)
                        <button type="button" class="badge badge-primary badge-lg border-0 py-1 px-4" data-toggle="modal" data-target="#daftar{{$item->idlowongan}}">
                            DAFTAR
                        </button>


                        <!-- Modal -->
                        <div class="modal fade" id="daftar{{$item->idlowongan}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">PERHATIAN</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                    </div>
                                    <form action="{{ route('tambah.pelamar', [$item->idlowongan]) }}" method="post">
                                        @csrf

                                        <div class="modal-body">
                                            <p>Adapun persyaratan yang harus di lengkapi meliputi:</p>
                                            <ul>
                                                @foreach ($persyaratan as $upload)
                                                    <li class="text-bold text-uppercase">{{$upload->judulupload}}</li>

                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Setuju</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    @else
                        <a href="{{ url('lamaran', []) }}" class="badge badge-secondary badge-lg border-0 py-1">
                            <i class="fa fa-eye"></i> Lengkapi Persyaratan
                        </a>
                    @endif


                </div>
            </blockquote>



        @endforeach
    </div>
</div>

@elseif(Session::get('posisi')=='superadmin')
<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{$pelamar}}</h3>
                <p>PENDAFTAR</p>
            </div>
            <div class="icon">
                <i class="ion ion-users"></i>
            </div>
            <a href="pelamar" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-primary">
            <div class="inner">
                <h3>{{ $low }}</h3>
                <p>LOWONGAN</p>
            </div>
            <div class="icon">
                <i class="ion ion-users"></i>
            </div>
            <a href="lowongan" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ $kriteria }}</h3>
                <p>JUMLAH KRITERIA</p>
            </div>
            <div class="icon">
                <i class="ion ion-users"></i>
            </div>
            <a href="kriteria" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

</div>
@endif


@endsection
