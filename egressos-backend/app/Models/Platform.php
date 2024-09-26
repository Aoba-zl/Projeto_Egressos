<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Platform extends Model
{
    use HasFactory;
    /**
     * Os atributos que são atribuíveis em massa.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    public static function checkAndSavePlatform(Request $request){
        $request->validate([
            'name' => 'required|string'
        ]);

        $repeated = Platform::select('*')
            ->where('name',$request->name)
            ->first();

        if($repeated == null){
            $stored = Platform::create([
                'name' => $request->name
            ]);

            return $stored;
        }

        return $repeated;
    }
}
