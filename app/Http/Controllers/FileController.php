<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\File;
use App\Image;
class FileController extends Controller
{
    // Admin:: Display All Files 
    public function index()
    {
        $files = File::orderBy('id','desc')->paginate(100);
        return view('admin.files.index')
                ->with('files',$files);
    }

    // Admin:: Create New Files 
    public function create()
    {
        return view('admin.files.create');
    }

    // Admin:: Store New Files 
    public function store(Request $request)
    {   
        // dd($request->all());
        $file = new File();
        $ufile = $request->file;
        $file->name = $ufile->getClientOriginalName();
        $file->extension = strtolower($ufile->getClientOriginalExtension());
        $file_size = $ufile->getSize();
        $file->size = number_format($file_size/ 1048576,2);
        $file->title = $request->title;
        $file->description = $request->description;
        $file->url = $ufile->storeAs('files',$file->name,'public');
        $file->save();

        // dd($file->id);

        foreach($request->images as $image)
        {
            $newImage = new Image();
            $imageFile = $image->storeAs('file_images',time().'.'.$image->getClientOriginalExtension(),'public');
            $newImage->file_id = $file->id;
            $newImage->url = $imageFile;
            $newImage->save();
        }
        // echo '<img src="'.asset("storage/$imageFile").'"/>';

        // dd($request->all());

        session()->flash('message',"New File Added");
        session()->flash("alert-type","success");
        return redirect()->route('file.index');
    }

    // Admin:: Delete File 
    public function delete($id)
    {
        $file = File::find($id);
        if($file)
        {
            $images = Image::where('file_id',$file->id)->delete();
            $file->delete();
            session()->flash('message',"File Deleted");
            session()->flash("alert-type","success");    
        }
        else 
        {
            session()->flash('message',"File Doesnot Exist");
            session()->flash("alert-type","error");    
        }
        return redirect()->route('file.index');
    }
    


}
