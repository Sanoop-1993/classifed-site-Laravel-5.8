<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;

use DB;
use App\Models\State;
use App\Models\City;
use App\Models\MainCategory;
use App\Models\Icon;
use App\Models\Advertisement;

class UserController extends Controller
{
    public function index()
    {
        $categories = DB::table('main_categories')
                      ->select('main_categories.id','main_categories.MainCategory','icons.icon')
                      ->join('icons','icons.MainCategory_id','=','main_categories.id')
                      ->get();
        return view('user.user',['categories' => $categories]);
    }

    public function fetch(Request $request)
    {
        if($request->get('indianstates'))
        {
            $query = $request->get('indianstates');
            $data = DB::table('states')
                    ->where('State','like','%'.$query.'%')
                    ->get();
            $output = '<ul style="display:block !important;" class="dropdown-menu">';
            if($data->count()>0){
                foreach($data as $row)
                {
                    $output .='<li class="searchState" name="searchState" id="search" value='.$row->id.'>'.$row->State.'<li>';   
                }
                $output .= '</ul>';
                echo $output;
            }
            else{
                $output .= '<li>Record Not Found!</li>';
                echo $output;
            }

        }

    }

    public function cities(Request $request)
    {
        if($request->get('id'))
        {
            $query  = $request->get('id');
            $data = DB::table('cities')
                    ->where('State_id',$query)
                    ->get();
            $output = '';
            if($data->count()>0){
                foreach($data as $row)
                {
                    $output .='<li name="cityList" id="cityList">'.$row->City.'<li>';   
                }
                $output .= '';
                echo $output;
            }
            else{
                $output .= '<li>City Not Found!</li>';
                echo $output;
            }
        }


    }


    public function retrieve(Request $request)
    {

        $data = DB::table('main_categories')->get();
        $output = '';
            if($data->count()>0){
                foreach($data as $row)
                {
                    $output .='<option value=".$row->id.">'.$row->MainCategory.'</option>';   
                }
                $output .= '';
                echo $output;
            }
        
        

    }

    public function postad()
    {
        $categories = DB::table('main_categories')
                      ->select('main_categories.id','main_categories.MainCategory','icons.icon')
                      ->join('icons','icons.MainCategory_id','=','main_categories.id')
                      ->get();
        return view('user.postad',['categories' => $categories]);
    }

    public function categories(Request $request, $maincategory,$id)
    {
         $categories = DB::table('main_categories')
                      ->select('main_categories.id','main_categories.MainCategory','icons.icon')
                      ->join('icons','icons.MainCategory_id','=','main_categories.id')
                      ->get();
         $subcategories = DB::table('main_categories')
                      ->select('*')
                      ->join('sub_categories','sub_categories.MainCategory_id','=','main_categories.id')
                      ->where(['main_categories.id' => $id])
                      ->get();
         $states = State::all();
        if($id == 2)
        {
        return view('user.publishads.carsbikesad',['categories' => $categories,'subcategories'=>$subcategories,'states'=>$states]);

        }
        elseif($id == 3)
        {
        return view('user.publishads.mobiletabletsad',['categories' => $categories,'subcategories'=>$subcategories,'states'=>$states]);

        }
        elseif($id == 4)
        {
        return view('user.publishads.electronicsad',['categories' => $categories,'subcategories'=>$subcategories,'states'=>$states]);

        }
        elseif($id == 5)
        {
        return view('user.publishads.realestatead',['categories' => $categories,'subcategories'=>$subcategories,'states'=>$states]);

        }
        elseif($id == 6)
        {
        return view('user.publishads.servicead',['categories' => $categories,'subcategories'=>$subcategories,'states'=>$states]);

        }
    }

    public function postCarsBikes(Request $request)
    {

        $this->validate($request,[
            'SubCategory_id'=>'required',
            'product_name'=>'required',
            'yearofpurchase'=>'required',
            'expectedsellprice'=>'required',
            'owner_name'=>'required',
            'mobile'=>'required',
            'email'=>'required',
            'state'=>'required',
            'city'=>'required',
            'photos'=>'required',
            'photos.*'=>'image|mimes:jpg, png, jpeg, gif, svg|max:2048'
        ]);

        $ads = new Advertisement;
        $images = $request->file('photos');
        $count = 0;
        if($request->file('photos')){
            foreach($images as $item)
            {
                if($count < 4)
                {
                    $var = date_create();
                    $date = date_format($var,'Ymd');
                    $imageName = $date.'-'.$item->getClientOriginalName();
                    $item->move(public_path().'/uploads/',$imageName);
                    $url = URL::to("/").'/uploads/'.$imageName;
                    $arr[] = $url;
                    $count++;
                }
            }
            $image = implode(",",$arr);
            $ads->MainCategory_id= $request->MainCategory_id;
            $ads->SubCategory_id= $request->SubCategory_id;
            $ads->product_name= $request->product_name;
            $ads->expectedsellprice= $request->expectedsellprice;
            $ads->yearofpurchase= $request->yearofpurchase;
            $ads->owner_name= $request->owner_name;
            $ads->mobile= $request->mobile;
            $ads->email= $request->email;
            $ads->state= $request->state;
            $ads->city= $request->city;
            $ads->photos= $image;
            $ads->save();

            return redirect('/')->with('info','Advertisement Published');
    
            
        }

    }

    public function getAds()
    {
        $ads = DB::table('advertisements')->get();
        $output='';
        if($ads->count()>0){
            foreach($ads as $row){
                $output .='<div class="col-md-3">
                <div>
                <img src='.strtok($row->photos,',').' style="padding:10px !important;width:100%;height:182px;"/>
                <h3>'.$row->product_name.'</h3>
                <p>'.$row->expectedsellprice.'</p>
                <p>'.$row->city.'</p>
                <a href='.$_SERVER['HTTP_REFERER'].'product/view/'.$row->id.'>VIEW</a>
                </div>
                </div>

                ';
            }

            $output .='';
            echo $output;
        }else{
            $output .='<p>No Ads Found</p>';
            echo $output;
        }
    }

    public function viewAds(Request $request,$maincategory,$id)
    {
        $categories = DB::table('main_categories')
                      ->select('main_categories.id','main_categories.MainCategory','icons.icon')
                      ->join('icons','icons.MainCategory_id','=','main_categories.id')
                      ->get();
        if($id == 2)
        {
            $carsBikes = DB::table('advertisements')->where('MainCategory_id',$id)->get();

        return view('user.categories.carsbikesad',['categories' => $categories,'carsBikes'=>$carsBikes]);

        }
        elseif($id == 3)
        {
            $mobiletabs = DB::table('advertisements')->where('MainCategory_id',$id)->get();

        return view('user.categories.mobiletabletsad',['categories' => $categories,'mobiletabs'=>$mobiletabs]);

        }
        elseif($id == 4)
        {
            $electronics = DB::table('advertisements')->where('MainCategory_id',$id)->get();

        return view('user.categories.electronicsad',['categories' => $categories,'electronics'=>$electronics]);

        }
        elseif($id == 5)
        {
        return view('user.categories.realestatead',['categories' => $categories,'subcategories'=>$subcategories,'states'=>$states]);

        }
        elseif($id == 6)
        {
        return view('user.categories.servicead',['categories' => $categories,'subcategories'=>$subcategories,'states'=>$states]);

        }

    }

    public function searchProduct(Request $request)
    {
        if($request->get('searchonproduct'))
        {
            $query = $request->get('searchonproduct');
            $categories = DB::table('main_categories')
                      ->select('main_categories.id','main_categories.MainCategory','icons.icon')
                      ->join('icons','icons.MainCategory_id','=','main_categories.id')
                      ->get();
            $ads = DB::table('advertisements')
                   ->where('product_name','LIKE','%'.$query.'%')
                   ->get();

            return view('user.categories.searchad',['categories' => $categories,'ads'=>$ads]);

        }
    }

    public function searchAdvertisements(Request $request)
    {
         if($request->get('city')  && $request->get('categories'))
         {
             $city = $request->get('city');
             $categories_id = $request->get('categories');
             $categories = DB::table('main_categories')
                      ->select('main_categories.id','main_categories.MainCategory','icons.icon')
                      ->join('icons','icons.MainCategory_id','=','main_categories.id')
                      ->get();
             $ads = DB::table('advertisements')
                   ->where(['city' => $city,'MainCategory_id' => $categories_id])
                   ->get();

             return view('user.categories.searchad',['categories' => $categories,'ads'=>$ads]);

             
         }

    }

    public function viewProduct(Request $request,$id)
    {
         $categories = DB::table('main_categories')
                      ->select('main_categories.id','main_categories.MainCategory','icons.icon')
                      ->join('icons','icons.MainCategory_id','=','main_categories.id')
                      ->get();
         $products = DB::table('advertisements')
                   ->where('id',$id)
                   ->get();

         return view('user.productView',['categories' => $categories,'products'=>$products]);


    }
}
