<?php

namespace App\Http\Controllers;

use App\Models\kriteriaM;
use App\Models\detailkriteria;
use Illuminate\Http\Request;

class kriteriaC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $kriteria = kriteriaM::get();
        return view('pages.pagesKriteria', [
            'kriteria' => $kriteria,
        ]);
    }


    public function store(Request $request)
    {
        // dd($request);
        // $request->validate([
        //     'judulkriteria' => 'required',
        //     'typedata' => 'required',
        //     'bobot' => 'required',
        // ]);


        // try{
            $judulkriteria = $request->judulkriteria;
            $typedata = $request->typedata;
            $bobot = $request->bobot;

            $kriteria = kriteriaM::get();
            $total = 0;
            foreach ($kriteria as $ambil) {
                $total = $total + $ambil->bobot;
            }
            $total = $total + $bobot;

            if($total > 100) {
                return redirect()->back()->with('toast_error','Maaf, bobot maksimal 100%, yang diproses adalah '. $total."%")->withInput();
            }

            $store = new kriteriaM;
            $store->judulkriteria = $judulkriteria;
            $store->typedata = $typedata;
            $store->bobot = $bobot;
            $store->save();
            if($store) {
                $idkriteria = kriteriaM::where('judulkriteria', $judulkriteria)->first()->idkriteria;
                if($typedata == 'angka'){
                    $min = ['0', '21', '41', '61', '81'];
                    $max = ['20','40','60','80','100'];

                    for ($i=0; $i < count($min); $i++) {
                        $tambah = new detailkriteria;
                        $tambah->idkriteria = $idkriteria;
                        $tambah->min = $min[$i];
                        $tambah->max = $max[$i];
                        $tambah->bobot = 0;
                        $tambah->save();
                    }

                }elseif($typedata == 'pendidikan'){
                    $juduldetailkriteria = ['SD', 'SMP', 'SMA/SMK', 'S1'];

                    for ($i=0; $i < count($juduldetailkriteria); $i++) {
                        $tambah = new detailkriteria;
                        $tambah->idkriteria = $idkriteria;
                        $tambah->juduldetailkriteria = $juduldetailkriteria[$i];
                        $tambah->bobot = 0;
                        $tambah->save();
                    }
                }elseif($typedata == 'manual') {
                    $juduldetailkriteria = ['Tidak Baik', 'Kurang Baik', 'Cukup', 'Baik', 'Sangat Baik'];

                    for ($i=0; $i < count($juduldetailkriteria); $i++) {
                        $tambah = new detailkriteria;
                        $tambah->idkriteria = $idkriteria;
                        $tambah->juduldetailkriteria = $juduldetailkriteria[$i];
                        $tambah->bobot = 0;
                        $tambah->save();
                    }
                }

                if ($tambah) {
                    # code...
                    return redirect()->back()->with('toast_success', 'success');
                }else {
                    return redirect()->back()->with('toast_success', 'success');

                }


            }
        // }catch(\Throwable $th){
        //     return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        // }
    }



    public function detailkriteria(Request $request, $idkriteria)
    {
        try{
            $kriteria = kriteriaM::where('idkriteria', $idkriteria)->first();
            $detailkriteria = detailkriteria::where('idkriteria', $idkriteria)->get();
            return view('pages.pagesDetailKriteria', [
                'detailkriteria' => $detailkriteria,
                'kriteria' => $kriteria,
            ]);

        }catch(\Throwable $th){
            return redirect('kriteria')->with('toast_error', 'Terjadi kesalahan');
        }
    }


    public function updatedetailkriteria(Request $request, $idkriteria, $iddetailkriteria)
    {
        $ket = kriteriaM::where('idkriteria', $idkriteria)->first()->typedata;

        if($ket == 'pendidikan'||$ket == 'manual'){
            $jk = empty($request->juduldetailkriteria)?null:$request->juduldetailkriteria;
            // dd($min." ".$max);
            if($jk !== null) {
                $request->validate([
                    'juduldetailkriteria'=>'required'
                ]);
                $data = 'juduldetailkriteria';
                $value = $request->juduldetailkriteria;
            }else {
                $data='bobot';
                $value = $request->bobot;
            }

        }else {
            $min = ($request->min >= "0")?(int)$request->min:null;
            $max = ($request->max >= "0")?(int)$request->max:null;
            // dd($min." ".$max);
            if($min !== null) {
                $request->validate([
                    'min'=>'required'
                ]);
                $data = 'min';
                $value = $min;
            }elseif($max !== null) {
                $request->validate([
                    'max'=>'required'
                ]);
                $data='max';
                $value = $max;
            }else {
                $data='bobot';
                $value = $request->bobot;
            }
        }

        try{
            $update = detailkriteria::where('iddetailkriteria', $iddetailkriteria)->where('idkriteria', $idkriteria)
            ->update([
                $data => $value,
            ]);

            if($update) {
                return redirect()->back()->with('toast_success', 'Berhasil di ubah');
            }

        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
    }

    public function tambahdetailkriteria(Request $request, $idkriteria)
    {
        $ket = kriteriaM::where('idkriteria', $idkriteria)->first()->typedata;

        if($ket == 'pendidikan'||$ket == 'manual'){
            $request->validate([
                'juduldetailkriteria'=>'required',
                'bobot'=>'required',
            ]);
            $data = 'juduldetailkriteria';
            $value = $request->juduldetailkriteria;
        }else {

            $request->validate([
                'min'=>'required',
                'max'=>'required',
                'bobot'=>'required',
            ]);

        }

        try{
            if($ket == 'pendidikan'||$ket == 'manual'){
                $tambah = new detailkriteria;
                $tambah->idkriteria = $idkriteria;
                $tambah->$data = $value;
                $tambah->bobot = $request->bobot;
                $tambah->save();

            }else {
                $tambah = new detailkriteria;
                $tambah->idkriteria = $idkriteria;
                $tambah->min = $request->min;
                $tambah->max = $request->max;
                $tambah->bobot = $request->bobot;
                $tambah->save();
            }

            if($tambah) {
                return redirect()->back()->with('success', 'Berhasil di ubah');
            }

        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
    }

    public function hapusdetailkriteria(Request $request, $iddetailkriteria)
    {
        try{
            $destroy = detailkriteria::where('iddetailkriteria', $iddetailkriteria)->delete();
            if($destroy) {
                return redirect()->back()->with('toast_success', 'success');
            }
        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
    }

    public function hapuskriteria(Request $request, $idkriteria)
    {
        try{
            $kriteria = kriteriaM::where('idkriteria', $idkriteria)->delete();
            $detailkriteria = detailkriteria::where('idkriteria', $idkriteria)->delete();
            if($kriteria||$detailkriteria) {
                return redirect()->back()->with('toast_success', 'success');
            }
        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
    }

    public function bobot(Request $request, $idkriteria)
    {
        $request->validate([
            'bobot' => 'required|numeric',
        ]);


        try{
            $bobot = $request->bobot;

            $kriteria = kriteriaM::get();
            $total = 0;
            foreach ($kriteria as $ambil) {
                $total = $total + $ambil->bobot;
            }
            $total = $total + $bobot;

            if($total > 100) {
                return redirect()->back()->with('toast_error','Maaf, bobot maksimal 100%, yang diproses adalah '. $total."%")->withInput();
            }

            $update = kriteriaM::where('idkriteria', $idkriteria)->update([
                'bobot' => $bobot,
            ]);
            if($update) {
                return redirect()->back()->with('toast_success', 'success');
            }
        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
    }
}
