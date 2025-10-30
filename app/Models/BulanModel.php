<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BulanModel extends Model
{
    use HasFactory;
    protected $table        = "tbl_bulan";
    protected $primaryKey   = 'idbulan';
    protected $keyType      = 'string';
    public $incrementing    = false;
    protected $fillable     = ['idbulan','namabulan'];

    public function bayardetail()
    {
        // return $this->hasMany('App\Models\BayarDetailModel','idbulan');
        return $this->hasMany(BayarDetailModel::class, 'idbulan');
    }
}