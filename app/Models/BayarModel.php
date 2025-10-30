<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//untuk format tanggal
use Illuminate\Support\Carbon;

class BayarModel extends Model
{
    use HasFactory;
    protected $table        = "tbl_bayar";
    protected $primaryKey   = 'idbayar';
    protected $keyType      = 'string';
    public $incrementing    = false;
    protected $fillable     = ['idbayar','idsiswa','iduser','tglbayar','idthnajaran'];

    //format tanggal
    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])
        ->translatedFormat('l, d F Y, H:i');
    }

    //relasi ke table siswa
    public function siswa()
    {
        return $this->belongsTo('App\Models\SiswaModel','idsiswa');
    }

    //relasi ke table user
    public function user()
    {
        return $this->belongsTo('App\Models\User','iduser');
    }

    //relasi ke table tahun ajaran
    public function thnajaran()
    {
        return $this->belongsTo('App\Models\TahunAJaranModel','idthnajaran');
    }

    //relasi ke table bayardetail
    public function bayardetail()
    {
        return $this->hasMany('App\Models\BayarDetailModel','idbayar');
    }

}
