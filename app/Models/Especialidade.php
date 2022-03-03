<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especialidade extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'nome',
    ];

    public function barbeiros()
    {
        return $this->belongsToMany(Barbeiro::class, 'barbeiros_especialidades',  'especialidade_id', 'barbeiro_id');
    }
}
