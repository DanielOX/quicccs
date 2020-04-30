<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- jQuery -->
        <script src="{{URL::to('/')}}/jquery.min.js"></script>
        <!-- Fonts -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <!-- Icons -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <!-- SmoothProducts Gallery js  -->
        <script src="{{URL::to('/')}}/smoothproduct.min.js"></script>
        <!-- SmoothProducts Gallery css  -->        
        <link rel="stylesheet" href="{{URL::to('/')}}/smoothproduct.min.css">
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
                  <div class="input-group" style="width:100%">
                      <input type="text" class="form-control" placeholder="Search" name="q">
                      <div class="input-group-btn">
                          <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                      </div>
                  </div>
                  </form>
              </div>
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
                <div class="col-sm-10 col-md-10" style="background-color:white">
                    <div class="row">
                        <div class="col-sm-6 col-md-6" style="padding:12px 24px">
                            <div class="sp-wrap">
                                @foreach($file->images() as $image)
                                    <a href='{{asset("storage/$image->url")}}'><img style="height:150px" src='{{asset("storage/$image->url")}}' alt=""></a>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                                <h4 style="font-weight:bold">Thank you for downloading <strong>{{ $file->title }}</strong></h4>

                        <h2>{{$file->title}}</h2>
                        <p><strong>Format</strong>:
                                <span class="badge">
                                        .{{ $file->extension }}
                                </span>
                        </p>
                        <p>
                            {{ $file->description }}
                        </p>
                            <strong>size:</strong> {{ $file->size  }} MB <span id="counter" class="badge"></span>
                            <br />
                            <button class="btn btn-info" onclick="counterStart()">Download</button> 
                        </div>

                    <form style="display:hidden" id="fetcher" action="{{route('file.download')}}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="file_id" value="{{$file->id}}">
                    </form>

                    
 
                    </div>
        

                    <div class="likeness">
                            <hr>
                                <h4> More Files Like <strong>{{ $file->title }}</strong></h4>
                            <hr>
    
                             @foreach($likeness as $like)
                             <div class="col-md-3">
                                     <a href="{{ route('list.file',['file_id' => $like->id]) }}">
                                         <div class="ibox">
                                             <div class="ibox-content product-box" style="border-top:0px">
                                                 <div class="product-imitation" style="background-image:url({{asset("storage/")}}/{{$like->firstImage()}})">
                                                 </div>
                                                 <div class="product-desc">
                                                     <span class="product-price">
                                                         .{{ $like->extension }}
                                                     </span>
                                                     <small class="text-muted">
                                                             .{{ $like->extension }}
                                                     </small>
                                                     <a href="{{ route('list.file',['file_id' => $like->id]) }}" class="product-name">
                                                         {{ $like->title }}
                                                     </a>
                                 
                                                     <div class="small m-t-xs">
                                                         {{ \Illuminate\Support\Str::limit($like->description, 30, $end='...') }}
                                                     </div>
                                                 </div>
                                             </div>
                                         </div>
                                     </a>
                                  </div>              
                             @endforeach
            </div>



                </div>
           

            </div>

                    
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 <script>
 $(window).load( function() {
        $('.sp-wrap').smoothproducts();
    });
function counterStart()
{
    let counter = document.querySelector('#counter')
    let fetcher = document.querySelector('#fetcher')
    let i = 5;
    let id = setInterval(frame,1000)
    counter.innerHTML = i

    function frame()
    {
        if(i<=0)
        {
            fetcher.submit()
            counter.innerHTML = "";
            clearInterval(id)

        }else 
        {
            counter.innerHTML = i--;
        }
    }
}

 </script>
 
 
    </body>
</html>
