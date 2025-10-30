<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisBayarModel extends Model
{
    use HasFactory;
    protected $table        = "tbl_jenisbayar";
    protected $primaryKey   = 'idjenisbayar';
    protected $keyType      = 'string';
    public $incrementing    = false;
    protected $fillable     = ['idjenisbayar','kodejenisbayar','jenisbayar','periode'];

    // //relasi ke table periode
    // public function periode()
    // {
    //     return $this->belongsTo('App\Models\PeriodeModel','idperiode');
    // }


    //relasi ke table jenisbayardetail
    public function jenisbayardetail()
    {
        return $this->hasMany('App\Models\JenisBayarModel','idjenisbayar');
    }
}