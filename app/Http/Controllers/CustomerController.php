<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function viewCustomers(){
        $customers=Customer::all();
        return view('server.relier.customers.view_customers',compact('customers'));
    }
}
