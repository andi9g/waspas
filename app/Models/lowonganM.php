<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lowonganM extends Model
{
    use HasFactory;
    protected $table = 'lowongan';
    protected $primaryKey = 'idlowongan';
    protected $guarded = [];
}
