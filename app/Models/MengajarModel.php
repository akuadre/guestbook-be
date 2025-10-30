<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MengajarModel extends Model
{
    use HasFactory;
    protected $table        = "tbl_mengajar";
    protected $primaryKey   = 'idmengajar';
    protected $keyType      = 'string';
    public $incrementing    = false;
    protected $fillable     = ['idmengajar','idguru','idthnajaran','idmapeldetail'];

    public function guru()
    {
        return $this->belongsTo('App\Models\GuruModel','idguru');
    }

    public function thnajaran()
    {
        return $this->belongsTo('App\Models\TahunAjaranModel','idthnajaran');
    }

    public function mapeldetail()
    {
        return $this->belongsTo('App\Models\MapelDetailModel','idmapeldetail');
    }
}
