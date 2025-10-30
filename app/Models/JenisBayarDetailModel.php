<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisBayarDetailModel extends Model
{
    use HasFactory;
    protected $table        = "tbl_jenisbayardetail";
    protected $primaryKey   = 'idjenisbayardetail';
    protected $keyType      = 'string';
    public $incrementing    = false;
    protected $fillable     = ['idjenisbayardetail','idjenisbayar','idtingkat','idthnajaran','nominaljenisbayar'];

    //relasi ke table jenis bayar
    public function jenisbayar()
    {
        return $this->belongsTo('App\Models\JenisBayarModel','idjenisbayar');
    }

    //relasi ke table tingkat
    public function tingkat()
    {
        return $this->belongsTo('App\Models\TingkatrModel','idtingkat');
    }

    //relasi ke table tahun ajaran
    public function thnajaran()
    {
        return $this->belongsTo('App\Models\TahunAjaranModel','idthnajaran');
    }

    //relasi ke table siswa
    public function siswa()
    {
        return $this->belongsTo('App\Models\SiswaModel','idthnajaran');
    }
}
