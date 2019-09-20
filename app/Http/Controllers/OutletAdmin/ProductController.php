<?php

namespace App\Http\Controllers\OutletAdmin;

use App\Http\Controllers\Controller;
use App\Outlet;
use App\OutletPoductAvailability;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function viewProducts(){
        $companyId=Outlet::find(auth()->user()->company_or_outlet_id);
        $products=Product::where('company_id',$companyId->company_id)->get();
        return view('server.outlet.admin.products.view_products',compact('products'));
    }


    public function editProduct($id){
        $product=Product::find($id);
        return view('server.outlet.admin.products.edit_product',compact('product'));
    }


    public function updateProductStatus(Request $request){

        if(OutletPoductAvailability::where('product_id',$request->id)->exists()){
            $productAv=OutletPoductAvailability::where('product_id',$request->id)->first();
            if($request->status=='Available'){
                if(OutletPoductAvailability::find($productAv->id)->delete()){
                    return redirect()->route('view_outlet_products')->with('message','Product successfully updated');
                }
            }
            else{
                $updateProd=OutletPoductAvailability::where('id',$productAv->id)->update([
                    'status'=>$request->status
                ]);

                if($updateProd){
                    return redirect()->route('view_outlet_products')->with('message','Product successfully updated');
                }

            }
        }
        else{
            if($request->status!='Available'){
                $prod=new OutletPoductAvailability();
                $prod->product_id=$request->id;
                $prod->status=$request->status;
                $prod->outlet_id=auth()->user()->company_or_outlet_id;
                if($prod->save()){
                    return redirect()->route('view_outlet_products');
                }
                else{
                    return back()->with('error','Failed to update product, please contact admin');
                }
            }

        }
    }
}
