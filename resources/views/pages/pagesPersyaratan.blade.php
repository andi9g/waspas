@extends('layout.master')

@section('activekuLowongan')
    activeku
@endsection

@section('judul')
    <i class="fa fa-book"></i> Persyaratan Upload
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary my-2" data-toggle="modal" data-target="#tambahlowongan">
                Tambah Persyaratan
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
                    <form action="{{ route('tambah.persyaratan', [$idlowongan]) }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class='form-group'>
                                <label for='forjudulupload' class='text-capitalize'>Judul Persyaratan</label>
                                <input type='text' name='judulupload' id='forjudulupload' class='form-control' placeholder='masukan nama persyaratan'>
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
    <div class="row">
        <div class="col-md-12">
            <a href="{{ url('lowongan', []) }}" class="btn btn-danger btn-xs">Kembali</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table table-striped table-bordered table-sm">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Persyaratan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($persyaratan as $item)
                    <tr>
                        <td nowrap width="1px">{{$loop->iteration}}</td>
                        <td nowrap class="text-bold text-uppercase">{{$item->judulupload}}</td>
                        <td>
                            <!-- Button trigger modal -->
                            <button type="button" class="badge badge-primary badge-lg border-0 py-1" data-toggle="modal" data-target="#ubahpersyaratan{{$item->idupload}}">
                              <div class="fa fa-edit"></div> Edit
                            </button>

                            <form action="{{ route('hapus.persyaratan', [$item->idupload]) }}" method="post" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('yakin ingin menghapus data?')" class="badge badge-danger badge-lg border-0 py-1">
                                    <i class="fa fa-trash"></i> Hapus
                                </button>
                            </form>

                        </td>

                    </tr>

                    <!-- Modal -->
                    <div class="modal fade" id="ubahpersyaratan{{$item->idupload}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                    <div class="modal-header">
                                            <h5 class="modal-title">Form Update</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                        </div>
                                <form action="{{ route('update.persyaratan', [$item->idupload]) }}" method="post" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class='form-group'>
                                            <label for='forjudulupload' class='text-capitalize'>Nama Persyaratan</label>
                                            <input type='text' name='judulupload' id='forjudulupload' class='form-control' value="{{$item->judulupload}}">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Update</button>
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
