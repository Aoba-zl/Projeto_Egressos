<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ImageController extends Controller
{
    public function image($image_path){
        $path = storage_path('app/public/uploads/' . $image_path);

        if (!File::exists($path)) {
            $path = storage_path('app/public/uploads/NoImageFound.png');
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        return response($file, 200)->header('Content-Type', $type);
    }
}
