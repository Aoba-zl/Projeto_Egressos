<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Egress extends Model
{
    use HasFactory;
        /**
     * Os atributos que são atribuíveis em massa.
     *
     * @var array
     */
    protected $fillable = [
        'cpf',
        'phone',
        'birthdate',
        'user_email',
        'status'
    ];
        /**
     * Os atributos que devem ser mutados para tipos nativos.
     *
     * @var array
     */
    protected $casts = [
        'birthdate' => 'date',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'user_email', 'email');
    }
}
