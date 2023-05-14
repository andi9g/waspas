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

class nilaiC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function nilai(Request $request)
    {
        $lowongan = lowonganM::where('ket', true)->orderBy('idlowongan', 'asc')->get();

        return view('pages.pagesNilai', [
            'lowongan' => $lowongan,
        ]);
    }
    public function peserta(Request $request, $idlowongan)
    {
        $namalowongan = lowonganM::where('idlowongan', $idlowongan)->first()->judullowongan;

        $pelamar = pelamarM::join('lowongan', 'lowongan.idlowongan', 'pelamar.idlowongan')
        ->join('akun', 'akun.idakun', 'pelamar.idakun')
        ->where('lowongan.idlowongan', $idlowongan)
        ->where('pelamar.ket', true)
        ->select('akun.*', 'pelamar.*','lowongan.*', 'pelamar.ket')
        ->get()
        ;

        return view('pages.pagesNilaiPeserta',[
            'pelamar' => $pelamar,
            'namalowongan' => $namalowongan,
            'idlowongan' => $idlowongan,
        ]);
    }

    public function penilaian(Request $request, $idlowongan, $idpelamar)
    {
        try{
            $kriteria = kriteriaM::get();
            $pelamar = pelamarM::join('akun', 'akun.idakun', 'pelamar.idakun')
            ->join('lowongan', 'lowongan.idlowongan', 'pelamar.idlowongan')
            ->where('pelamar.idpelamar', $idpelamar)
            ->select('pelamar.*', 'akun.*')
            ->first();

            return view('pages.pagesPenilaian', [
                'kriteria' => $kriteria,
                'pelamar' => $pelamar,
                'idlowongan' => $idlowongan,
            ]);

        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
    }

    public function penilaianpeserta(Request $request, $idlowongan, $idpelamar, $idkriteria)
    {
        $request->validate([
            'value'=>'required|numeric'
        ]);

        try{
            $value = (int)$request->value;
            $typedata = kriteriaM::where('idkriteria', $idkriteria)->first()->typedata;

            if($typedata=="angka") {
                $detailK = detailkriteria::where('idkriteria', $idkriteria)->orderBy('max', 'asc')->get();

                $i= 0;
                foreach ($detailK as $k) {

                    if($value <= $k->max && $i==0) {
                        $iddetailkriteria = $k->iddetailkriteria;
                        $nilai = $value;
                        $i++;
                    }

                }
            }else {
                $iddetailkriteria = $value;
                $nilai = null;

            }

            $cek = nilaiM::where('idpelamar', $idpelamar)->where('idkriteria', $idkriteria);

            if($cek->count() > 0 ) {
                $cek->delete();
            }

            $ex = new nilaiM;
            $ex->idpelamar = $idpelamar;
            $ex->idkriteria = $idkriteria;
            $ex->iddetailkriteria = $iddetailkriteria;
            $ex->nilai = $nilai;
            $ex->save();
            if ($ex) {
                return redirect()->back()->with('toast_success', 'Success');
            }

        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
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
     * @param  \App\Models\lowonganM  $lowonganM
     * @return \Illuminate\Http\Response
     */
    public function show(lowonganM $lowonganM)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\lowonganM  $lowonganM
     * @return \Illuminate\Http\Response
     */
    public function edit(lowonganM $lowonganM)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\lowonganM  $lowonganM
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, lowonganM $lowonganM)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\lowonganM  $lowonganM
     * @return \Illuminate\Http\Response
     */
    public function destroy(lowonganM $lowonganM)
    {
        //
    }
}
