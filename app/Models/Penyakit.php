<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyakit extends Model
{
    // use HasFactory;
    protected $table = "penyakit";
    protected $primaryKey = 'id_penyakit';
    protected $fillable = ['id_penyakit','nama_penyakit','definisi','id_gejala'];

    public function gejala()
    {
        return $this->belongsTo(Gejala::class);
    }

    public function penyakit_solusis()
    {
        return $this->hasMany(PenyakitSolusi::class, 'id_penyakit');
    }
}
