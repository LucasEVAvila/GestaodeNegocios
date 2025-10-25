<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'sobrenome',
        'cpf',
        'email',
        'cep',
        'logradouro',
        'bairro',
        'cidade',
        'uf'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
