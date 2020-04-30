@extends('voyager::master')

@section('page_header')

  <h1 class="page-title">
        <i class="voyager-files"></i>
        <p> {{ 'Files' }}</p>
    </h1>
    <span class="page-description">{{ 'Create New Files' }}</span>

@endsection

@section('content')
    <div class="container">
        <form action="{{route('file.store')}}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
        <div class="row">
            <div class="col-sm-6">
                <label for="">Enter File Title</label>
                <input type="text" name="title" class="form-control" required placeholder="File Title" />                
            </div>
            <div class="col-sm-6">
                <label for="">Upload The File</label>
                <input type="file" required name="file"/>

            </div>
            <div class="col-sm-10">
                <label for="">A little detail about the file for users</label>
                <textarea style="max-width:91%" rows="10" required class="form-control" 
                          placeholder="File Description" name="description"></textarea>
            </div>            
        </div>
        <div class="row">
                <div class="col-sm-9 col-md-9">
                    <label for="">Input Images ( You can add multiple images, atleast 1 image is required. ) Use ctrl + shift to select many files </label>
                    <input type="File" required multiple name="images[]"/>
                </div>
        </div>    
        <div class="row">
            <div class="col-sm-9 col-md-9">
                <button class="btn btn-success pull-right" type="submit">
                    <i class="voyager-plus"></i> Add File
                </button>
            </div>
        </div>
    </form>

    </div>    
@stop