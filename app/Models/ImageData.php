<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Http\Request;
use App\Helpers\CommonHelper;
use File;

class ImageData extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'image_datas';
    protected $appends = [
        'modified','image_path',
    ];
     protected $fillable = [
       'type', 'label', 'image_name',
    ];
    private $_picPath = 'public/upload/';
    public static function saveImageData($data){

    	$imageData = new ImageData();

    	$imageData->label = $data['label'];
    	$imageData->image_name = $data['image_name'];
        $imageData->type = $data['type'];
    	if ($imageData->save()) {
            return $imageData->_id;
        } else {
            return false;
        }

    }
    public function getModifiedAttribute()
    {
        if($this->type==2){
            $cropedImage= "modified_".$this->image_name;
            return $cropedImage;
        }else{
            return null;
        }
    	
    }
    public function getImagePathAttribute(){
    	$path = asset($this->_picPath);
    	return $path;
    	
    }

}
