<?php
namespace App\Helpers;

use Image;


class CommonHelper
{
    private $_logoPicResizes = ['modified'];

    public static function generate_random_string($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public static function savePic($profileFiles, $folder)
    {
        $val = [];
        foreach($profileFiles as $profileFile)
        {
            $extension = $profileFile->getClientOriginalExtension();
            $fileName = rand(11111, 99999) . '_' . time() . '.' . $extension;
            $profileFile->move(public_path($folder), $fileName);
            $val[]=$fileName;
        }
        return $val;

    }
    public static function saveBase64Image($base64, $x=null ,$y=null,$width=null,$height=null){

        $image_parts = explode(";base64,", $base64);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $safeName =  rand(11111, 99999) . '_' . time() .'.jpg';
        $success = file_put_contents(public_path().'/upload/'.$safeName, $image_base64);
        $img = Image::make(public_path('/upload/'.$safeName));
        $croppath = public_path('/upload/'.'modified_'.$safeName);
        $img->crop($width, $height, $x, $y);
        $img->save($croppath);
        return  $safeName;

    }

}



