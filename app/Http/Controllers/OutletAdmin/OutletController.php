<?php

namespace App\Http\Controllers\OutletAdmin;

use App\Outlet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OutletController extends Controller
{
    public function adminViewAllOutlets(){
        $outlets=Outlet::all();
        return view('server.relier.outlets.view_outlets',compact('outlets'));
    }



}
