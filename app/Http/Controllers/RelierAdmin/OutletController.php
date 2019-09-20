<?php

namespace App\Http\Controllers\RelierAdmin;

use App\Company;
use App\Http\Controllers\Controller;
use App\Outlet;
use App\OutletPaynow;
use Illuminate\Http\Request;

class OutletController extends Controller
{
    public function viewOutlets($id){
        $outlets=Outlet::where('company_id',$id)->get();
        $company=Company::find($id);
        return view('server.relier.outlets.view_outlets',compact('outlets','company'));
    }

    public function viewOutletPaynow(){
        $outlet_paynow=OutletPaynow::all();
        $outlets=Outlet::all();
        return view('server.relier.token.paynow_token',compact('outlet_paynow','outlets'));
    }


    public function addOutletToken(Request $request){


        if(OutletPaynow::where('outlet_id',$request->outlet_id)->exists()) {
            return redirect()->route('view_outlet_paynows')->with('error', 'Outlet paynow already defined');
        }
        else{
            $outlet=Outlet::find($request->outlet_id);

            $outletPaynow = new OutletPaynow();
            $outletPaynow->outlet_id = $request->outlet_id;
            $outletPaynow->address = $outlet->address;
            $outletPaynow->integrationId = $request->integrationId;
            $outletPaynow->integrationKey = $request->integrationKey;
            $outletPaynow->status = $request->status;

            if ($outletPaynow->save()) {
                return redirect()->route('view_outlet_paynows')->with('message', 'Outlet paynow successfully added');
            } else {
                return redirect()->route('view_outlet_paynows')->with('error', 'Failed to add Outlet paynow');
            }
        }



    }

    public function editOutletPaynow($id){
        $outletExist=OutletPaynow::where('outlet_id',$id)->exists();
        if($outletExist){
            $outletPaynow=OutletPaynow::find($id);
            return view('server.relier.token.edit_paynow_outlet',compact('outletPaynow'));
        }
        else{
            return redirect()->route('view_outlet_paynows')->with('error', 'Failed to find the outlet id');
        }
    }




    public function updateOutletPaynow(Request $request){
        $outletExist=OutletPaynow::where('outlet_id',$request->outlet_id)->exists();
        if($outletExist){
            $outlet=OutletPaynow::where('outlet_id',$request->outlet_id)->update([
                'integrationId'=>$request->integrationId,
                'integrationKey'=>$request->integrationKey,
                'status'=>$request->status
            ]);
            if($outlet){
                return redirect()->route('view_outlet_paynows')->with('message','Outlet paynow has been successfully updated');
            }
            else{
                return redirect()->route('view_outlet_paynows')->with('error','Outlet paynow failed to be updated');
            }
        }

    }


    public function deleteOutletPaynow($id){
        if(OutletPaynow::find($id)->delete()){
            return redirect()->route('view_outlet_paynows')->with('message','Outlet paynow has been successfully updated');
        }
        else{
            return redirect()->route('view_outlet_paynows')->with('error','Failed to delete Outlet paynow');
        }
    }


}
