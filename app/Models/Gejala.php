<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gejala extends Model
{
    // use HasFactory;
    protected $table = "gejala";
    protected $primaryKey = 'id_gejala';
    protected $fillable = ['id_gejala','nama_gejala'];

    public function gejalas()
    {
        return $this->hasMany(Gejala::class);
    }
}
