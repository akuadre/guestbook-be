<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GuruModel extends Model
{
    use HasFactory;
    protected $table        = "tbl_guru";
    protected $primaryKey   = 'idguru';
    protected $keyType      = 'string';
    public $incrementing    = false;
    protected $fillable     = ['idguru','nip','nuptk','namaguru','tmplahir','tgllahir','jk','alamat','idagama','tlprumah','hpguru','photoguru','statusaktif'];

    public function agama()
    {
        return $this->belongsTo('App\Models\AgamaModel','idagama');
    }

    public function kelasdetail()
    {
        return $this->hasMany('App\Models\KelasDetailModel','idguru');
    }

    public function mengajar()
    {
        return $this->hasMany('App\Models\MengajarModel','idguru');
    }
}
