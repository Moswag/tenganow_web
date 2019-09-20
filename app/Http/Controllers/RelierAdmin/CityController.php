<?php

namespace App\Http\Controllers\RelierAdmin;

use App\City;
use Carbon\Carbon;
use App\MyConstants;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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

    public function editCity($id){
        $city=City::find($id);
        return view('server.relier.city.edit_city',compact('city'));
    }

    public function updateCity(Request $request){
        if(City::where('id',$request->id)->exists()){
            $updateCity=City::where('id',$request->id)->update([
                'name'=>$request->city
            ]);
            if($updateCity){
                return redirect()->route('view_cities')->with('message','City successfully updated');
            }
            else{
                return redirect()->route('view_cities')->with('error','Failed to update city for some reason, please contact admin');
            }
        }
    }

    public  function deleteCity($id){
        if(City::where('id',$id)->exists()){
            if(City::find($id)->delete()){
                return redirect()->route('view_cities')->with('message','City successfully deleted');
            }
            else{
                return redirect()->route('view_cities')->with('error','Failed to delete City, please contact admin');
            }
        }
        else{
            return redirect()->route('view_cities')->with('error','City with that id do not exists');
        }
    }
}
