<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImageDatasMysql extends Model
{
    protected $table = 'image_datas';
    protected $fillable = ['image_name', 'label'];
    protected $appends = [
        'modified','image_path'
    ];
    private $_picPath = 'public/upload/';
    public static function saveImageData($data){

    	$imageData = new ImageDatasMysql();
    	$imageData->label = $data['label'];
    	$imageData->image_name = $data['image_name'];
    	if ($imageData->save($data)) {
            return $imageData->id;
        } else {
            return false;
        }
    	return $data;
    }
    public function getModifiedAttribute()
    {	
    	$cropedImage= "modified_".$this->image_name;
        return $cropedImage;
    }
    public function getImagePathAttribute(){
    	$path = asset($this->_picPath);
    	return $path;

    }
}
