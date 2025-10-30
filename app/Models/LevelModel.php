<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LevelModel extends Model
{
    use HasFactory;
    protected $table        = "tbl_level";
    protected $primaryKey   = 'idlevel';
    protected $keyType      = 'string';
    public $incrementing    = false;
    protected $fillable     = ['idlevel', 'level'];

    //relasi ke user
    public function user()
    {
        return $this->hasMany('App\Models\User', 'idlevel');
    }

}