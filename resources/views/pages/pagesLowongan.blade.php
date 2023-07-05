@extends('layout.master')

@section('activekuLowongan')
    activeku
@endsection

@section('judul')
    <i class="fa fa-book"></i> Data Lowongan
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary my-2" data-toggle="modal" data-target="#tambahlowongan">
                Tambah lowongan
            </button>

            <!-- Modal -->
            <div class="modal fade" id="tambahlowongan" tabindex="-1" aria-labelledby="tambahlowonganLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="tambahlowonganLabel">Form lowongan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <form action="{{ route('tambah.lowongan', []) }}" method="post">
                        @csrf
                        <div class="modal-body">

                            <div class='form-group'>
                                <label for='forjudullowongan' class='text-capitalize'>Posisi Lowongan</label>
                                <input type='text' name='judullowongan' id='forjudullowongan' class='form-control' placeholder='masukan posisi lowongan'>
                            </div>

                            <div class='form-group'>
                                <label for='fortanggalbuka' class='text-capitalize'>Tanggal Buka</label>
                                <input type='date' name='tanggalbuka' id='fortanggalbuka' class='form-control' placeholder=''>
                            </div>

                            <div class='form-group'>
                                <label for='fortanggaltutup' class='text-capitalize'>Tanggal Tutup</label>
                                <input type='date' name='tanggaltutup' id='fortanggaltutup' class='form-control' placeholder=''>
                            </div>

                            <div class='form-group'>
                                <label for='forupload' class='text-capitalize'>Req* Upload</label>
                                <select name='upload' id='forupload' class='form-control'>
                                    <option value=''>Pilih Detail Upload</option>
                                    <option value='cv' class="text-uppercase">cv</option>
                                    <option value='cv,surat lamaran' class="text-uppercase">cv dan surat lamaran</option>
                                    <option value='pasfoto,cv,surat lamaran' class="text-uppercase">pasfoto, cv dan surat lamaran</option>
                                <select>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </div>
                    </form>
                </div>
                </div>
            </div>
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
        <div class="card-body">
            <table class="table table-striped table-bordered table-sm">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Lowongan</th>
                        <th>Tgl Buka</th>
                        <th>Tgl Tutup</th>
                        <th>Syarat Upload</th>
                        <th>Aksi</th>
                        <th>Ket</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($lowongan as $item)
                    <tr>
                        <td nowrap width="1px">{{$loop->iteration}}</td>
                        <td>{{$item->judullowongan}}</td>
                        <td>{{\Carbon\Carbon::parse($item->tanggalbuka)->isoFormat('dddd, DD MMMM Y')}}</td>
                        <td>{{\Carbon\Carbon::parse($item->tanggaltutup)->isoFormat('dddd, DD MMMM Y')}}</td>
                        <td>
                            <a href="{{ route('berkas.upload', [$item->idlowongan]) }}" class="badge badge-info border-0 py-1">
                                <i class="fa fa-eye"></i> Berkas Upload
                            </a>


                        </td>
                        <td>
                            <form action="{{ route('hapus.lowongan', [$item->idlowongan]) }}" method="post" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="badge badge-danger border-0 py-1">
                                    <i class="fa fa-trash"></i> Hapus
                                </button>
                            </form>

                            <!-- Button trigger modal -->
                            <button type="button" class="badge badge-primary badge-lg border-0 py-1" data-toggle="modal" data-target="#edit{{$item->idlowongan}}">
                              <i class="fa fa-edit"></i> Edit
                            </button>

                            <!-- Modal -->

                        </td>
                        <td>
                            <form action="{{ route('ket.lowongan', [$item->idlowongan]) }}" method="post">
                                @csrf
                                <select name='ket' id='forket' onchange="submit()" required style="outline:none;border:none;border-bottom:1px solid gray" class="w-100 text-bold @if ($item->ket == true)
                                    text-success
                                @else
                                    text-danger
                                @endif">
                                    <option value='1' @if ($item->ket == true)
                                        selected
                                    @endif class="text-success">DI BUKA</option>
                                    <option value='0' @if ($item->ket == false)
                                        selected
                                    @endif class="text-danger">DI TUTUP</option>
                                <select>
                            </form>
                        </td>

                    </tr>

                    <div class="modal fade" id="edit{{$item->idlowongan}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Form Edit</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                                <form action="{{ route('edit.lowongan', [$item->idlowongan]) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class='form-group'>
                                            <label for='forjudullowongan' class='text-capitalize'>Nama Persyaratan</label>
                                            <input type='text' name='judullowongan' id='forjudullowongan' class='form-control' placeholder='masukan nama persyaratan' value="{{$item->judullowongan}}">
                                        </div>

                                        <div class='form-group'>
                                            <label for='fortanggalbuka' class='text-capitalize'>Tanggal Buka<i class="fa fa-bitbucket-square" aria-hidden="true"></i></label>
                                            <input type='date' name='tanggalbuka' id='fortanggalbuka' class='form-control' placeholder='masukan tanggal buka' value="{{$item->tanggalbuka}}">
                                        </div>

                                        <div class='form-group'>
                                            <label for='fortanggaltutup' class='text-capitalize'>Tanggal Tutup<i class="fa fa-bitbucket-square" aria-hidden="true"></i></label>
                                            <input type='date' name='tanggaltutup' id='fortanggaltutup' class='form-control' placeholder='masukan tanggal buka' value="{{$item->tanggaltutup}}">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Edit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>


@endsection
