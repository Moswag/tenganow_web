<?php

namespace App\Http\Controllers;

use App\Company;
use App\Customer;
use App\MyConstants;
use App\Order;
use App\Outlet;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class APIController extends Controller
{


    public function customerRegister(Request $request){
        $customerExists=Customer::where('phonenumber',$request->phonenumber)->exists();
        if($customerExists){
            return response()->json(array(MyConstants::RESPONSE=>'registered'));
        }
        else{
            $customer=new Customer();
            $customer->name=$request->name;
            $customer->phonenumber=$request->phonenumber;
            $customer->status=MyConstants::STATUS_ENABLED;
            if($customer->save()){
                $user=new User();
                $user->name=$request->name;
                $user->email=$request->phonenumber;
                $user->role=MyConstants::USER_CUSTOMER;
                $user->password=bcrypt($request->password);
                if($user->save()){
                    return response()->json(array(MyConstants::RESPONSE=>MyConstants::RESPONSE_SUCCESS));
                }
                else{
                    return response()->json(array(MyConstants::RESPONSE=>MyConstants::RESPONSE_FAILED));
                }

            }
            else{
                return response()->json(array(MyConstants::RESPONSE=>MyConstants::RESPONSE_FAILED));
            }
        }

    }

    public function customerLogin(Request $request){
        $doesCustomerExists=User::where('email',$request->phonenumber)->exists();
        if($doesCustomerExists){
            if(Auth::attempt(['email'=>$request->phonenumber,'password'=>$request->password])){
                return response()->json(array(MyConstants::RESPONSE=>MyConstants::RESPONSE_SUCCESS));
            }
            else{
                return response()->json(array(MyConstants::RESPONSE=>MyConstants::RESPONSE_FAILED));
            }
        }
        else{
            return response()->json(array(MyConstants::RESPONSE=>'notfound'));
        }
    }

    //localhost:8000/api/v1/payment/initiate



    public function getCompanies(){
        $companies=Company::all();
        return response()->json($companies);
    }

    public function getOutlets(Request $request){
        if($request->isCompany=='true'){
            $outlets=Outlet::where('company_id',$request->company_id)->get();
        }
        else{
            $outlets=Outlet::where('city',$request->company_id)->get();
        }

        return response()->json($outlets);
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
           return response()->json(array(MyConstants::RESPONSE_SUCCESS));
       }
       else{
           return response()->json(array(MyConstants::RESPONSE_FAILED));
       }

    }

    public function referenceNumber(Request $request){
        $orders=Order::where('order_num',$request->order_num)->update(['reference'=>$request->reference]);
        if($orders){
            return response()->json(array(MyConstants::RESPONSE_SUCCESS));
        }
        else{
            return response()->json(array(MyConstants::RESPONSE_FAILED));
        }

    }

    public function getMyOders(Request $request){
        $orders=Order::where('phonenumber',$request->phonenumber)->orderBy('id','desc')->get();
        return response()->json($orders);
    }


}
