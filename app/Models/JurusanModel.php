<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JurusanModel extends Model
{
    use HasFactory;
    protected $table        = "tbl_jurusan";
    protected $primaryKey   = 'idjurusan';
    protected $keyType      = 'string';
    public $incrementing    = false;
    protected $fillable     = ['idjurusan','kodejurusan','namajurusan','idprogramkeahlian'];

    public function kelas()
    {
        return $this->hasMany('App\Models\KelasModel','idjurusan');
    }

    public function programkeahlian()
    {
        return $this->belongsTo('App\Models\ProgramKeahlianModel','idprogramkeahlian');
    }

}