<?php

namespace App\Http\Controllers\RelierAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Promotion;

class PromotionController extends Controller
{
    public function viewPromotions(){
        $promotions=Promotion::all();
        return view('server.relier.promotion.view_promotions',compact('promotions'));
    }


    public function deletePromotion($id){
        if(Promotion::where('id',$id)->exists()){
            if(Promotion::find($id)->delete()){
                return redirect()->route('view_company_promotions')->with('message','Promotion successfully deleted');
            }
            else{
                return back()->with('error','Failed to delete promotion, please contact admin');
            }
        }
        else{
            return back()->with('error','Promotion with that id is not found, please contact developer');
        }
    }
}
