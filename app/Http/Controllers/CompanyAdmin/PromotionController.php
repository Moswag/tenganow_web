<?php

namespace App\Http\Controllers\CompanyAdmin;

use App\Company;
use App\Http\Controllers\Controller;
use App\Product;
use App\Promotion;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    public function viewPromotions(){
        $promotions=Promotion::where('company_id',auth()->user()->company_or_outlet_id)->get();
        return view('server.company.promotion.view_promotions',compact('promotions'));
    }



    public function savePromotion(Request $request){
        $company=Company::find(auth()->user()->company_or_outlet_id);
        $promotion=new Promotion();
        $promotion->promotion=$request->promotion;
        $promotion->status=$request->status;
        $promotion->company_id=$company->id;
        $promotion->company=$company->name;
        if($promotion->save()){
            return redirect()->route('view_promotions')->with('message','Promotion successfully added');
        }
    }



    public function editPromotion($id){
        if(Promotion::find($id)->exists()){
            $promotion=Promotion::find($id);
            return view('server.company.promotion.edit_promotion',compact('promotion'));
        }
        else{
            return back()->with('error','Promotion with that id do not exists');
        }
    }

    public function updatePromotion(Request $request){
        if(Promotion::find($request->id)->exists()){
            if($request->promotion!=''){
                $updatePromotion=Promotion::where('id',$request->id)->update([
                    'promotion'=>$request->promotion,
                    'status'=>$request->status
                ]);
                if($updatePromotion){
                    return redirect()->route('view_promotions')->with('message','Promotions successfully updated');
                }
                else{
                    return back()->with('error','Failed to update promotion');
                }
            }
            else{
                $updatePromotion=Promotion::where('id',$request->id)->update([
                    'status'=>$request->status
                ]);
                if($updatePromotion){
                    return redirect()->route('view_promotions')->with('message','Promotions successfully updated');
                }
                else{
                    return back()->with('error','Failed to update promotion');
                }
            }

        }
    }


    public function deletePromotion($id){
        if(Promotion::find($id)->exists()){
            if(Promotion::find($id)->delete()){
                return redirect()->route('view_promotions')->with('message','Promotion successfully deleted');
            }
            else{
                return back()->with('error','Failed to delete promotion');
            }
        }
        else{
            return redirect()->route('view_promotions')->with('error','Promotion with that id do not exists, please contact admin');
        }
    }
}
