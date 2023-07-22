<?php

namespace App\Http\Controllers;

use App\Models\akunM;
use App\Models\lowonganM;
use App\Models\pelamarM;
use App\Models\kriteriaM;
use App\Models\Ranking;
use Illuminate\Http\Request;
use Hash;

class umumC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home(Request $request)
    {
        $lowongan = lowonganM::where('ket', true)->orderBy('idlowongan', 'asc')->get();

        $pelamar = akunM::where('posisi', '!=', 'superadmin')->count();
        $low = lowonganM::where('ket', '!=', '0')->count();
        $kriteria = kriteriaM::count();
        return view('pages.pagesHome', [
            'lowongan' => $lowongan,
            'pelamar' => $pelamar,
            'low' => $low,
            'kriteria' => $kriteria,
        ]);
    }
    public function index()
    {
        return view('pages.pageslogin');
    }

    public function pelamar(Request $request)
    {
        $idlowongan = empty($request->lowongan)?"":$request->lowongan;

        $lowongan = lowonganM::where('idlowongan', 'like', "$idlowongan%")
        ->where('ket', true)
        ->where('umum', true)
        ->get();
        $data = [];
        foreach ($lowongan as $low) {
            $ranking = Ranking::join('pelamar', 'pelamar.idpelamar', 'ranking.idpelamar')
            ->join('akun', 'akun.idakun', 'pelamar.idakun')
            ->where('ranking.idlowongan', $low->idlowongan)
            ->where('akun.posisi', '!=', 'superadmin')
            ->orderBy('ranking.ranking', 'desc')
            ->select('pelamar.*', 'ranking.*', 'akun.namaakun')
            ->get();
            $dataPelamar = [];
            $no = 1;
            foreach ($ranking as $ran) {
                $dataPelamar[] = [
                    'no' => $no++,
                    'namapelamar' => $ran->namaakun,
                ];
            }
            $data[] = [
                'judullowongan' => $low->judullowongan,
                'pelamar' => $dataPelamar,
            ];
        }
        $lowongan = lowonganM::where('ket', true)
        ->where('umum', true)
        ->get();
        return view('pages.datapelamar', [
            'data' => $data,
            'lowongan' => $lowongan,
            'idlowongan' => $idlowongan,
        ]);
    }
    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('login');
    }

    public function proses(Request $request)
    {
        $request->validate([
            'email'=>'required',
            'password'=>'required',
        ]);

        try{
            $email = $request->email;
            $password = $request->password;

            $cek = akunM::where('email', $email);
            if($cek->count() === 1) {
                $data = $cek->first();
                if(Hash::check($password, $data->password)) {
                    $request->session()->put('login', true);
                    $request->session()->put('email', $data->email);
                    $request->session()->put('idakun', $data->idakun);
                    $request->session()->put('hp', $data->hp);
                    $request->session()->put('namaakun', $data->namaakun);
                    $request->session()->put('posisi', $data->posisi);

                    return redirect('home')->with('success', 'WELCOME, '.$data->namaakun);
                }
            }

            return redirect()->back()->with('toast_error', 'email atau password tidak benar');
        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'email atau password tidak benar');
        }
    }

    public function register(Request $request)
    {

        return view('pages.pagesregister');
    }

    public function daftar(Request $request)
    {
        $request->validate([
            'email' => 'required|unique:akun,email',
            'namaakun' => 'required',
            'jk' => 'required',
            'tanggallahir' => 'required',
            'password1' => 'required|same:password2|min:6',
            'hp' => 'required',
        ]);


        try{
            $email = $request->email;
            $namaakun = $request->namaakun;
            $jk = $request->jk;
            $tanggallahir = $request->tanggallahir;
            $password = Hash::make($request->password1);
            $hp = $request->hp;
            $posisi = 'user';

            $store = new akunM;
            $store->email = $email;
            $store->namaakun = $namaakun;
            $store->jk = $jk;
            $store->tanggallahir = $tanggallahir;
            $store->password = $password;
            $store->hp = $hp;
            $store->posisi = $posisi;
            $store->save();
            if($store) {
                return redirect('login')->with('success', 'Pendaftaran Berhasil, Silahkan login');
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
     * @param  \App\Models\akun  $akun
     * @return \Illuminate\Http\Response
     */
    public function show(akun $akun)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\akun  $akun
     * @return \Illuminate\Http\Response
     */
    public function edit(akun $akun)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\akun  $akun
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, akun $akun)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\akun  $akun
     * @return \Illuminate\Http\Response
     */
    public function destroy(akun $akun)
    {
        //
    }
}
