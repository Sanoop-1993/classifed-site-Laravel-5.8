<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ADZone') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('fontawesome/css/all.css') }}"  rel="stylesheet">


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom-css.css') }}" rel="stylesheet">

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
            <div class="container">

            <div class="col-lg-3">

           <h4 class="p-0 m-0 display-4">
           <a class="navbar-brand" href="{{ url('/') }}">
                ADZone
                </a></h4>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest

                        <li class="nav-item">
                                    <a class="nav-link" href="{{url('post-classified-add')}}">Add Post</a>
                                </li>
                    </ul>

                    </div>
                    

            </div><!--col-lg-3 -->

        <div class="col-lg-9">

        <div class="row">

           <div class="col-lg-4">
             <form class="form-horizontal row" method="post" action="{{url('/product/search')}}">
             @csrf
             <div class="col-8">
             <input class="form-control" type="text" name="searchonproduct" placeholder="Enter Product" required="true" aria-label="Search">

             </div>

             <div class="col-4">
             <input  type="submit" class="btn btn-outline-success" value="Search" type="submit">

             </div>
            </form>  
            </div>

            <div class="col-lg-8">
            
            <form class="form-horizontal row" method="post" action="{{url('/search/ads')}}">
            @csrf

                <div class="form-group row">

                <div class="col-lg-6">
                    <input type="text" name="states" id="state" class="form-control" placeholder="Enter State" required="true">
                    <div id="statelist"style="border-radius:0px; background:#fff;padding:0px 13px;overflow-y:auto;
                    width:88%;"></div>
                    <div id="citylist" style="display: block; position: absolute;
                    border-radius:0px; background:#fff;padding:0px 13px;overflow-y:auto;
                    width:88%;"></div>
                     <input type="text" id="city" name="city" style="border:none" class="bg-dark text-white">
                </div>

                <div class="col-lg-4">

                <select name="categories" id="categories" name="categories" class="form-control dropdown">
                <option value="">Select</option>
                </select>
                </div>

                <div class="col-lg-2">
                <input  type="submit" class="btn btn-outline-success" value="Search" name="searchads" type="submit">

                
                </div>

                 </div>

            </form>
            </div>
            
            
            </div>
            
            
            </div><!--col-lg-9 -->


            </div> <!--Container -->
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

<script type="text/javascript">

    $(document).ready(function(){

        $('#state').keyup(function(){
            var data;
            var indianstates = $(this).val();
            if(indianstates != '')
            {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url:"{{route('searchlocation.fetch')}}",
                    method:"POST",
                    data:{indianstates:indianstates,_token:_token},
                    success:function(data){
                        $('#statelist').fadeIn();
                        $('#statelist').html(data);

                    }
                });
            }else{

                $('#statelist').fadeOut();
                $('#statelist').html(data);

            }

        });

        $(document).on('click','#search',function(){

            $('#state').val($(this).text());
            $('#statelist').fadeOut();
        });

    });

    $(document).on('click','#statelist ul li',function(){

        var state = $('#state').val();
        var id = $(this).val();

         var _token = $('input[name="_token"]').val();
                $.ajax({
                    url:"{{route('state.cities')}}",
                    method:"POST",
                    data:{id:id,_token:_token},
                    success:function(data){
                        $('#citylist').fadeIn();
                        $('#citylist').html(data);
                    }
                });

    });

    $(document).on('click','#citylist',function(e){

        var txt = $(e.target).text();

        $('#city').fadeIn();
        $('#city').val(txt);
        $('#citylist').fadeOut();

           
        });

    $(document).ready(function(){
        var _token = $('input[name="_token"]').val();
                $.ajax({
                    url:"{{route('categories.retrieve')}}",
                    method:"POST",
                    data:{_token:_token},
                    success:function(data){
                        $('#categories').fadeIn();
                        $('#categories').html(data);
                    }
                });

    });

    $(document).ready(function(){

        if(window.location == "http://127.0.0.1:8000/"){
            var _token = $('input[name="_token"]').val();
                $.ajax({
                    url:"{{route('categories.ads')}}",
                    method:"GET",
                    data:{_token:_token},
                    success:function(data){
                         $('#Advertisement').html(data);
                    }
                });


        }
        
    });

    $(document).ready(function(){
        $('p img').on('click',function()
        {
            $('.main').attr('src',$(this).attr('src'));

        });



    });





</script>
</html>
