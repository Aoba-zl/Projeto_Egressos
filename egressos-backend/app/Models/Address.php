<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Address extends Model
{
    use HasFactory;
         /**
     * Os atributos que são atribuíveis em massa.
     *
     * @var array
     */
    protected $fillable = [
        'cep',
        'num_porta',
    ]; 
    
    public static function saveAddress(Request $request){
        $address = Address::select()->where('cep',$request->address['cep'])
                        ->where('num_porta',$request->address['num_porta'])
                        ->first();
        
        if($address == null){
            $address = Address::create([
                "cep" => $request->address['cep']
                ,"num_porta" => $request->address['num_porta']
            ]);
        }

        return $address;
    }
}
