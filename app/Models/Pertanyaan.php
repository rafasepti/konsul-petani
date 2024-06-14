<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pertanyaan extends Model
{
    // use HasFactory;
    protected $table = "pertanyaan";
    protected $primaryKey = 'id_pertanyaan';
    protected $fillable = ['id_pertanyaan','jawaban','pertanyaan','id_penyakit','id'];
}
