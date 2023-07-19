<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class Smk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('akun', function (Blueprint $table) {
            $table->bigIncrements('idakun');
            $table->String('namaakun');
            $table->date('tanggallahir');
            $table->enum('jk', ['p', 'l']);
            $table->String('password');
            $table->String('hp');
            $table->String('email')->email()->unique();
            $table->enum('posisi', ['user', 'superadmin']);
            $table->timestamps();
        });

        Schema::create('pelamar', function (Blueprint $table) {
            $table->bigIncrements('idpelamar');
            $table->Integer('idakun');
            $table->Integer('idlowongan');
            $table->boolean('ket');
            $table->timestamps();
        });

        Schema::create('pelamarupload', function (Blueprint $table) {
            $table->bigIncrements('idpelamarupload');
            $table->Integer('idpelamar');
            $table->String('idupload');
            $table->String('namaberkas');
            $table->timestamps();
        });

        Schema::create('lowongan', function (Blueprint $table) {
            $table->bigIncrements('idlowongan');
            $table->String('judullowongan');
            $table->date('tanggalbuka');
            $table->date('tanggaltutup');
            $table->boolean('ket');
            $table->timestamps();
        });

        Schema::create('upload', function (Blueprint $table) {
            $table->bigIncrements('idupload');
            $table->Integer('idlowongan');
            $table->String('judulupload');
            $table->timestamps();
        });

        Schema::create('nilai', function (Blueprint $table) {
            $table->bigIncrements('idnilai');
            $table->Integer('idpelamar')->nullable();
            $table->Integer('idkriteria')->nullable();
            $table->Integer('iddetailkriteria')->nullable();
            $table->Integer('nilai')->nullable();
            $table->timestamps();
        });


        Schema::create('kriteria', function (Blueprint $table) {
            $table->bigIncrements('idkriteria');
            $table->String('judulkriteria')->unique();
            $table->enum('typedata', ['angka', 'pendidikan', 'manual']);
            $table->Integer('bobot');
            $table->timestamps();
        });

        Schema::create('detailkriteria', function (Blueprint $table) {
            $table->bigIncrements('iddetailkriteria');
            $table->Integer('idkriteria');
            $table->Integer('min')->nullable();
            $table->Integer('max')->nullable();
            $table->String('juduldetailkriteria')->nullable();
            $table->Integer('bobot');
            $table->timestamps();
        });



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
