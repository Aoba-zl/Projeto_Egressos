<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Course extends Model
{
    use HasFactory;
            /**
     * Os atributos que são atribuíveis em massa.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'type_formation',
    ];

    public static function checkAndSaveCourse(Request $request){
        $request->validate([
            "name" => "required|string"
            ,"type_formation" => "required|string"
        ]);

        $repeated = Course::select('*')
            ->where('name',$request->name)
            ->where('type_formation',$request->type_formation)
            ->first();

        if($repeated == null){
            $storedCourse = Course::create([
                'name' => $request->name 
                ,'type_formation' => $request->type_formation
            ]);

            return $storedCourse;
        }

        return $repeated;
    }

}
