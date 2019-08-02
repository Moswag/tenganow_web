<?php

namespace App\Http\Controllers;

use App\Outlet;
use Illuminate\Http\Request;

class OutletController extends Controller
{
    public function adminViewAllOutlets(){
        $outlets=Outlet::all();
        return view('server.relier.outlets.view_outlets',compact('outlets'));
    }



}
