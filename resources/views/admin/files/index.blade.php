@extends('voyager::master')

@section('page_header')

  <h1 class="page-title">
        <i class="voyager-files"></i>
        <p> {{ 'Files' }}</p>
    </h1>
    <span class="page-description">{{ 'Files Index' }}</span>

@endsection

@section('content')
<div class="container">
        <a class="btn btn-success pull-right" href="{{route('file.create')}}"> <i class="voyager-plus"></i> Add Files </a>


        <table class="table table-bordered table-striped">
            <thead>
                <th>title</th>
                <th>url</th>
                <th>name</th>
                <th>Size</th>
                <th>extension</th>
                <th>Images</th>
                <th>created</th>
                <th>Delete</th>
            </thead>
            <tbody>
                @foreach($files as $file)
                <tr>
                    <td>{{$file->title}}</td>
                    <td>{{$file->url}}</td>
                    <td>{{$file->name}}</td>
                    <td>{{$file->size}}</td>
                    <td>{{$file->extension}}</td>

                <td> 
                    @foreach($file->images() as $image)
                         <img src='{{asset("storage/$image->url")}}' style="width:60px;height:40px;object-fit:cover"/>;
                     @endforeach
                </td>
                    <td>{{$file->created_at->diffForHumans()}}</td>
                <td>
                <a style="text-decoration:none" href="{{ route('file.delete',['id' => $file->id]) }}" class="btn btn-danger"> <i class="voyager-trash"></i> Delete</a>
                </td>
                </tr>
                @endforeach 
            </tbody>
            {!! $files->render() !!}
        </table>
</div>

@stop