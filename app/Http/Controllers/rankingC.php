<?php

namespace App\Http\Controllers;

use App\Models\lowonganM;
use App\Models\pelamarM;
use App\Models\kriteriaM;
use App\Models\akunM;
use App\Models\nilaiM;
use App\Models\akunpelamaruploadM;
use App\Models\detailkriteria;
use App\Models\uploadM;
use Illuminate\Http\Request;
use PDF;

class rankingC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lowongan = lowonganM::where('ket', true)->orderBy('idlowongan', 'asc')->get();

        return view('pages.pagesRanking', [
            'lowongan' => $lowongan,
        ]);
    }

    public function ranking(Request $request, $idlowongan)
    {
        $pelamar = pelamarM::join('lowongan', 'lowongan.idlowongan', 'pelamar.idlowongan')
        ->join('akun', 'akun.idakun', 'pelamar.idakun')
        ->where('lowongan.idlowongan', $idlowongan)
        ->where('akun.posisi', '!=', 'superadmin')
        ->where('pelamar.ket', true)
        ->select('akun.*', 'pelamar.*')
        ->get();


        $k1 = array();
        $konstanta = 0.5;
        $pi = 0;

        foreach ($pelamar as $p) {
            $kriteria = kriteriaM::get();

            foreach ($kriteria as $k) {
                $detailkriteria = nilaiM::join('kriteria', 'kriteria.idkriteria', 'nilai.idkriteria')
                ->join('pelamar', 'pelamar.idpelamar', 'nilai.idpelamar')
                ->join('detailkriteria', 'detailkriteria.iddetailkriteria', 'nilai.iddetailkriteria')
                ->where('nilai.idkriteria', $k->idkriteria)
                ->where('pelamar.idpelamar', $p->idpelamar)
                ->orderBy('kriteria.idkriteria', 'asc')
                ->select('detailkriteria.bobot')
                ->first();

                ${$k->judulkriteria}[] = empty($detailkriteria->bobot)?0:$detailkriteria->bobot;

            }
        }


        foreach ($pelamar as $p) {
            $kriteria = kriteriaM::get();
            $ki = 0;
            $n1 = 0;
            $n2 = 0;
            $hasil = 0;
            // $detailkriteria = [];
            foreach ($kriteria as $k) {
                $detailkriteria = nilaiM::join('kriteria', 'kriteria.idkriteria', 'nilai.idkriteria')
                ->join('pelamar', 'pelamar.idpelamar', 'nilai.idpelamar')
                ->join('detailkriteria', 'detailkriteria.iddetailkriteria', 'nilai.iddetailkriteria')
                ->where('nilai.idkriteria', $k->idkriteria)
                ->where('pelamar.idpelamar', $p->idpelamar)
                ->orderBy('kriteria.idkriteria', 'asc')
                ->select('detailkriteria.bobot')
                ->first();
                // $bobot = ;
                $coba = ${$k->judulkriteria};

                $coba = rsort($coba);
                dd(end($coba));
                $nk[$ki] = $k->bobot;
                $nilai[$ki] = empty($detailkriteria->bobot)?0:$detailkriteria->bobot;
                $normalisasi[$ki] = empty($detailkriteria->bobot)?0:$detailkriteria->bobot / count($kriteria);
                $n1 = $n1 + ((empty($detailkriteria->bobot)?0:$detailkriteria->bobot / count($kriteria)) * $k->bobot);
                $n2 = $n2 + pow((empty($detailkriteria->bobot)?0:$detailkriteria->bobot / count($kriteria)), $k->bobot);
                $ki++;
            }

            $n1 = $konstanta * $n1;
            $n2 = $konstanta * $n2;
            $hasil = $n1 + $n2;

            $arrPelamar[$pi] = [
                'nama' => $p->namaakun,
                'hp' => $p->hp,
                'email' => $p->email,
                'kelamin' => $p->jk,
                'nonnormalisasi' => $nilai,
                'normalisasi' => $normalisasi,
                'n1' => $n1,
                'n2' => $n2,
                'konstanta' => $konstanta,
                'kriteria' => $nk,
                'hasil' => $hasil,
            ];

            $k1[$pi] = [
               'nama' => $p->namaakun,
               'konstanta' => $konstanta,
               'k' => $nilai,
               'k2' => $normalisasi,
               'kriteria' => $nk,
            ];

            $pi++;

        }

        if(empty($k1)){
            return redirect()->back()->with('warning', 'maaf belum ada data')->withInput();
        }

        $k1 = collect($k1);
        $dataasli = collect($arrPelamar);
        $data = collect($arrPelamar);
        $data = $data->sortByDesc('hasil');

        return view('pages.pagesHasil',[
            'dataasli' => $dataasli,
            'data' => $data,
            'idlowongan' => $idlowongan,

            'k1' => $k1,
            'jumlahkriteria' => count($kriteria),
        ]);


    }


    public function cetak(Request $request, $idlowongan) {

        $pelamar = pelamarM::join('lowongan', 'lowongan.idlowongan', 'pelamar.idlowongan')
        ->join('akun', 'akun.idakun', 'pelamar.idakun')
        ->where('lowongan.idlowongan', $idlowongan)
        ->where('akun.posisi', '!=', 'superadmin')
        ->where('pelamar.ket', true)
        ->select('akun.*', 'pelamar.*', 'lowongan.judullowongan')
        ->get();


        $k1 = array();
        $konstanta = 0.5;
        $pi = 0;
        foreach ($pelamar as $p) {
            $kriteria = kriteriaM::get();
            $ki = 0;
            $n1 = 0;
            $n2 = 0;
            $hasil = 0;
            // $detailkriteria = [];
            foreach ($kriteria as $k) {
                $detailkriteria = nilaiM::join('kriteria', 'kriteria.idkriteria', 'nilai.idkriteria')
                ->join('pelamar', 'pelamar.idpelamar', 'nilai.idpelamar')
                ->join('detailkriteria', 'detailkriteria.iddetailkriteria', 'nilai.iddetailkriteria')
                ->where('nilai.idkriteria', $k->idkriteria)
                ->where('pelamar.idpelamar', $p->idpelamar)
                ->orderBy('kriteria.idkriteria', 'asc')
                ->select('detailkriteria.bobot')
                ->first();
                // $bobot = ;

                $nk[$ki] = $k->bobot;
                $nilai[$ki] = empty($detailkriteria->bobot)?0:$detailkriteria->bobot;
                $normalisasi[$ki] = empty($detailkriteria->bobot)?0:$detailkriteria->bobot / count($kriteria);
                $n1 = $n1 + ((empty($detailkriteria->bobot)?0:$detailkriteria->bobot / count($kriteria)) * $k->bobot);
                $n2 = $n2 + pow((empty($detailkriteria->bobot)?0:$detailkriteria->bobot / count($kriteria)), $k->bobot);
                $ki++;
            }

            $n1 = $konstanta * $n1;
            $n2 = $konstanta * $n2;
            $hasil = $n1 + $n2;

            $arrPelamar[$pi] = [
                'nama' => $p->namaakun,
                'hp' => $p->hp,
                'email' => $p->email,
                'kelamin' => $p->jk,
                'nonnormalisasi' => $nilai,
                'normalisasi' => $normalisasi,
                'n1' => $n1,
                'n2' => $n2,
                'konstanta' => $konstanta,
                'kriteria' => $nk,
                'hasil' => $hasil,
                'lowongan' => $p->judullowongan,
            ];

            $k1[$pi] = [
               'nama' => $p->namaakun,
               'konstanta' => $konstanta,
               'k' => $nilai,
               'k2' => $normalisasi,
               'kriteria' => $nk,
            ];

            $pi++;

        }

        if(empty($k1)){
            return redirect('ranking')->with('warning', 'maaf belum ada data')->withInput();
        }

        $k1 = collect($k1);
        $dataasli = collect($arrPelamar);
        $data = collect($arrPelamar);
        $data = $data->sortByDesc('hasil');


        $lowongan = lowonganM::where('idlowongan', $idlowongan)->first();


        $pdf = PDF::loadView('laporan.ranking', [
            'data' => $data,
            'lowongan' => $lowongan,
        ]);

        return $pdf->stream('laporan-ranking.pdf');

        // return view('pages.pagesHasil',[
        //     'dataasli' => $dataasli,
        //     'data' => $data,
        //     'idlowongan' => $idlowongan,

        //     'k1' => $k1,
        //     'jumlahkriteria' => count($kriteria),
        // ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\nilaiM  $nilaiM
     * @return \Illuminate\Http\Response
     */
    public function show(nilaiM $nilaiM)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\nilaiM  $nilaiM
     * @return \Illuminate\Http\Response
     */
    public function edit(nilaiM $nilaiM)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\nilaiM  $nilaiM
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, nilaiM $nilaiM)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\nilaiM  $nilaiM
     * @return \Illuminate\Http\Response
     */
    public function destroy(nilaiM $nilaiM)
    {
        //
    }
}
