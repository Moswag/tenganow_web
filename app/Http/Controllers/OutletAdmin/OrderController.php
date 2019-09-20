<?php

namespace App\Http\Controllers\OutletAdmin;

use App\Order;
use App\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\Payments\PaynowController;
use App\Http\Controllers\Api\Payments\CustomerOrderController;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function receipt($id){
        return view('order.receipt');
    }

    public function order_placed(){
        $orders=Order::where([['outlet_id',auth()->user()->company_or_outlet_id],['status','Processed']])->orderBy('id','desc')->get();
        return view('server.outlet.admin.order.order_placed',compact('orders'));
    }

    public function pending_order(){
        $orders=Order::where([['outlet_id',auth()->user()->company_or_outlet_id],['status','<>','Processed'],['with_delivery','=','false']])->orderBy('pickuptime','asc')->get();
        return view('server.outlet.admin.order.order_pending',compact('orders'));
    }

    public function deliveryOrder(){
        $orders=Order::where([['outlet_id',auth()->user()->company_or_outlet_id],['status','<>','Processed'],['with_delivery','=','true']])->orderBy('id','asc')->get();
        return view('server.outlet.admin.order.order_to_be_delivered',compact('orders'));
    }

    public function processOrder($id){
        if(Order::where('id',$id)->exists()){
            $updateOder=Order::where('id',$id)->update([
                'status'=>'Processed',
                'processed_by'=>auth()->user()->id
            ]);

            if($updateOder){
                return redirect()->route('pending_order')->with('message','Order successfully processed');
            }
            else{
                return redirect()->route('pending_order')->with('error','Failed to update Order');
            }
        }
        else{
            return redirect()->route('pending_order')->with('error','Order with that id is not found');
        }

    }





    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
