<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RuanganModel extends Model
{
    use HasFactory;
    protected $table        = "tbl_ruangan";
    protected $primaryKey   = 'idruangan';
    protected $keyType      = 'string';
    public $incrementing    = false;
    protected $fillable     = [
                                'idruangan',
                                'koderuangan',
                                'namaruangan',
                                'lokasi',
                                'lebar',
                                'panjang',
                                'kondisi',
                            ];


    public function kelasdetail()
    {
        return $this->hasMany('App\Models\KelasDetailModel','idruangan');
    }
}
