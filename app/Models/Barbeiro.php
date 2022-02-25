<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barbeiro extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'nome',
        'idade',
        'data_contratacao'
    ];

    public function especialidades()
    {
        return $this->belongsToMany(Especialidade::class, 'barbeiros_especialidades', 'especialidade_int', 'barbeiro_id');
    }
}
