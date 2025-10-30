<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgamaModel extends Model
{
    use HasFactory;
    protected $table        = "tbl_agama";
    protected $primaryKey   = 'idagama';
    protected $keyType      = 'string';
    public $incrementing    = false;
    protected $fillable     = ['idagama', 'agama'];

    public function siswa()
    {
        return $this->hasMany('App\Models\SiswaModel','idagama');
    }

    public function guru()
    {
        return $this->hasMany('App\Models\GuruModel','idagama');
    }
}