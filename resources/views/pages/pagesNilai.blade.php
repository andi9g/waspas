@extends('layout.master')

@section('activekuNilai')
    activeku
@endsection

@section('judul')
    <i class="fa fa-edit"></i> Penilaian
@endsection

@section('content')

<div class="row">

    @foreach ($lowongan as $item)

    <div class="col-md-4">
        <div class="card">
            <a href="{{ route('nilai.peserta', [$item->idlowongan]) }}">
                <div class="card-body text-lg">
                    {{strtoupper($item->judullowongan)}} &nbsp;
                    <small class="badge badge-info text-xs">
                        @php
                            $jum = DB::table('pelamar')->where('idlowongan', $item->idlowongan)
                            ->where('ket', true)->count();
                        @endphp
                        {{$jum}}
                    </small>
                </div>
            </a>
        </div>
    </div>
    @endforeach
</div>


@endsection
