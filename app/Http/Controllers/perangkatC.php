<?php

namespace App\Http\Controllers;

use App\Models\perangkatM;
use Illuminate\Http\Request;
use Hash;

class perangkatC extends Controller
{
    public function index(Request $request)
    {
        // dd('berhasil');
        $post = empty($request->keyword)?"":$request->keyword;

        // $ruangan = ruanganM::select('idruangan', 'nama_ruangan')->get();

        $perangkat = perangkatM::where('namaperangkat','LIKE',"$post%")->get();

        return view('pages.pagesPerangkat', [
            'perangkat' => $perangkat,
            // 'ruangan' => $ruangan,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'namaperangkat' => 'required',
        ]);

        // try {
            $namaperangkat = $request->namaperangkat;

            $lokasi = str_replace(" ", "", $namaperangkat);
            // dd(public_path('scan')
            

            $ambil = [
                'ip' => '192.168.0.1',
            ];
            $ambil = json_encode($ambil);
            $ipJson = json_decode($ambil,TRUE);

            $ip = $ipJson["ip"];

            $key_post = str_replace("/", "", Hash::make('perangkat')).str_replace("/", "", Hash::make($namaperangkat));
            $key_post = str_replace("$","", $key_post);
            $key_post = str_replace(".","", $key_post);
            $key_post = str_replace(",","", $key_post);

            $computerId = str_replace("/","", $_SERVER['HTTP_USER_AGENT']);
            $computerId = str_replace(" ","", $computerId);
            $computerId = str_replace("$","", $computerId);
            $computerId = str_replace("%","", $computerId);
            $computerId = str_replace(".","", $computerId);
            $computerId = str_replace(",","", $computerId);
            $computerId = str_replace(";","", $computerId);
            $computerId = str_replace("(","", $computerId);
            $computerId = str_replace(")","", $computerId);
            $computerId = strtolower($computerId);
            
            $idperangkat = uniqid().strtotime(date("Y-m-d H:i:s"));
            // dd(public_path().'/perangkat/');
            
            $tambah = new perangkatM;
            $tambah->idperangkat = $idperangkat;
            $tambah->namaperangkat = $namaperangkat;
            $tambah->ip = $ip;
            $tambah->key_post = $key_post;
            $tambah->computerId = $computerId;
            $tambah->save();

            if($tambah) {
                $location = public_path().'/perangkat/'.$idperangkat;

                if(file_exists($location."Container.php")){
                    unlink($location."Container.php");
                }

                $myfile2 = fopen($location."Container.php", "w+") or die("Unable to open file!");

                $txt2 = "";
                
                fwrite($myfile2, $txt2);
                fclose($myfile2);
                chmod($location."Container.php", 0777);


                return redirect()->back()->with('toast_success', 'perangkat berhasil ditambahkan');
            }else {
                return redirect()->back()->with('toast_error', 'perangkat gagal ditambahkan');
            }

        // } catch (\Throwable $th) {
        //     return redirect()->back()->with('toast_error', '(Error) - pastikan perangkat tidak terdaftar sebelumnya atau tidak duplikat!')->withInput();
        // }

    }


    public function reset(Request $request, $id)
    {
        try{
            $ambil = file_get_contents('https://api.ipify.org/?format=json');
            $ipJson = json_decode($ambil,TRUE);
            $ip = $ipJson["ip"];

            $update = perangkatM::where('idruangan_master', $id)->update([
                'ip' => $ip,
            ]);

            if($update) {
                return redirect()->back()->with('success', 'reset ip berhasil')->withInput();
            }
        
        }catch(\Throwable $th){
            return redirect('/master')->with('toast_error', 'Terjadi kesalahan');
        }
    }


    public function destroy(perangkatM $master, $idperangkat)
    {
        try {
            
            $delete = $master->where('idperangkat', $idperangkat)->delete();
            if ($delete) {
                return redirect()->back()->with('toast_success', 'Penghapusan Berhasil');
            }

        } catch (\Throwable $th) {
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
    }
}
