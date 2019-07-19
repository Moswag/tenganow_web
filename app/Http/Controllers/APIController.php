<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Order;
use App\Product;
use App\User;
use Illuminate\Http\Request;

class APIController extends Controller
{


    public function customerRegister(Request $request){
        $customerExists=Customer::where('phonenumber',$request->phonenumber)->exists();
        if($customerExists){
            return response()->json(array('response'=>'registered'));
        }
        else{
            $customer=new Customer();
            $customer->name=$request->name;
            $customer->phonenumber=$request->phonenumber;
            $customer->password=$request->password;
            if($customer->save()){
                return response()->json(array('response'=>'success'));
            }
            else{
                return response()->json(array('response'=>'failed'));
            }
        }

    }

    public function customerLogin(Request $request){
        $doesCustomerExists=Customer::where('phonenumber',$request->phonenumber)->exists();
        if($doesCustomerExists){
            $customer=Customer::find($request->phonenumber);
            if($customer->password==$request->password){
                return response()->json(array('response'=>'success'));
            }
            else{
                return response()->json(array('response'=>'failed'));
            }
        }
        else{
            return response()->json(array('response'=>'notfound'));
        }
    }




    public function getCompanies(){
        $companies=User::all();
        return response()->json($companies);
    }

    public function getProducts(Request $request){
        $products=Product::where('company_id',$request->company_id)->get();
        return response()->json($products);
    }

    public function placeOrder(Request $request){
        $customer=Customer::find($request->phonenumber);
        $order=new Order();
        $order->customer_name=$customer->name;
        $order->phonenumber=$request->phonenumber;
        $order->order=$request->order;
        $order->price=$request->amount;
        $order->order_num=date('Y-m-d').rand(1,1000);
        $order->status='Pending';
       if($order->save()){
           return response()->json(array('success'));
       }
       else{
           return response()->json(array('failed'));
       }

    }

    public function referenceNumber(Request $request){
        $orders=Order::where('order_num',$request->order_num)->update(['reference'=>$request->reference]);
        if($orders){
            return response()->json(array('success'));
        }
        else{
            return response()->json(array('failed'));
        }

    }

    public function getMyOders(Request $request){
        $orders=Order::where('phonenumber',$request->phonenumber)->orderBy('id','desc')->get();
        return response()->json($orders);
    }


}
