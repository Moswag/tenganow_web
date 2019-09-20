<?php

namespace App\Http\Controllers\RelierAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function viewAllSales(){

        return view('server.relier.sales.view_sales_all');
    }
}
