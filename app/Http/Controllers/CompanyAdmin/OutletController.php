<?php

namespace App\Http\Controllers\CompanyAdmin;

use App\City;
use App\Company;
use App\Http\Controllers\Controller;
use App\MyConstants;
use App\Outlet;
use App\OutletAdmin;
use App\OutletPaynow;
use App\User;
use Illuminate\Http\Request;

class OutletController extends Controller
{
    public function companyOutlets(){
        $outlets=Outlet::where('company_id',auth()->user()->company_or_outlet_id)->get();
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
        $outlet->tel=$request->tel;
        $outlet->working_hours='All';

        if($outlet->save()){
            return redirect()->route('view_company_outlets')->with('message','Outlet successfully added');

        }
    }


    public function editOutlet($id){
        $outlet=Outlet::find($id);
        $cities=City::all();
        return view('server.company.outlets.edit_outlet',compact('outlet','cities'));
    }

    public function updateOutlet(Request $request){
        if(Outlet::where('id',$request->id)->exists()){
            if($request->address!=''){
                $updateOutlet=Outlet::where('id',$request->id)->update([
                    'address'=>$request->address,
                    'city'=>$request->city,
                    'tel'=>$request->tel
                ]);
            }
            else{
                $updateOutlet=Outlet::where('id',$request->id)->update([
                    'city'=>$request->city,
                    'tel'=>$request->tel
                ]);
            }


            if($updateOutlet){
                return redirect()->route('view_company_outlets')->with('message','Outlet successfully updated');
            }
            else{
                return back()->with('error','Failed to update outlet');
            }
        }
    }


    //outlet admin





    public function deleteOutlet($id){
        if(Outlet::where('id',$id)->exists()){
            if(Outlet::find($id)->delete()){
                return redirect()->route('view_company_outlets')->with('message', 'Outlet successfully deleted');
            }
            else{
                return back()->with('error','Failed to delete outlet, please contact admin');
            }
        }
    }







}
