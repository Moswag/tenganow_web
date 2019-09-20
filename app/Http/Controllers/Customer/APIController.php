<?php

namespace App\Http\Controllers\Customer;

use App\City;
use App\Company;
use App\Customer;
use App\DeliveryPrice;
use App\MyConstants;
use App\Order;
use App\Outlet;
use App\Product;
use App\Promotion;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\OutletPaynow;
use App\OutletPoductAvailability;
use App\Transaction;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Paynow\Http\ConnectionException;
use Paynow\Payments\HashMismatchException;
use Paynow\Payments\InvalidIntegrationException;
use Paynow\Payments\NotImplementedException;
use Paynow\Payments\Paynow;

class APIController extends Controller
{

    /**
     * @var Paynow|null
     */
    protected $paynow = null;



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
            $customer->question=$request->question;
            $customer->answer=$request->answer;
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

    public function forgotPasswordPhone(Request $request){
        if(Customer::where('phonenumber',$request->phonenumber)->exists()){
            $customer=Customer::find($request->phonenumber);
            return response()->json(array([
                'response'=>MyConstants::RESPONSE_SUCCESS,
                'question'=>$customer->question,
                'answer'=>$customer->answer
            ]));
        }
        else{
            return response()->json(array([MyConstants::RESPONSE=>MyConstants::RESPONSE_FAILED]));
        }

    }

    public function resetPasswordNew(Request $request){
        if(User::where('email',$request->phonenumber)->exists()){
            $user=User::where('email',$request->phonenumber)->update([
                'password'=>bcrypt($request->password)
            ]);
            if($user){
                return response()->json(array(MyConstants::RESPONSE=>MyConstants::RESPONSE_SUCCESS));
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
                return response()->json(array(MyConstants::RESPONSE=>MyConstants::RESPONSE_SUCCESS,'name'=>auth()->user()->name));
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
    public function getCities(){
        $cities=City::all();
        return response()->json($cities);
    }

    public function getOutlets(){
        $outlets=Outlet::all();
        return response()->json($outlets);
    }

    public function getProducts(Request $request){
        $products=Product::where('company_id',$request->company_id)->get();
        $prodId=array();
        foreach($products as $product){
            if(OutletPoductAvailability::where([['product_id',$product->id],['outlet_id',$request->outlet_id]])->exists()){
                    //product is not availabe
            }
            else{
                $prodId[] = (array)$product->id;
            }
        }
        $outletproducts=Product::whereIn('id',$prodId)->get();
        return response()->json($outletproducts);
    }

//    public function placeOrder(Request $request){
//        $customer=Customer::find($request->phonenumber);
//        $order=new Order();
//        $order->customer_name=$customer->name;
//        $order->phonenumber=$request->phonenumber;
//        $order->order=$request->order;
//        $order->price=$request->amount;
//        $order->order_num=date('Y-m-d').rand(1,1000);
//        $order->status='Pending';
//       if($order->save()){
//           return response()->json(array(MyConstants::RESPONSE_SUCCESS));
//       }
//       else{
//           return response()->json(array(MyConstants::RESPONSE_FAILED));
//       }
//
//    }

    public function referenceNumber(Request $request){
        $orders=Order::where('order_num',$request->order_num)->update(['reference'=>$request->reference]);
        if($orders){
            return response()->json(array(MyConstants::RESPONSE_SUCCESS));
        }
        else{
            return response()->json(array(MyConstants::RESPONSE_FAILED));
        }

    }

    public function getMyOders(Request $request)
    {
        $orders = Order::where('phonenumber', $request->phonenumber)->get();
        foreach ($orders as $order) {
            $ouletPaynow=OutletPaynow::find($order->outlet_id);


            $paynow = new Paynow(
                $ouletPaynow->integrationId,
                $ouletPaynow->integrationKey,
                url('/'),
                url('/')
            );
            // Find a transaction matching the given transaction id
            $transaction = Transaction::find($order->transaction_id);
            try {
                // Try to poll the transaction
                $status = $paynow->pollTransaction($transaction->poll_url);

                if($status->paid()){
                    if($order->paid==0){
                        Order::where('transaction_id', $order->transaction_id)->update([
                            'paid' => $status->paid(),
                            'status' => $status->paid() ? 'Approved' : 'Awaiting payment'
                        ]);
                    }
                    if($transaction->paid==0){
                        Transaction::where('id',$transaction->id)->update([
                            'paid'=>true]
                        );
                    }
                }


                $myorders = Order::where('phonenumber',$request->phonenumber)->orderBy('id','desc')->get();
                return response()->json($myorders);

            } catch (Exception $e) {
                // Log out the error
                logger()->error($e->getMessage() . "\t\t" . $e->getTraceAsString());


            }
        }


    }



    public function viewPromotions(){
        $promotions=Promotion::all();
        return response()->json($promotions);
    }


    public function getDeliveryPrice(Request $request){
        $devPrice=DeliveryPrice::where('company_id',$request->company_id)->first();
        return response()->json(array('price' =>  $devPrice->price));
    }


}
