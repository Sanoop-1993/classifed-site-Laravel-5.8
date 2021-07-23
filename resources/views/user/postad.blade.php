@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <strong>Categories</strong>
                </div>
                <div class="card-body p-0">
                    <ul class="userpagecategories list-group fa-ul">

                        @if (isset($categories))

                            @if (count($categories)>0)

                                @foreach ($categories as $category)
                                    <li> 
                                        <a class="list-group-item" href="{{url('/post-classify-ad/'.preg_replace('/\s+/','',$category->MainCategory).'/'.$category->id)}}">
                                        {!!html_entity_decode($category->icon)!!}{{$category->MainCategory}}</a></li>

                                @endforeach

                            @else
                                
                            @endif
                            
                        @endif
                    </ul>

                </div>
            </div>

        </div>
        <div class="col-md-9">

            <div class="card">
                <div class="card-header">
                    <strong>Advertisements</strong>
                </div>
                <div class="card-body">

                     <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a href="#home" class="nav-link" data-togle="tab">Categories</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">

                        <div id="home">
                            <h1 class="" style="padding: 10px;text-align:center">Select Your Category</h1>
                        </div>
                    </div>
                    
                </div>
            </div>
            
        </div>
    </div>
</div>

@endsection