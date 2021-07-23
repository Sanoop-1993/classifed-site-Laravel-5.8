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
                                        <a class="list-group-item" href="{{url('/viewAds/'.preg_replace('/\s+/','',$category->MainCategory).'/'.$category->id)}}">
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

                    <div class="col-lg-12">
                        @if (session('info'))
                        <div class="alert alert-success" style="margin-top: 5px">
                            {{session('info')}}
                        </div>
                            
                        @endif
                    </div>
                    <div class="row">
                        @if (count($ads)>0)
                        
                            @foreach ($ads as $row)

                            <div class="col-md-3">
                                <div class="productCard">
                                    <img src="<?php echo strtok($row->photos,',')?>" style="padding:10px !important;width:100%;height:182px;"alt="">
                                    <h3 style="margin-bottom:0px">{{$row->product_name}}</h3>
                                    <h3 style="margin-bottom:0px">{{$row->city}}</h3>
                                    <p><a href="{{url('/product/view/'.$row->id)}}">VIEW</a></p>
                                </div>
                            </div>
                                
                            @endforeach

                            @else
                            <p>No Data Found</p>

                        
                            
                        @endif
                    </div>
                   
                    
                </div>
            </div>
            
        </div>
    </div>
</div>

@endsection