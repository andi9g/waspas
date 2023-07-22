<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|

*/
Route::get('/', function(){
    return redirect('login');
});
Route::get('/logout', 'umumC@logout');
Route::get('/login', 'umumC@index');
Route::get('/datapelamar', 'umumC@pelamar');
Route::post('/login', 'umumC@proses')->name('login.proses');
Route::get('/register', 'umumC@register');
Route::post('/register', 'umumC@daftar')->name('daftar.akun');


Route::middleware(['GerbangLogin'])->group(function () {

    // home
    Route::get('/home', 'umumC@home');
    Route::post('/home/{idlowongan}', 'pelamarC@tambahpelamar')->name('tambah.pelamar');

    //lamaran
    Route::get('lamaran', 'pelamarC@lamaran');
    Route::post('lamaran/upload/{idupload}/{idpelamar}', 'pelamarC@upload')->name('upload.berkas');
    Route::post('lamaran/hapusberkas/{idpelamarupload}', 'pelamarC@hapus')->name('hapus.berkas');


    //pelamar
    Route::get('pelamar', 'pelamarC@pelamar');
    Route::get('pelamar/{idlowongan}', 'pelamarC@lowongan')->name('pelamar.lowongan');
    Route::post('pelamar/{idlowongan}', 'pelamarC@ket')->name('pelamar.lowongan.ket');

    //nilai
    Route::get('nilai', 'nilaiC@nilai');
    Route::get('nilai/{idlowongan}', 'nilaiC@peserta')->name('nilai.peserta');
    Route::get('nilai/{idlowongan}/{idpelamar}', 'nilaiC@penilaian')->name('penilaian.peserta');
    Route::post('nilai/{idlowongan}/{idpelamar}/{idkriteria}', 'nilaiC@penilaianpeserta')->name('penilaian.kriteria');

    //ranking
    Route::get('ranking', 'rankingC@index');
    Route::get('ranking/{idlowongan}', 'rankingC@ranking')->name('ranking.peserta');
    Route::post('ranking/{idlowongan}/umum', 'rankingC@umum')->name('ranking.umum');

    Route::get('cetak/ranking/{idlowongan}', 'rankingC@cetak')->name('laporan.ranking');

    // kriteria
    Route::get('kriteria', 'kriteriaC@index');
    Route::post('kriteria/bobot/{idkriteria}', 'kriteriaC@bobot')->name('update.bobot');
    Route::post('kriteria', 'kriteriaC@store')->name('tambah.kriteria');
    Route::delete('kriteria/hapus/{idkriteria}', 'kriteriaC@hapuskriteria')->name('hapus.kriteria');
    Route::get('kriteria/detail/{idkriteria}', 'kriteriaC@detailkriteria')->name('lihat.detailkriteria');
    Route::post('kriteria/detail/{idkriteria}', 'kriteriaC@tambahdetailkriteria')->name('tambah.detailkriteria');
    Route::put('kriteria/detail/{idkriteria}/update/{iddetailkriteria}', 'kriteriaC@updatedetailkriteria')->name('update.detailkriteria');
    Route::delete('kriteria/detail/{idkriteria}/hapus', 'kriteriaC@hapusdetailkriteria')->name('hapus.detailkriteria');


    // lowongan
    Route::get('lowongan', 'lowonganC@index');
    Route::post('lowongan', 'lowonganC@store')->name('tambah.lowongan');
    Route::delete('lowongan/hapus/{idlowongan}', 'lowonganC@hapus')->name('hapus.lowongan');
    Route::put('lowongan/edit/{idlowongan}', 'lowonganC@edit')->name('edit.lowongan');
    Route::post('lowongan/ket/{idlowongan}', 'lowonganC@ket')->name('ket.lowongan');

    Route::get('lowongan/berkas/{idlowongan}', 'lowonganC@persyaratan')->name('berkas.upload');
    Route::post('lowongan/berkas/{idlowongan}/tambah', 'lowonganC@tambahpersyaratan')->name('tambah.persyaratan');
    Route::put('lowongan/berkas/{idupload}/update', 'lowonganC@updatepersyaratan')->name('update.persyaratan');
    Route::delete('lowongan/berkas/{idupload}/hapus', 'lowonganC@hapuspersyaratan')->name('hapus.persyaratan');


    Route::post('ubahpassword', 'indexC@ubahpassword')->name('ubah.password');
});
