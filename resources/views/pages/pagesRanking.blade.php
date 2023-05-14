@extends('layout.master')

@section('activekuRanking')
    activeku
@endsection

@section('judul')
    <i class="fa fa-trophy"></i> Pringkat Terbaik
@endsection

@section('content')

<div class="row">

    @foreach ($lowongan as $item)

    <div class="col-md-4">
        <div class="card">
            <a href="{{ route('ranking.peserta', [$item->idlowongan]) }}">
                <div class="card-body text-lg text-center">
                    {{strtoupper($item->judullowongan)}} &nbsp;
                </div>
            </a>
        </div>
    </div>
    @endforeach
</div>


@endsection
