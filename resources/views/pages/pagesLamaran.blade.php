@extends('layout.master')

@section('activekuLamaran')
    activeku
@endsection

@section('judul')
    <i class="fa fa-id-card"></i> Daftar Lamaran
@endsection

@section('content')


<div class="row">
    @foreach ($pelamar as $item)
    @if ($item->ket == true)
    <div class="col-md-4">
        <div class="card" style="border-top:3px solid rgba(69, 181, 255, 0.877)">
            <div class="card-header" >
                <h4 class="text-bold my-0 py-0">{{strtoupper($item->judullowongan)}}</h4>
            </div>
            <div class="card-body">
                Lengkapi persyaratan dokumen dibawah ini.
                <table class="table table-striped table-bordered table-sm table-hover">
                    <thead class="bg-secondary">
                        <tr>
                            <th>Berkas</th>
                            <th>Upload</th>
                            <th>Ket.</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $upload = DB::table('upload')->where('idlowongan', $item->idlowongan)->get();
                        @endphp
                        @foreach ($upload as $u)
                        @php
                            $pelamarupload = DB::table('pelamarupload')->join('upload', 'upload.idupload', 'pelamarupload.idupload')
                            ->join('lowongan', 'lowongan.idlowongan', 'upload.idlowongan')
                            ->where('lowongan.ket', true)
                            ->where('upload.idupload', $u->idupload)
                            ->where('pelamarupload.idpelamar', $item->idpelamar)
                            ->select('pelamarupload.*');
                        @endphp
                            <tr>
                                <td class="text-uppercase text-bold">{{$u->judulupload}}</td>
                                <td>
                                    <!-- Button trigger modal -->
                                    @php
                                        $lowongan = DB::table('lowongan')->where('idlowongan', $item->idlowongan)->first();
                                        $tanggalbuka = strtotime($lowongan->tanggalbuka);
                                        $tanggaltutup = strtotime($lowongan->tanggaltutup);
                                        $sekarang = strtotime (date("Y-m-d"));
                                    @endphp
                                    @if ($sekarang < $tanggalbuka)
                                    <font class="text-warning">Pendaftaran belum dibuka</font>
                                    @elseif ($sekarang > $tanggaltutup)
                                        <font class="text-danger">Telah lewat masa pendaftaran</font>
                                    @else
                                    <button type="button" class="badge badge-primary badge-lg border-0 py-1" data-toggle="modal" data-target="#upload{{$u->idupload}}">
                                      <i class="fa fa-file"></i> Upload
                                    </button>
                                    @endif



                                    @if ($pelamarupload->count() === 1 )
                                        <a href="{{ url('/berkas/pelamar', [$pelamarupload->first()->namaberkas]) }}" class="badge badge-info border-0 py-1" target="_blank">
                                            <i class="fa fa-eye"></i>
                                            Lihat
                                        </a>

                                        <form action="{{ route('hapus.berkas', [$pelamarupload->first()->idpelamarupload]) }}" method="post">
                                            @csrf
                                            <button type="submit" onclick="return confirm('yakin ingin dihapus?')" class="badge badge-danger border-0 py-1">
                                                <i class="fa fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                    @endif

                                </td>
                                <td class="text-bold text-center">


                                    @if ($pelamarupload->count() === 1)
                                        <font class="text-success text-bold">OK</font>
                                    @else
                                        <font class="text-danger text-bold">Tidak ada data</font>
                                    @endif
                                </td>
                            </tr>

                            <!-- Modal -->
                            <div class="modal fade" id="upload{{$u->idupload}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Upload {{strtoupper($u->judulupload)}}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                        </div>
                                        <form action="{{ route('upload.berkas', [$u->idupload,$item->idpelamar]) }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body">
                                                <div class='form-group'>
                                                    <label for='namaberkas' class='text-capitalize'>Pilih Berkas</label>
                                                    <input type='file' name='upload' id='namaberkas' class='form-control' placeholder='masukan namaplaceholder'>
                                                    <p>Format yang di setujui gambar (jpg, jpeg & png) serta dokumen (PDF) </p>
                                                    <p>Max file yang diupload adalah 2 MB</p>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Upload</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        @endforeach
                    </tbody>
                </table>
                <br>

                <p class="text-danger text-center"><i>Jika persyaratan telah diupload semua, selanjutnya menunggu verifikasi dan panggilan dari HRD </i></p>
            </div>
        </div>
    </div>

    @else
    <div class="col-md-4">
        <div class="card" style="border-top:3px solid rgba(69, 181, 255, 0.877)">
            <div class="card-header" >
                <h4 class="text-bold my-0 py-0">{{strtoupper($item->judullowongan)}}</h4>
            </div>
            <div class="card-body">
                Lengkapi persyaratan dokumen dibawah ini.
                <table class="table table-striped table-bordered table-sm table-hover">
                    <thead class="bg-secondary">
                        <tr>
                            <th>Berkas</th>
                            <th>Upload</th>
                            <th>Ket.</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $upload = DB::table('upload')->where('idlowongan', $item->idlowongan)->get();
                        @endphp
                        @foreach ($upload as $u)
                        @php
                            $pelamarupload = DB::table('pelamarupload')->join('upload', 'upload.idupload', 'pelamarupload.idupload')
                            ->join('lowongan', 'lowongan.idlowongan', 'upload.idlowongan')
                            // ->where('lowongan.ket', true)
                            ->where('upload.idupload', $u->idupload)
                            ->where('pelamarupload.idpelamar', $item->idpelamar)
                            ->select('pelamarupload.*');
                        @endphp
                            <tr>
                                <td class="text-uppercase text-bold">{{$u->judulupload}}</td>
                                <td>

                                    @if ($pelamarupload->count() === 1)
                                        <a href="{{ url('/berkas/pelamar', [$pelamarupload->first()->namaberkas]) }}" class="badge badge-info border-0 py-1" target="_blank">
                                            <i class="fa fa-eye"></i>
                                            Lihat
                                        </a>
                                    @endif

                                </td>
                                <td class="text-bold text-center">

                                    @if ($pelamarupload->count() === 1)
                                        <font class="text-success text-bold">OK</font>
                                    @else
                                        <font class="text-danger text-bold">-</font>
                                    @endif
                                </td>
                            </tr>



                        @endforeach
                    </tbody>
                </table>
                <br>

                <p class="text-danger text-center"><i>Jika persyaratan telah diupload semua, selanjutnya menunggu verifikasi dan panggilan dari HRD </i></p>
            </div>
        </div>
    </div>


    @endif
    @endforeach
</div>


@endsection
