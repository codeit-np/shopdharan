<?php 

namespace App\Helpers;

class SavePhoto {
   
    public static function SaveImage($file) {
        if($file){
            $filename = time() . '.' . $file->getClientOriginalName();
            $file->move('images',$filename);
            return $filename;    
        }else{
            return null;
        }
    }
    public static function ImageLink($filename){
        return asset('images/'.$filename);
    }
}