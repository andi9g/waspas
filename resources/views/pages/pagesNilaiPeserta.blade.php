@extends('layout.master')

@section('activekuNilai')
    activeku
@endsection

@section('judul')
    <i class="fa fa-users"></i> Pelamar
@endsection

@section('content')

<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <a href="{{ url('nilai') }}" class="btn btn-block btn-danger mb-3">Halaman Sebelumnya..</a>
        @foreach ($pelamar as $item)
        <div class="row mb-4">
            <div class="col-9">
                <div class="card m-0">
                    <div class="card-body text-sm m-0">
                        <table border="0" class="table table-sm table-striped">
                            <tr>
                                <td nowrap width="10px">Nama</td>
                                <td width="2px">:</td>
                                <td>{{ucwords($item->namaakun)}}</td>
                            </tr>
                            <tr>
                                <td>Kelamin</td>
                                <td>:</td>
                                <td>{{($item->jk=="l")?"Laki-laki":"Perempuan"}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <form action="{{ route('penilaian.peserta', [$idlowongan,$item->idpelamar]) }}" class="h-100">
                    <button class="btn-block btn-success h-100 rounded-lg text-lg">
                        <i class="fa fa-edit"></i> NILAI
                    </button>
                </form>
            </div>
        </div>

        @endforeach
    </div>
</div>


@endsection
