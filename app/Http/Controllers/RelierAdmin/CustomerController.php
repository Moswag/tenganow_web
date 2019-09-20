<?php

namespace App\Http\Controllers\RelierAdmin;

use App\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    public function viewCustomers(){
        $customers=Customer::all();
        return view('server.relier.customers.view_customers',compact('customers'));
    }

    public  function deleteCustomer($id){
            if(Customer::find($id)->delete()){
                return redirect()->route('view_customers')->with('message','Customer successfully deleted');
            }
            else{
                return redirect()->route('view_customers')->with('error','Failed to delete customer');
            }
        }

}
