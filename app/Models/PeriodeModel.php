<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeriodeModel extends Model
{
    use HasFactory;
    protected $table        = "tbl_periode";
    protected $primaryKey   = 'idperiode';
    protected $keyType      = 'string';
    public $incrementing    = false;
    protected $fillable     = ['idperiode','periode'];


    public function bayardetail()
    {
        return $this->hasMany('App\Models\BayarDetailModel','idperiode');
    }

    public function jenisbayar()
    {
        return $this->hasMany('App\Models\JenisBayarModel','idperiode');
    }
}
