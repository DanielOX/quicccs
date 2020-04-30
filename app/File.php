<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Image;
class File extends Model
{
    public function images()
    {
        return Image::where('file_id',$this->id)->get(); 
    }
    public function firstImage()
    {
        return Image::where('file_id',$this->id)->first()->url; 
    }
}
