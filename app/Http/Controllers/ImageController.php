<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ImageData;
use App\Models\ImageDatasMysql;
use App\Helpers\CommonHelper;
class ImageController extends Controller
{
    public function saveImage(Request $request)
    {
    	 $data = [];
    	 try {
    	 	$data['image_name'] = CommonHelper::saveBase64Image($request->image_name,$request->x, $request->y, $request->width, $request->height);
             $data['label'] = $request->label;
             $data['type']=2;
    	 	//$save = ImageDatasMysql::saveImageData($data); // for mysql db
    	 	$save = ImageData::saveImageData($data); // for mongo db
    	 	return response()->json([
                'success' => true,
                'error' => '',
                'data' => $save,
            ], 200);
    	 }  
    	 catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'invalid_request',
                'message' => "{$e->getMessage()}",
            ], 401);
        }

    }
    public function getAllImages(Request $request){
    	$data = [];
    	 try {
    	 	//$data =  ImageDatasMysql::orderBy('created_at', 'desc')->get(); //for mysql 

    	 	$data =  ImageData::orderBy('_id', 'DESC')->get();
    	 	return response()->json([
                'success' => true,
                'error' => '',
                'data' => $data,
            ], 200);
    	 }
    	 catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'invalid_request',
                'message' => "{$e->getMessage()}",
            ], 401);
        }

    }
    public fuction uploadFile(Request $request){

        

    }

}
