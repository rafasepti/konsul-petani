<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenyakitSolusi extends Model
{
    // use HasFactory;
    protected $table = "penyakit_solusi";
    protected $primaryKey = 'id_penyakit_solusi';
    protected $fillable = ['id_penyakit_solusi','solusi','id_penyakit'];

    public function penyakit()
    {
        return $this->belongsTo(Penyakit::class);
    }
}
