<?php

namespace App\Http\Controllers\OutletOperator;

use App\Outlet;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function viewProducts(){
        $companyId=Outlet::find(auth()->user()->company_or_outlet_id);
        $products=Product::where('company_id',$companyId->company_id)->get();
        return view('server.outlet.operator.products.view_products',compact('products'));
    }
}
