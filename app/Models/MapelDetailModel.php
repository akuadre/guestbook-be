<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MapelDetailModel extends Model
{
    use HasFactory;
    protected $table        = "tbl_mapeldetail";
    protected $primaryKey   = 'idmapeldetail';
    protected $keyType      = 'string';
    public $incrementing    = false;
    protected $fillable     = ['idmapeldetail','idmapel','idtingkat'];

    public function mapel()
    {
        return $this->belongsTo('App\Models\MapelModel','idmapel');
    }

    public function tingkat()
    {
        return $this->belongsTo('App\Models\TingkatModel','idtingkat');
    }
}
