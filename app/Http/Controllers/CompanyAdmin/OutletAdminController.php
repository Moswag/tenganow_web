<?php

namespace App\Http\Controllers\CompanyAdmin;

use App\City;
use App\Http\Controllers\Controller;
use App\MyConstants;
use App\Outlet;
use App\OutletAdmin;
use App\User;
use Illuminate\Http\Request;

class OutletAdminController extends Controller
{
    public function viewOutletsAdmins(){
        $admins = OutletAdmin::where([ ['email', '<>', auth()->user()->email], ['company_id', auth()->user()->company_or_outlet_id]])->get();
        $outlets=Outlet::where('company_id',auth()->user()->company_or_outlet_id)->get();
        return view('server.company.outlet_admin.view_outlet_admins', compact('admins','outlets'));
    }



    public function editOutletAdmin($id){
        if(OutletAdmin::find($id)->exists()){
            $admin=OutletAdmin::find($id);
            $outlets=Outlet::where('company_id',auth()->user()->company_or_outlet_id)->get();
            return view('server.company.outlet_admin.edit_outlet_admin',compact('admin','outlets'));
        }

    }

    public function updateOutletAdmin(Request $request){
        if(OutletAdmin::find($request->id)->exists()){
            $updateAdmin=OutletAdmin::where('id',$request->id)->update([
                'name'=>$request->name,
                'surname'=>$request->surname,
                'email'=>$request->email,
                'phonenumber'=>$request->phonenumber
            ]);

            if($updateAdmin){
                return redirect()->route('view_outlet_admins')->with('message','Outlet admin successfully updated');
            }
            else{
                return back()->with('error','Failed to update outlet admin, please contact admin');
            }
        }
        else{
            return redirect()->route('view_outlet_admins')->with('error','Admin with that id do not exists');
        }
    }

    public function saveOutletAdmin(Request $request){
        $userExist = User::where('email', $request->email)->exists();
        if ($userExist) {
            return back()->with('error', 'User already exists');
        } else {
            $user = new User();
            $user->name = $request->name . ' ' . $request->surname;
            $user->email = $request->email;
            $user->role = MyConstants::USER_OUTLET_ADMIN;
            $user->company_or_outlet_id = $request->outlet;
            $user->password = bcrypt($request->password);

            if ($user->save()) {
                $admin = new OutletAdmin();
                $admin->name = $request->name;
                $admin->surname = $request->surname;
                $admin->email = $request->email;
                $admin->phonenumber = $request->phonenumber;
                $admin->role = MyConstants::USER_OUTLET_ADMIN;
                $admin->company_id= auth()->user()->company_or_outlet_id;
                $admin->outlet_id = $request->outlet;


                if ($admin->save()) {
                    return redirect()->route('view_outlet_admins')->with('message', 'Outlet Admin successfully added');
                } else {
                    return redirect()->route('view_outlet_admins')->with('error', 'Failed to add outlet admin');
                }
            } else {
                return redirect()->route('view_outlet_admins')->with('message', 'Failed to add user');
            }
        }
    }


    public function deleteAdminOutlet($id){
        if(OutletAdmin::where('id',$id)->exists()){
            if(OutletAdmin::find($id)->exists()){
                return redirect()->route('view_outlet_admins')->with('message','Admin successfully deleted');
            }
            else{
                return back()->with('error','Failed to delete the outlet admin, please contact developer');

            }
        }
        else{
            return back()->with('error','Outlet admin do not exists');
        }
    }


}
