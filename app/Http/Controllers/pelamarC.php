<?php

namespace App\Http\Controllers;

use App\Models\pelamarM;
use App\Models\pelamaruploadM;
use App\Models\lowonganM;
use Illuminate\Http\Request;

class pelamarC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tambahpelamar(Request $request, $idlowongan)
    {
        try{
            $idlowongan = $idlowongan;
            $idakun = $request->session()->get('idakun');

            $store = new pelamarM;
            $store->idlowongan = $idlowongan;
            $store->idakun = $idakun;
            $store->ket = false;
            $store->save();

            if($store) {
                return redirect('lamaran')->with('toast_success', 'SUCCESS, Silahkan melengkapi Identitas');
            }
        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
    }

    public function lamaran(Request $request)
    {
        $idakun = $request->session()->get('idakun');
        $pelamar = pelamarM::join('lowongan', 'lowongan.idlowongan', 'pelamar.idlowongan')
        // ->where('lowongan.ket', true)
        ->where('pelamar.idakun', $idakun)->orderBy('pelamar.idpelamar', 'asc')
        ->select('pelamar.*', 'lowongan.judullowongan', 'lowongan.ket')
        ->get();

        return view('pages.pagesLamaran', [
            'pelamar' => $pelamar,
        ]);
    }

    public function upload(Request $request, $idupload, $idpelamar)
    {
        $request->validate([
            'upload' => 'required',
        ]);


        try{
            if ($request->hasFile('upload')) {
                $file = $request->file('upload');
                $lokasi = $file->getClientOriginalName();
                $fileName = pathinfo($lokasi, PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();

                $format = strtolower($extension);
                if($format == 'jpg' || $format == 'png' || $format == 'pdf' | $format == 'jpeg') {
                    $fileName = $fileName.'_'.time().'.'.$extension;
                    $upload = $file->move(\base_path() .'/public/berkas/pelamar', $fileName);
                }else {
                    return redirect()->back()->with('toast_error', 'hanya menerima format (pdf, jpg dan png)');
                }

            }else {
                return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
            }

            $store = new pelamaruploadM;
            $store->idupload = $idupload;
            $store->idpelamar = $idpelamar;
            $store->namaberkas = $fileName;
            $store->save();
            if($store) {
                return redirect()->back()->with('toast_success', 'success');
            }
        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
    }
    public function hapus(Request $request, $idpelamarupload)
    {
        try{
            $destroy = pelamaruploadM::where('idpelamarupload', $idpelamarupload)->delete();
            if($destroy) {
                return redirect()->back()->with('toast_success', 'success');
            }
        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
    }



    //pelamar
    public function pelamar(Request $request)
    {
        $lowongan = lowonganM::where('ket', true)->orderBy('idlowongan', 'asc')->get();

        return view('pages.pagesPelamar', [
            'lowongan' => $lowongan,
        ]);
    }

    public function lowongan(Request $request, $idlowongan)
    {
        try{
            $namalowongan = lowonganM::where('idlowongan', $idlowongan)->first()->judullowongan;

            $pelamar = pelamarM::join('lowongan', 'lowongan.idlowongan', 'pelamar.idlowongan')
            ->join('akun', 'akun.idakun', 'pelamar.idakun')
            ->where('lowongan.idlowongan', $idlowongan)
            ->select('akun.*', 'pelamar.*','lowongan.*', 'pelamar.ket')
            ->get()
            ;

            return view('pages.pagesPelamarLowongan',[
                'pelamar' => $pelamar,
                'namalowongan' => $namalowongan,
                'idlowongan' => $idlowongan,
            ]);
        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
    }

    public function ket(Request $request, $idpelamar)
    {
        $request->validate([
            'ket' => 'required',
        ]);


        try{
            $ket = (boolean)$request->ket;

            $update = pelamarM::where('idpelamar', $idpelamar)->update([
                'ket' => $ket,
            ]);
            if($update) {
                return redirect()->back()->with('toast_success', 'success');
            }
        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
    }
}
