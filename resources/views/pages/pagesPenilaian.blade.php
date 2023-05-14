@extends('layout.master')

@section('activekuNilai')
    activeku
@endsection

@section('judul')
    <i class="fa fa-users"></i> PENILAIAN
@endsection

@section('content')

<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <div class="row">
            <div class="col-12">
                <a href="{{ url('nilai', [$idlowongan]) }}" class="btn btn-block btn-danger mb-3">Halaman Sebelumnya..</a>
            </div>
            <div class="col-12 ">
                <div class="card ">
                    <div class="card-body text-sm ">
                        <table border="0" class="table table-sm table-striped">
                            <tr>
                                <td>Nama</td>
                                <td>:</td>
                                <td>{{ucwords($pelamar->namaakun)}}</td>
                            </tr>
                            <tr>
                                <td>Kelamin</td>
                                <td>:</td>
                                <td>{{($pelamar->jk=="l")?"Laki-laki":"Perempuan"}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

        </div>

        @foreach ($kriteria as $k)

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-secondary text-bold">
                            {{strtoupper($k->judulkriteria)}}
                        </div>
                        <form action="{{ route('penilaian.kriteria', [$idlowongan, $pelamar->idpelamar, $k->idkriteria]) }}" method="post">
                            @csrf
                            <div class="card-body">
                                @php
                                    $nilai = DB::table('nilai')
                                    ->where('idpelamar', $pelamar->idpelamar)
                                    ->where('idkriteria', $k->idkriteria)
                                    ->first();

                                @endphp
                                @if ($k->typedata==="angka")

                                    <div class='form-group'>
                                        <input type='number' name='value' id='forvalue' class='form-control' onchange="submit()" placeholder='1-100' value="{{empty($nilai->nilai)?'':$nilai->nilai}}">
                                    </div>

                                @else
                                {{-- //------  --}}
                                @php
                                    $detailkriteria = DB::table('detailkriteria')
                                    ->where('idkriteria', $k->idkriteria)->get();
                                @endphp
                                    <div class='form-group'>
                                        <select name='value' onchange="submit()" id='forvalue' class='form-control'>
                                            <option value=''>Pilih</option>
                                            @foreach ($detailkriteria as $dk)
                                            <option value='{{$dk->iddetailkriteria}}' @if ((empty($nilai->iddetailkriteria)?'':$nilai->iddetailkriteria)==$dk->iddetailkriteria)
                                                selected
                                            @endif>{{ $dk->juduldetailkriteria }}</option>

                                            @endforeach
                                        <select>
                                    </div>
                                @endif
                                <div class="text-right">
                                    <button type="submit" class="btn btn-success ">
                                        <i class="fa fa-edit"></i> Nilai
                                    </button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        @endforeach
    </div>
</div>


@endsection
