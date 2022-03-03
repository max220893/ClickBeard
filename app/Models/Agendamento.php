<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agendamento extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'especialidade_id',
        'usuario_id',
        'barbeiro_id',
        'data'
    ];

    public function especialidade()
    {
        return $this->belongsTo(Especialidade::class, 'especialidade_id');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    public function barbeiro()
    {
        return $this->belongsTo(Barbeiro::class, 'barbeiro_id');
    }
}
