<?php

namespace App\Http\Controllers;

use App\City;
use App\MyConstants;
use Illuminate\Http\Request;

class CityController extends Controller
{


    public function saveCity(Request $request){
        $city=new City();
        $city->name=$request->city;
        $city->status=MyConstants::STATUS_ACTIVE;

        if($city->save()){
            return redirect()->route('view_cities')->with('message','City successfully added');
        }
        else{
            return redirect()->route('view_cities')->with('error','Failed to add city');
        }
    }


    public  function viewCities(){
        $cities=City::all();
        return view('server.relier.city.view_cities',compact('cities'));
    }
}
