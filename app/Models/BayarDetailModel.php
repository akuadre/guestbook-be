<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//untuk format tanggal
use Illuminate\Support\Carbon;

class BayarDetailModel extends Model
{
    use HasFactory;
    protected $table        = "tbl_bayardetail";
    protected $primaryKey   = 'idbayardetail';
    protected $keyType      = 'string';
    public $incrementing    = false;
    // protected $fillable     = ['idbayardetail','idbayar','idperiode','idbulan','nominalbayar','updated_at','created_at'];
    protected $fillable     = ['idbayardetail','idbayar','idjenisbayardetail','idbulan','nominalbayar'];
    
    //format tanggal
    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])
        ->translatedFormat('l, d F Y, H:i');
    }

    //relasi ke table bayar
    public function bayar()
    {
        return $this->belongsTo('App\Models\BayarModel','idbayar');
    }

    // public function bayar()
    // {
    //     return $this->hasOne('App\Models\BayarModel','idbayar');
    // }

    public function jenisbayardetail()
    {
        return $this->belongsTo('App\Models\JenisBayarDetailModel','idjenisbayardetail');
    }

    public function bulan()
    {
        return $this->belongsTo('App\Models\BulanModel','idbulan');
    }

}
