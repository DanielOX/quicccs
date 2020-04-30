<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\File;
use Storage;
class HomeController extends Controller
{
    public function index(Request $request)
    {
        $files = File::orderBy('id','desc')->paginate(25);
        if($request->has('q'))
        {
            $file = File::where('title','LIKE','%'.$request->q.'%')->paginate(25);
        }
        $categories = File::all()->unique('extension')->pluck('extension');
        return view('welcome')
              ->with('files',$files)
              ->with('categories',$categories);
    }

    public function findbyextension($ext)
    {
        $files = File::where('extension',$ext)->paginate(25);
        $categories = File::all()->unique('extension')->pluck('extension');
        return view('welcome')
              ->with('files',$files)
              ->with('categories',$categories);
    }

    public function list($file_id)
    {   
        $file = File::find($file_id);
        $categories = File::all()->unique('extension')->pluck('extension');
        $likeness = File::where('title','LIKE','%'.$file->title.'%')
                           ->orWhere('extension','LIKE','%'.$file->extension.'%')
                           ->get();

        return view('listing')
              ->with('likeness',$likeness)
              ->with('file',$file)
              ->with('categories',$categories);
    }
    public function downloadPage($id)
    {
        $file = File::findOrFail($id);
        $categories = File::all()->unique('extension')->pluck('extension');
        $likeness = File::where('title','LIKE','%'.$file->title.'%')
                           ->orWhere('extension','LIKE','%'.$file->extension.'%')
                           ->get();
        return view('download')
              ->with('likeness',$likeness)
              ->with('file',$file)
              ->with('categories',$categories);
        
    }
    public function download(Request $request)
    {
        $file = File::find($request->file_id);
        return response()->download(storage_path("app/public/$file->url"));
    }
}
