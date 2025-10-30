<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TingkatModel extends Model
{
    use HasFactory;
    protected $table        = "tbl_tingkat";
    protected $primaryKey   = 'idtingkat';
    protected $keyType      = 'string';
    public $incrementing    = false;
    protected $fillable     = ['idtingkat', 'tingkat'];

    public function kelas()
    {
        return $this->hasMany('App\Models\KelasModel','idtingkat');
        //return $this->hasMany(Kelas::class);
    }

    public function jenisbayardetail()
    {
        return $this->hasMany('App\Models\JenisBayarDetailModel','idtingkat');
    }


    public function mapeldetail()
    {
        return $this->hasMany('App\Models\MapelDetailModel','idtingkat');
    }
}