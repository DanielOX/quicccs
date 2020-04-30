<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

        <!-- Icons -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        @include('styles')

        </head>
    <body>
        {{-- NAVIGATION BAR --}}

        <nav class="navbar navbar-default" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <a class="navbar-brand" href="#">LazerCut</a>
            </div>
          
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <div class="col-sm-8 col-md-8" >
                  <form class="navbar-form"  action="{{route('home')}}" method="get" role="search">
                  <div class="input-group" style="width:80%">
                      <input type="text" class="form-control" placeholder="Search" name="q">
                      <div class="input-group-btn">
                          <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                      </div>
                  </div>
                  </form>
              </div>
              @if(Auth::user() && Auth::user()->hasRole('admin'))
              <div class="col-sm-4 col-md-4" >
                <div class="input-group pull-right">
                <a class="btn btn-info" href="{{ route('file.index') }}">Admin</a>
                </div>
             </div>
             @endif
            </div><!-- /.navbar-collapse -->
          </nav>

          
        {{-- NAVIGATION BAR END --}}
 
          <div class="container row">
                <div class="col-sm-2 col-md-2">
                <ul class="list-group" style="width:80%">
                        @foreach($categories as $category)                       
                            <li class="list-group-item" >
                                <a href="{{route('home.extension',['extension' => $category])}}">{{strtoupper($category)}}</a>
                            </li>
                        @endforeach
 
                </ul>
                </div>
                <div class="col-sm-10 col-md-10">
                        <div class="container">
                            <div class="row">
                                @if($files->count() > 0)
                                @foreach($files as $file)
                                <a href="{{ route('list.file',['file_id' => $file->id]) }}">
                                        <div class="col-md-3">
                                                <div class="ibox">
                                                    <div class="ibox-content product-box">
                                                        <div class="product-imitation" style="background-image:url({{asset("storage/")}}/{{$file->firstImage()}})">
                                                        </div>
                                                        <div class="product-desc">
                                                            <span class="product-price">
                                                                .{{ $file->extension }}
                                                            </span>
                                                            <small class="text-muted">
                                                                    .{{ $file->extension }}
                                                            </small>
                                                            <a href="{{ route('list.file',['file_id' => $file->id]) }}" class="product-name">
                                                                {{ $file->title }}
                                                            </a>
                                        
                                                            <div class="small m-t-xs">
                                                                {{ \Illuminate\Support\Str::limit($file->description, 30, $end='...') }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>        
        
                                </a>
                                @endforeach
                                @else 

                                <p>No Files Available</p>

                                @endif
                                <div class="pull-right">
                                        {!! $files->render() !!}
                                </div>
                            </div>
                        </div>
                        
                </div>
          </div>
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
    </body>
</html>
