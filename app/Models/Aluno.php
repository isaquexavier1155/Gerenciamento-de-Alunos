<?php

// app/Models/Aluno.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    protected $fillable = [
        'nome',
        'email',
        'telefone',
        'cidade',
        'dia_aula',
        'horario_aula',
        'data_pagamento',
        'status_pagamento',
    ];

    // Adicione outras propriedades ou métodos conforme necessário
}
