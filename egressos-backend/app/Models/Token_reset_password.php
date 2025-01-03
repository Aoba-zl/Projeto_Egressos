<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Token_reset_password extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'token',
        'is_valid'
    ];

}
