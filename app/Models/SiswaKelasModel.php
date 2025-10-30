<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class SiswaKelasModel extends Model
{
    use HasFactory;
    protected $table        = "tbl_siswakelas";
    protected $primaryKey   = 'idsiswakelas';
    protected $keyType      = 'string';
    public $incrementing    = false;
    // protected $fillable     = ['idsiswakelas','idsiswa','idthnajaran','idkelas'];
    protected $fillable     = ['idsiswakelas','idsiswa','idkelasdetail'];

    public function siswa()
    {
        return $this->belongsTo('App\Models\SiswaModel','idsiswa');
    }

    // public function thnajaran()
    // {
    //     return $this->belongsTo('App\Models\TahunAjaranModel','idthnajaran');
    // }

    public function kelasdetail()
    {
        return $this->belongsTo('App\Models\KelasDetailModel','idkelasdetail');
    }
    
}