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
                <div class="card-body" style="padding-left: 50px">

                    
                    <div class="row" id="Advertisement">

                        @if (count($products)>0)

                            @foreach ($products as $ad)
                            <?php
                                $img = [];
                                $img = explode(",",$ad->photos);
                            ?>

                            <div class="row">
                                <div class="col-lg-6 ml-auto">

                                    <div class="row featured" id="featured-image">
                                        <img class="main" src="{{$img[0]}}" alt="" width="320px%" height="290px" >
                                        <p>
                                            @if (isset($img[1]))
                                             <img src="{{$img[1]}}" alt="" width="100px" height="100px" >
                                            @endif
                                        </p>
                                         <p>
                                            @if (isset($img[2]))
                                             <img src="{{$img[2]}}" alt="" width="100px" height="100px" >
                                            @endif
                                        </p>

                                         <p>
                                            @if (isset($img[3]))
                                             <img src="{{$img[3]}}" alt="" width="100px" height="100px" >
                                            @endif
                                        </p>


                                    </div>

                                </div>

                                 <div class="col-lg-6">

                                    <div class="card border-secondary wb-3" style="max-width: 20rem;border:1px solid #ccc !important">
                                        <div class="card-header">PRODUCT DETAILS</div>
                                        <div class="card-body">
                                            <h6>Name: <span title="xtra large">{{$ad->product_name}}</span></h6>
                                            <h6>Published On: <span title="xtra large">{{$ad->yearofpurchase}}</span></h6>
                                            <h6>Price: <span title="xtra large">{{$ad->expectedsellprice}}</span></h6>
                                        
                                        </div>

                                    </div>

                                     <div class="card mt-3 border-secondary wb-3" style="max-width: 20rem;border:1px solid #ccc !important">
                                        <div class="card-header">SELLER DETAILS</div>
                                        <div class="card-body">
                                            <h6>Seller Name: <span title="xtra large">{{$ad->owner_name}}</span></h6>
                                            <h6>Mobile: <span title="xtra large">{{$ad->mobile}}</span></h6>
                                            <h6>Email: <span title="xtra large">{{$ad->email}}</span></h6>
                                        
                                        </div>

                                    </div>
                                    
                                </div>

                               
                            </div>
                                
                            @endforeach
                            
                        @else
                            
                        @endif



                    </div>
                   
                    
                </div>
            </div>
            
        </div>
    </div>
</div>

@endsection