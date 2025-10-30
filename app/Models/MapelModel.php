<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MapelModel extends Model
{
    use HasFactory;
    protected $table        = "tbl_mapel";
    protected $primaryKey   = 'idmapel';
    protected $keyType      = 'string';
    public $incrementing    = false;
    protected $fillable     = ['idmapel','namamapel','idjurusan'];

    public function mapeldetail()
    {
        return $this->hasMany('App\Models\MapelDetailModel','idmapel');
    }
}
