<?php

namespace App\Http\Controllers;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ImageController extends Controller
{
    public static function compressImage($imagePath)
    {
        $fullPath = storage_path('app/public/' . $imagePath);
    
        $manager = new ImageManager(new Driver());
        $image = $manager->read($fullPath);
    
        $image->toJpeg(75)->save($fullPath);
    }
}
