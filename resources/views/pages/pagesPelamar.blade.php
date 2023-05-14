@extends('layout.master')

@section('activekuPelamar')
    activeku
@endsection

@section('judul')
    <i class="fa fa-users"></i> Data Pelamar
@endsection

@section('content')

<div class="row">
    @foreach ($lowongan as $item)

    <div class="col-md-4">
        <div class="card">
            <a href="{{ route('pelamar.lowongan', [$item->idlowongan]) }}">
                <div class="card-body text-lg">
                    {{strtoupper($item->judullowongan)}} &nbsp;
                    <small class="badge badge-info text-xs">
                        @php
                            $jum = DB::table('pelamar')->where('idlowongan', $item->idlowongan)->count();
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
