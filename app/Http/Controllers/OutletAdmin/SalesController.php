<?php

namespace App\Http\Controllers\OutletAdmin;

use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Http\Request;

class SalesController extends Controller
{

    public function viewSales(){
        $sales=Order::where([['outlet_id',auth()->user()->company_or_outlet_id],['status','Processed']])->get();
        return view('server.outlet.admin.sales.view_sales',compact('sales'));
    }

}
