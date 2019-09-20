<?php

namespace App\Http\Controllers\CompanyAdmin;

use App\DeliveryPrice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DeliveryPriceController extends Controller
{
    public function viewDeliveryPrice(){
        $prices=DeliveryPrice::where('company_id',auth()->user()->company_or_outlet_id)->get();
        return view('server.company.delivery_price.view_delivery_price',compact('prices'));
    }

    public function saveDeliveryPrice(Request $request){
        if(DeliveryPrice::where('company_id',auth()->user()->company_or_outlet_id)->exists()){

        }
        else{
            $price=new DeliveryPrice();
            $price->company_id=auth()->user()->company_or_outlet_id;
            $price->price=$request->price;
            if($price->save()){
                return redirect()->route('view_delivery_price')->with('message','Delivery price successfully added');
            }
            else{
                return redirect()->route('view_delivery_price')->with('error','Failed to add delivery price, please contact admin');
            }

        }
    }


    public function editDeliveryPrice($id){
        $deliveryPrice=DeliveryPrice::find($id);
        return view('server.company.delivery_price.edit_delivery_price',compact('deliveryPrice'));
    }



}
