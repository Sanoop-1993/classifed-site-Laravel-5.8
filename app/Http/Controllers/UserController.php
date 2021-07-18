<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\State;

class UserController extends Controller
{
    public function index()
    {
        return view('user.user');
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
                    $output .='<li>'.$row->State.'<li>';   
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
}
