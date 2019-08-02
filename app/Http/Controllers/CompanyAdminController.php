<?php

namespace App\Http\Controllers;

use App\Admin;
use App\City;
use App\Company;
use App\MyConstants;
use App\Outlet;
use Illuminate\Http\Request;

class CompanyAdminController extends Controller
{
    public function viewAdmins(){
        $admins=Admin::where('role',MyConstants::USER_COMPANY_ADMIN)->get();
        return view('server.company.admin.view_company_admins',compact('admins'));
    }





    public function companyOutlets(){
        $outlets=Outlet::all();
        $cities=City::all();
        return view('server.company.outlets.view_outlets',compact('outlets','cities'));
    }



    public function saveOutlet(Request $request){
        $company=Company::find(auth()->user()->company_or_outlet_id);
        $outlet=new Outlet();
        $outlet->company=$company->name;
        $outlet->company_id=$company->id;
        $outlet->address=$request->address;
        $outlet->city=$request->city;
        $outlet->imageUrl=auth()->user()->image;
        $outlet->ecocash_merchant=$request->ecocash;
        $outlet->tel=$request->tel;
        $outlet->working_hours='All';

        if($outlet->save()){
            return redirect()->route('view_company_outlets')->with('message','Outlet successfully added');

        }
    }
}
