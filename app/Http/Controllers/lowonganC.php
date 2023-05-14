<?php

namespace App\Http\Controllers;

use App\Models\lowonganM;
use App\Models\uploadM;
use Illuminate\Http\Request;

class lowonganC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lowongan = lowonganM::orderBy('idlowongan', 'asc')->paginate(15);
        return view('pages.pagesLowongan', [
            'lowongan' => $lowongan,
        ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'judullowongan' => 'required',
            'tanggalbuka' => 'required',
            'tanggaltutup' => 'required',
            'upload' => 'required',
        ]);


        try{
            $judullowongan = $request->judullowongan;
            $tanggalbuka = $request->tanggalbuka;
            $tanggaltutup = $request->tanggaltutup;
            $upload = $request->upload;
            $ket = true;




            $store = new lowonganM;
            $store->judullowongan = $judullowongan;
            $store->tanggalbuka = $tanggalbuka;
            $store->tanggaltutup = $tanggaltutup;
            $store->ket = $ket;
            $store->save();

            if($store) {
                $idlowongan = lowonganM::where('judullowongan', $judullowongan)->first()->idlowongan;
                $ex = explode(",",$upload);
                foreach ($ex as $data) {
                    $tambah = new uploadM;
                    $tambah->idlowongan = $idlowongan;
                    $tambah->judulupload = $data;
                    $tambah->save();
                }


                return redirect()->back()->with('toast_success', 'success');
            }
        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
    }

    public function hapus(Request $request, $idlowongan)
    {
        try{
            $lowongan = lowonganM::where('idlowongan', $idlowongan)->delete();
            $upload = uploadM::where('idlowongan', $idlowongan)->delete();
            if($upload || $lowongan) {
                return redirect()->back()->with('toast_success', 'success');
            }
        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
    }

    public function edit(Request $request, $idlowongan)
    {
        $request->validate([
            'judullowongan' => 'required',
        ]);


        try{
            $judullowongan = $request->judullowongan;

            $update = lowonganM::where('idlowongan', $idlowongan)->update([
                'judullowongan' => $judullowongan,
            ]);
            if($update) {
                return redirect()->back()->with('toast_success', 'success');
            }
        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
    }

    public function ket(Request $request, $idlowongan)
    {
        $request->validate([
            'ket' => 'required',
        ]);


        try{
            $ket = (boolean)$request->ket;
            // dd($ket);
            $update = lowonganM::where('idlowongan', $idlowongan)->update([
                'ket' => $ket,
            ]);
            if($update) {
                return redirect()->back()->with('toast_success', 'success');
            }
        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
    }

    public function persyaratan(Request $request, $idlowongan)
    {
        try{
            $data = uploadM::where('idlowongan', $idlowongan)->orderBy('idupload', 'asc')->get();

            return view('pages.pagesPersyaratan', [
                'persyaratan' => $data,
                'idlowongan' => $idlowongan,
            ]);
        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
    }

    public function tambahpersyaratan(Request $request, $idlowongan)
    {
        $request->validate([
            'judulupload' => 'required',
        ]);


        try{
            $judulupload = $request->judulupload;

            $store = new uploadM;
            $store->idlowongan = $idlowongan;
            $store->judulupload = $judulupload;
            $store->save();
            if($store) {
                return redirect()->back()->with('toast_success', 'success');
            }
        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
    }

    public function hapuspersyaratan(Request $request, $idupload)
    {
        try{
            $destroy = uploadM::where('idupload', $idupload)->delete();
            if($destroy) {
                return redirect()->back()->with('toast_success', 'success');
            }
        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
    }

    public function updatepersyaratan(Request $request, $idupload)
    {
        $request->validate([
            'judulupload' => 'required',
        ]);


        try{
            $judulupload = $request->judulupload;

            $update = uploadM::where('idupload', $idupload)->update([
                'judulupload' => $judulupload,
            ]);
            if($update) {
                return redirect()->back()->with('toast_success', 'success');
            }
        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
    }
}
