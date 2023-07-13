<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body {
            padding: 0 auto;
        }
    </style>
</head>
<body>

    <table style="border-bottom: 2px double;padding-bottom: 2px" width="100%">
        <tr valign="top">
            <td width="15%">
                <img src="{{ url('gambar', ['logo.jpeg']) }}" alt="" width="100%">
            </td>
            <td>
                <h2 style="padding: 0;margin:0;text-transform: uppercase">
                    Toko Brojaya Bintan Center
                </h2>
                <p style="padding: 0;margin: 0">Jln. D.I Panjaitan km 10 Komplek Ruko Bintan Center R.20 Tanjungpinang</p>
            </td>
        </tr>
    </table>


    <table style="font-size: 11pt;margin: 5px auto" width="100%">
        <tr>
            <td>
                <table>
                    <tr>
                        <td>Posisi</td>
                        <td>:</td>
                        <td>
                            <b>
                                {{ $lowongan->judullowongan }}
                            </b>
                        </td>

                    </tr>
                    <tr>
                        <td>Tanggal Buka</td>
                        <td>:</td>
                        <td>
                            <b>
                                {{\Carbon\Carbon::parse($lowongan->tanggalbuka)->isoFormat('dddd, DD MMMM Y')}}
                            </b>
                        </td>
                    </tr>
                    <tr>
                        <td>Tanggal Tutup</td>
                        <td>:</td>
                        <td>
                            <b>
                                {{\Carbon\Carbon::parse($lowongan->tanggaltutup)->isoFormat('dddd, DD MMMM Y')}}
                            </b>
                        </td>
                    </tr>
                </table>
            </td>
            <td style="text-align: right" valign="top">


            </td>
        </tr>

    </table>

    <table class="" width="100%" border="1" style="border-collapse: collapse">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Jenis Kelamin</th>
            <th>Kontak</th>
            <th>Nilai</th>
        </tr>
        @php

        @endphp
        @foreach ($data as $item)
            <tr>
                <td nowrap width="5%" align="text-center">{{$loop->iteration}}</td>
                <td nowrap class="text-bold text-capitalize">{{$item['nama']}}</td>
                <td>{{($item['kelamin']=="l")?'Laki-laki':'Perempuan'}}</td>
                <td>{{$item['hp']}}</td>
                <td class="text-center text-lg text-bold">
                    {{$item['hasil']}}
                </td>
            </tr>


        @endforeach
    </table>

    <table width="100%">
        <tr>
            <td width="10%"></td>
            <td width="50%">
                <table>
                    <tr>
                        <td><br><br></td>
                    </tr>
                    <tr>
                        <td>Diketahui oleh</td>
                    </tr>
                    <tr>
                        <td><br><br><br><br></td>
                    </tr>
                    <tr>
                        <td>________________________</td>
                    </tr>
                </table>
            </td>
            <td width="">
                <table>
                    <tr>
                        <td><br>Tanjungpinang, {{\Carbon\Carbon::parse(date('Y-m-d'))->isoFormat('DD MMMM Y')}}</td>
                    </tr>
                    <tr>
                        <td>Disahkan oleh</td>
                    </tr>
                    <tr>
                        <td><br><br><br><br></td>
                    </tr>
                    <tr>
                        <td>________________________</td>
                    </tr>
                </table>

            </td>
        </tr>
    </table>


</body>
</html>
