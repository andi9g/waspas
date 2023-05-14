@extends('layout.master')

@section('activekuPelamar')
    activeku
@endsection

@section('judul')
    <i class="fa fa-users"></i> {{$namalowongan}}

@endsection

@section('content')
<a href="{{ url('pelamar', []) }}" class="badge badge-sm badge-danger p-2 mb-2 text-sm">< Kembali</a>
@php
    $upload = DB::table('upload')->where('idlowongan', $idlowongan)->get();
@endphp
<div class="row">
    <div class="col-md-12 ">
        <div class="card">
            <div class="card-header text-lg ">
                Data Pelamar
            </div>
            <div class="card-body table-responsive">
                <table class="table table-striped table-bordered table-hover table-sm">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pelamar</th>
                            <th>Jenis Kelamin</th>
                            <th>
                                Detail
                            </th>
                            @foreach ($upload as $u)
                                <th>{{ucwords($u->judulupload)}}</th>
                            @endforeach
                            <th>Proses</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($pelamar as $item)
                        <tr valign="justify">
                            <td nowrap width="5px" class="text-center">{{$loop->iteration}}</td>
                            <td nowrap class="text-bold">{{strtoupper($item->namaakun)}}</td>
                            <td>{{($item->jk=='P')?"Perempuan":"Laki-laki"}}</td>
                            <td>
                                <!-- Button trigger modal -->
                                <button type="button" class="badge badge-primary badge-lg border-0 p-2" data-toggle="modal" data-target="#detail{{$item->idpelamar}}">
                                  <i class="fa fa-phone"></i>  KONTAK
                                </button>
                            </td>
                                @foreach ($upload as $u)
                                    @php
                                        $up = DB::table('pelamarupload')->where('idpelamar', $item->idpelamar)
                                        ->where('idupload', $u->idupload);
                                    @endphp
                                    <td>
                                        @if ($up->count() > 0)
                                            <font class="text-success text-bold">Lengkap</font>
                                            <a href="{{ url('/berkas/pelamar', [$up->first()->namaberkas]) }}" target="_blank" class="badge badge-info border-0">
                                                <i class="fa fa-eye"></i> lihat
                                            </a>
                                            @else
                                            <font class="text-danger text-danger"> Tidak Lengkap</font>

                                        @endif
                                    </td>
                                @endforeach

                            <td>
                                <form action="{{ route('pelamar.lowongan.ket', [$item->idpelamar]) }}" method="post">
                                    @csrf
                                    <div class='form-group mb-0 pb-0'>
                                        <select name='ket' id='forket' onchange="submit()" class='form-control mb-0 form-control-sm @if ($item->ket==true)
                                            text-bold text-success
                                        @else
                                            text-bold text-danger
                                        @endif'>

                                            <option value="0" class="text-bold text-danger" @if ($item->ket==false)
                                                selected
                                            @endif>Belum Layak</option>
                                            <option value="1" class="text-bold text-success" @if ($item->ket==true)
                                                selected
                                            @endif>Layak</option>
                                        <select>
                                    </div>
                                </form>
                            </td>

                            <!-- Modal -->
                            <div class="modal fade" id="detail{{$item->idpelamar}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Kontak</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class='form-group'>
                                                <label for='foremail' class='text-capitalize'>Email</label>
                                                <input type='text' name='email' id='foremail' class='form-control' readonly value="{{$item->email}}">
                                            </div>
                                            <div class='form-group'>
                                                <label for='forhp' class='text-capitalize'>HP/WA</label>
                                                <input type='text' name='hp' id='forhp' class='form-control' readonly value="{{$item->hp}}">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


@endsection
