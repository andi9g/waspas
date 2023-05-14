@extends('layout.master')

@section('activekuDetailKriteria')
    activeku
@endsection

@section('judul')
    <i class="fa fa-book"></i> Nilai Bobot ({{$kriteria->judulkriteria}})
@endsection

@section('content')

<div class="container">
    <a href="{{ url('kriteria', []) }}" class="badge badge-danger border-0 p-2"><< Back to Kriteria</a>
    <div class="row">
        <div class="col-md-6">

            <button type="button" class="btn btn-primary my-2" data-toggle="modal" data-target="#tambahnilaibobot">
                Tambah Nilai Bobot
            </button>

            <!-- Modal -->
            <div class="modal fade" id="tambahnilaibobot" tabindex="-1" aria-labelledby="tambahnilaibobotLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="tambahnilaibobotLabel">Form Kriteria</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <form action="{{ route('tambah.detailkriteria', [$kriteria->idkriteria]) }}" method="post">
                        @csrf
                        <div class="modal-body">
                            @if ($kriteria->typedata == 'angka')
                                <div class='form-group'>
                                    <label for='formin' class='text-capitalize'>Nilai Min</label>
                                    <input type='number' name='min' id='formin' class='form-control' placeholder='0-100'>
                                </div>

                                <div class='form-group'>
                                    <label for='formax' class='text-capitalize'>Nilai Max</label>
                                    <input type='number' name='max' id='formax' class='form-control' placeholder='0-100'>
                                </div>

                            @else
                                <div class='form-group'>
                                    <label for='forjuduldetailkriteria' class='text-capitalize'>Nama Nilai Bobot</label>
                                    <input type='text' name='juduldetailkriteria' id='forjuduldetailkriteria' class='form-control' placeholder='masukan nama kriteria'>
                                </div>
                            @endif


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
                        <th>Judul Nilai Bobot</th>
                        <th>Bobot</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($detailkriteria as $item)
                    <tr>
                        <td nowrap width="1px">{{$loop->iteration}}</td>
                        @if ($kriteria->typedata == 'angka')
                            <td>
                                <form action="{{ route('update.detailkriteria', [$item->idkriteria, $item->iddetailkriteria]) }}" method="post" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="number" onchange="submit()" class="text-left text-bold" style="width:100%;border:1px solid gray;border-top: none;border-right: none;border-left: none;outline: none;background:rgba(196, 233, 186, 0.493)"  name="min"  value="{{$item->min}}">
                                </form>
                                ~
                                <form action="{{ route('update.detailkriteria', [$item->idkriteria, $item->iddetailkriteria]) }}" method="post" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="number" onchange="submit()" class="text-left text-bold" style="width:100%;border:1px solid gray;border-top: none;border-right: none;border-left: none;outline: none;background:rgba(196, 233, 186, 0.493)"  name="max" value="{{$item->max}}">
                                </form>
                            </td>
                        @else
                            <td>
                                <form action="{{ route('update.detailkriteria', [$item->idkriteria, $item->iddetailkriteria]) }}" method="post" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="text" onchange="submit()" class="text-left text-bold" style="width:100%;border:1px solid gray;border-top: none;border-right: none;border-left: none;outline: none;background:rgba(196, 233, 186, 0.493)" name="juduldetailkriteria" value="{{$item->juduldetailkriteria}}">
                                </form>
                        @endif
                        <td nowrap width="80px">
                            <form action="{{ route('update.detailkriteria', [$item->idkriteria, $item->iddetailkriteria]) }}" method="post" class="d-inline">
                                @csrf
                                @method('PUT')
                                <input type="number" onchange="submit()" class="text-center" style="width:100%;border:1px solid gray;border-top: none;border-right: none;border-left: none;outline: none" name="bobot" value="{{$item->bobot}}">
                            </form>
                        <td>
                            <form action="{{ route('hapus.detailkriteria', [$item->iddetailkriteria]) }}" method="post" class="d-inline">
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
