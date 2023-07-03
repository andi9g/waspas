@extends('layout.master')

@section('activekuRanking')
    activeku
@endsection

@section('judul')
    <i class="fa fa-book"></i> Data Ranking
@endsection

@section('content')
<div class="row">
    <div class="col-md-6">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary my-2" data-toggle="modal" data-target="#exampleModal">
            PERHITUNGAN
        </button>

        <a href="{{ route('laporan.ranking', [$idlowongan]) }}" class="btn btn-secondary" target="_blank">
            <i class="fa fa-print"></i> Print
        </a>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">PERHITUNGAN</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">

                    <table class="text-md" style="line-height: 30px">
                        <tr >
                            <td>X </td>
                            <td> = </td>
                            <td style="border-left:1px solid black; border-right:1px solid black;padding:3px" >
                                <table>
                                    @foreach ($k1 as $kk1)
                                    <tr>
                                        @foreach ($kk1['k'] as $kkk1)
                                            <td class="px-2">{{$kkk1}}</td>
                                        @endforeach
                                    </tr>
                                    @endforeach


                                </table>
                            </td>
                        </tr>
                    </table>


                    <table>
                        <tr>
                            <td colspan="4">
                                <br>
                                <p>Hasil matriks keseluruhan masing-masing dibagi jumlah kriteria penilaian <b>({{$jumlahkriteria}})</b></p>
                            </td>
                        </tr>
                    </table>

                    <table class="text-md" style="line-height: 30px">
                        <tr >
                            <td>x̅ </td>
                            <td> = </td>
                            <td style="border-left:1px solid black; border-right:1px solid black;padding:3px" >
                                <table>
                                    @foreach ($k1 as $kk1)
                                    <tr>
                                        @foreach ($kk1['k2'] as $kkk1)
                                            <td class="px-2">{{$kkk1}}</td>
                                        @endforeach
                                    </tr>
                                    @endforeach


                                </table>

                            </td>
                        </tr>
                    </table>

                    <table>
                        <tr>
                            <td colspan="4">
                                <br>
                                <p>Menghitung Nilai Prefrensi yang sudah dinormalisasi</p>
                            </td>
                        </tr>
                    </table>

                    <table class="text-sm">
                        @foreach ($k1 as $kk1)
                        <tr class="py-4" valign="top">
                            <td>Q<sub>{{$loop->iteration}}</sub></td>
                            <td>=</td>
                            <td valign="top">
                                ( {{$kk1['konstanta']}}∑
                                @php
                                    $nk = 0;
                                @endphp
                                @foreach ($kk1['k2'] as $kkk1)
                                    ({{$kkk1}} x  {{$kk1['kriteria'][$nk]}})
                                    @if (($nk+1)< count($kk1['k2']))
                                        +
                                    @endif
                                    @php
                                        $nk++;
                                    @endphp
                                @endforeach
                                ) + ( {{$kk1['konstanta']}}∏
                                @php
                                    $nk = 0;
                                @endphp
                                @foreach ($kk1['k2'] as $kkk1)
                                    ({{$kkk1}}<sup>{{$kk1['kriteria'][$nk]}}</sup>)
                                    @if (($nk+1)< count($kk1['k2']))
                                        +
                                    @endif
                                    @php
                                        $nk++;
                                    @endphp
                                @endforeach
                                )
                            </td>

                        </tr>


                        <tr>
                            <td></td>
                            <td>=</td>
                            <td valign="top">
                                ( {{$kk1['konstanta']}}∑
                                @php
                                    $nk = 0;
                                @endphp
                                @foreach ($kk1['k2'] as $kkk1)
                                    ({{$kkk1 * $kk1['kriteria'][$nk]}})
                                    @if (($nk+1)< count($kk1['k2']))
                                        +
                                    @endif
                                    @php
                                        $nk++;
                                    @endphp
                                @endforeach
                                ) + ( {{$kk1['konstanta']}}∏
                                @php
                                    $nk = 0;
                                @endphp
                                @foreach ($kk1['k2'] as $kkk1)
                                    ({{$kkk1}}<sup>{{$kk1['kriteria'][$nk]}}</sup>)
                                    @if (($nk+1)< count($kk1['k2']))
                                        +
                                    @endif
                                    @php
                                        $nk++;
                                    @endphp
                                @endforeach
                                )
                            </td>

                        </tr>

                        <tr>
                            <td></td>
                            <td>=</td>
                            <td valign="top">
                                ( {{$kk1['konstanta']}}∑
                                @php
                                    $nk = 0;
                                    $en = 0;
                                @endphp
                                @foreach ($kk1['k2'] as $kkk1)
                                    @php

                                        $en = $en + $kkk1 * $kk1['kriteria'][$nk];

                                    @endphp
                                    @php
                                        $nk++;
                                    @endphp
                                @endforeach
                                ({{$en}})
                                ) + ( {{$kk1['konstanta']}}∏
                                @php
                                    $nk = 0;
                                    $en = 0;
                                @endphp
                                @foreach ($kk1['k2'] as $kkk1)
                                    @php

                                        $en = $en + pow($kkk1,$kk1['kriteria'][$nk]);

                                    @endphp
                                    @php
                                        $nk++;
                                    @endphp
                                @endforeach
                                ({{$en}})
                                )
                            </td>

                        </tr>


                        <tr>
                            <td></td>
                            <td>=</td>
                            <td valign="top">
                                (
                                @php
                                    $nk = 0;
                                    $en = 0;
                                @endphp
                                @foreach ($kk1['k2'] as $kkk1)
                                    @php

                                        $en = $en + $kkk1 * $kk1['kriteria'][$nk];

                                    @endphp
                                    @php
                                        $nk++;
                                    @endphp
                                @endforeach
                                {{$en * $kk1['konstanta']}}
                                ) + (
                                @php
                                    $nk = 0;
                                    $en = 0;
                                @endphp
                                @foreach ($kk1['k2'] as $kkk1)
                                    @php

                                        $en = $en + pow($kkk1,$kk1['kriteria'][$nk]);

                                    @endphp
                                    @php
                                        $nk++;
                                    @endphp
                                @endforeach
                                {{$en * $kk1['konstanta']}}
                                )
                            </td>

                        </tr>

                        <tr>
                            <td></td>
                            <td>=</td>
                            <td class="text-bold">

                                @php
                                    $end = 0;
                                    $nk = 0;
                                    $en = 0;
                                @endphp
                                @foreach ($kk1['k2'] as $kkk1)
                                    @php

                                        $en = $en + $kkk1 * $kk1['kriteria'][$nk];

                                    @endphp
                                    @php
                                        $nk++;
                                    @endphp
                                @endforeach
                                @php
                                    $end = $end + $en * $kk1['konstanta'];
                                @endphp
                                @php
                                    $nk = 0;
                                    $en = 0;
                                @endphp
                                @foreach ($kk1['k2'] as $kkk1)
                                    @php

                                        $en = $en + pow($kkk1,$kk1['kriteria'][$nk]);

                                    @endphp
                                    @php
                                        $nk++;
                                    @endphp
                                @endforeach
                                {{$end + ($en * $kk1['konstanta'])}} ({{ucwords($kk1['nama'])}})

                            </td>

                        </tr>
                        <tr>
                            <td><br></td>
                        </tr>
                        @endforeach

                    </table>



                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
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

    <div class="card table-responsive">
        <div class="card-body ">
            <table class="table table-striped table-bordered table-sm table-hover">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>J. Kelamin</th>
                    <th>Kontak</th>
                    <th>Nilai</th>
                </tr>
                @php

                @endphp
                @foreach ($data as $item)
                    <tr>
                        <td nowrap width="5%" class="text-center">{{$loop->iteration}}</td>
                        <td nowrap class="text-bold text-capitalize">{{$item['nama']}}</td>
                        <td>{{($item['kelamin']=="l")?'Laki-laki':'Perempuan'}}</td>
                        <td>
                            <!-- Button trigger modal -->
                            <button type="button" class="badge badge-primary badge-lg py-1 border-0 badge-info" data-toggle="modal" data-target="#kontak{{$loop->iteration}}">
                              <i class="fa fa-phone"></i> Kontak
                            </button>

                            <!-- Modal -->

                        </td>

                        <td class="text-center text-lg text-bold">
                            {{$item['hasil']}}
                        </td>
                    </tr>

                    <div class="modal fade" id="kontak{{$loop->iteration}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Kontak ({{ucwords($item['nama'])}})</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                                <div class="modal-body">
                                    <div class='form-group'>
                                        <label for='foremail' class='text-capitalize'>Email</label>
                                        <input type='text' name='email' id='foremail' class='form-control' readonly value="{{$item['email']}}">
                                    </div>
                                    <div class='form-group'>
                                        <label for='forhp/wa' class='text-capitalize'>HP/WA</label>
                                        <input type='text' name='hp/wa' id='forhp/wa' class='form-control' readonly value="{{$item['hp']}}">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </table>
        </div>
    </div>


@endsection
