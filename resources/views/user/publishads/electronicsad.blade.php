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
                            <a href="#home" class="nav-link" data-togle="tab">Electronics & Appliences</a>
                        </li>
                    </ul>
                   <div class="tab-content" id="myTabContent">

                        <div  class="" id="home">

                            <h1 class="" style="padding: 10px;text-align:center" id="selcatmsg"></h1>
                            <form class="form-horizontal" enctype="multipart/form-data" method="post" action="{{url('/postCarsBikes')}}" style="padding-left:20px">
                                @csrf

                                <div class="row">
                                    <div class="col-lg-6">
                                        @if (count($errors)>0)
                                            @foreach ($errors->all() as $error)
                                                {{$error}}
                                            @endforeach
                                            
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <input type="hidden" name="MainCategory_id" value="{{Request::segment(3)}}">
                                                <label for=""><strong>Select Subcategory</strong></label>
                                                <select name="SubCategory_id" id="" class="form-control">
                                                <option value="">Select</option>
                                                @if (count($subcategories)>0)

                                                    @foreach ($subcategories as $subcategory)
                                                        <option value="{{$subcategory->id}}">{{$subcategory->SubCategory}}</option>
                                                    @endforeach
                                                    
                                                @else
                                                    
                                                @endif
                                                </select>


                                            </div>
                                        </div>
                                        <label></label>

                                        @if ($errors->has('SubCategory_id'))
                                        <span class="alert alert-danger" style="margin-left: 13px;padding:5px">{{$errors->first('SubCategory_id')}}</span>
                                            
                                        @endif

                                    </div>

                                     <div class="col-lg-6">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for=""><strong>Product Name</strong></label>
                                               <input type="text" class="form-control" placeholder="Product Name" name="product_name">
                                            </div>
                                        </div>
                                        <label></label>

                                        @if ($errors->has('product_name'))
                                        <span class="alert alert-danger" style="margin-left: 13px;padding:5px">{{$errors->first('product_name')}}</span>
                                            
                                        @endif

                                    </div>

                                    <div class="col-lg-6">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for=""><strong>Year of Purchase</strong></label>
                                               <input type="text" class="form-control" placeholder="Year of Purchase" name="yearofpurchase">
                                            </div>
                                        </div>
                                        <label></label>

                                    </div>

                                    <div class="col-lg-6">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for=""><strong>Expected Selling Price</strong></label>
                                               <input type="text" class="form-control" placeholder="Expected Selling Price" name="expectedsellprice">
                                            </div>
                                        </div>
                                        <label></label>

                                    </div>

                                    <div class="col-lg-6">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for=""><strong>Your Name</strong></label>
                                               <input type="text" class="form-control" placeholder="Your Name" name="owner_name">
                                            </div>
                                        </div>
                                        <label></label>

                                    </div>

                                    <div class="col-lg-6">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for=""><strong>Your Mobile</strong></label>
                                               <input type="text" class="form-control" placeholder="Your Mobile" name="mobile">
                                            </div>
                                        </div>
                                        <label></label>

                                    </div>

                                    <div class="col-lg-6">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for=""><strong>Your Email</strong></label>
                                               <input type="text" class="form-control" placeholder="Your Email" name="email">
                                            </div>
                                        </div>
                                        <label></label>

                                    </div>

                                    <div class="col-lg-6">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <input type="hidden" name="MainCategory_id" value="{{Request::segment(3)}}">
                                                <label for=""><strong>State</strong></label>
                                                <select name="state" id="" class="form-control">
                                                <option value="">Select</option>
                                                 @if (count($states)>0)

                                                    @foreach ($states as $state)
                                                        <option value="{{$state->id}}">{{$state->State}}</option>
                                                    @endforeach
                                                    
                                                @else
                                                    
                                                @endif
                                                </select>


                                            </div>
                                        </div>
                                        <label></label>

                                    </div>

                                    <div class="col-lg-6">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for=""><strong>City</strong></label>
                                               <input type="text" class="form-control" placeholder="Your Your City" name="city">
                                            </div>
                                        </div>
                                        <label></label>

                                    </div>

                                     <div class="col-lg-6">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for=""><strong>Photos (Max 4)</strong></label>
                                                <input type="file" class="form-control" name="photos[]" multiple="true">
                                            </div>
                                        </div>
                                        <label></label>

                                    </div>


                                </div>

                                <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group" style="text-align: center">
                                                <button type="submit" class="btn btn-dark">Post Your Ad</button>
                                                <button type="reset" class="btn btn-primary">Reset</button>

                                            </div>
                                        <label></label>

                                    </div>
                                </div>
                            
                            
                            </form>

                        </div>
                    </div>
                    
                    
                </div>
            </div>
            
        </div>
    </div>
</div>

@endsection