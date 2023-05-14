@extends('layout.master')

@section('activekuKriteria')
    activeku
@endsection

@section('judul')
    <i class="fa fa-book"></i> Data Kriteria
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary my-2" data-toggle="modal" data-target="#tambahkriteria">
                Tambah Kriteria
            </button>

            <!-- Modal -->
            <div class="modal fade" id="tambahkriteria" tabindex="-1" aria-labelledby="tambahkriteriaLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="tambahkriteriaLabel">Form Kriteria</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <form action="{{ route('tambah.kriteria', []) }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class='form-group'>
                                <label for='forjudulkriteria' class='text-capitalize'>Nama Kriteria</label>
                                <input type='text' name='judulkriteria' id='forjudulkriteria' class='form-control' placeholder='masukan kriteria'>
                            </div>

                            <div class='form-group'>
                                <label for='fortypedata' class='text-capitalize'>Type Data</label>
                                <select name='typedata' id='fortypedata' class='form-control'>
                                    <option value=''>Pilih</option>
                                    <option value='angka' class="text-uppercase">angka</option>
                                    <option value='pendidikan' class="text-uppercase">pendidikan</option>
                                    <option value='manual' class="text-uppercase">manual</option>
                                <select>
                            </div>

                            <div class='form-group'>
                                <label for='forbobot' class='text-capitalize'>Bobot</label>
                                <input type='number' name='bobot' id='forbobot' class='form-control' placeholder='1-10'>
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
                        <th>Judul Kriteria</th>
                        <th>Bobot</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($kriteria as $item)
                    <tr>
                        <td nowrap width="1px">{{$loop->iteration}}</td>
                        <td>{{$item->judulkriteria}}</td>
                        <td nowrap width="80px">
                            <form action="{{ route('update.bobot', [$item->idkriteria]) }}" method="post" class="d-inline">
                                @csrf
                                @method('POST')
                                <input type="number" onchange="submit()" class="text-center" style="width:100%;border:1px solid gray;border-top: none;border-right: none;border-left: none;outline: none" name="bobot" value="{{$item->bobot}}">
                            </form>
                        </td>
                        <td>
                            <a href="{{ route('lihat.detailkriteria', [$item->idkriteria]) }}" class="badge badge-info border-0 py-1">
                                <i class="fa fa-eye"></i> Lihat Detail
                            </a>
                            <form action="{{ route('hapus.kriteria', [$item->idkriteria]) }}" method="post" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="style badge badge-danger border-0 py-1" onclick="return confirm('yakin ingin menghapusnya?')">
                                    <i class="fa fa-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>


@endsection
