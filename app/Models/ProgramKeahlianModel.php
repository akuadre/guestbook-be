<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramKeahlianModel extends Model
{
    use HasFactory;
    protected $table        = "tbl_programkeahlian";
    protected $primaryKey   = 'idprogramkeahlian';
    protected $keyType      = 'string';
    public $incrementing    = false;
    protected $fillable     = ['idprogramkeahlian','kodeprogramkeahlian','namaprogramkeahlian'];

    public function jurusan()
    {
        return $this->hasMany('App\Models\JurusanModel','idprogramkeahlian');
    }
}
