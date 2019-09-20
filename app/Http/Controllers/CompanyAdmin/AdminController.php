<?php

namespace App\Http\Controllers\CompanyAdmin;

use App\Admin;
use App\City;
use App\Company;
use App\MyConstants;
use App\Outlet;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class AdminController extends Controller
{
    public function viewAdmins()
    {
        $admins = Admin::where([['role', MyConstants::USER_COMPANY_ADMIN], ['email', '<>', auth()->user()->email], ['company_or_outlet_id', auth()->user()->company_or_outlet_id]])->get();
        return view('server.company.admin.view_company_admins', compact('admins'));
    }


    public function saveAdmin(Request $request)
    {
        $userExist = User::where('email', $request->email)->exists();
        if ($userExist) {
            return back()->with('error', 'User already exists');
        } else {
            $user = new User();
            $user->name = $request->name . ' ' . $request->surname;
            $user->email = $request->email;
            $user->role = MyConstants::USER_COMPANY_ADMIN;
            $user->company_or_outlet_id = auth()->user()->company_or_outlet_id;
            $user->password = bcrypt($request->password);

            if ($user->save()) {
                $admin = new Admin();
                $admin->name = $request->name;
                $admin->surname = $request->surname;
                $admin->email = $request->email;
                $admin->phonenumber = $request->phonenumber;
                $admin->role = MyConstants::USER_COMPANY_ADMIN;
                $admin->company_or_outlet_id = auth()->user()->company_or_outlet_id;

                if ($admin->save()) {
                    return redirect()->route('view_company_admins')->with('message', 'Admin successfully added');
                } else {
                    return redirect()->route('view_company_admins')->with('error', 'Failed to add admin');
                }
            } else {
                return redirect()->route('view_company_admins')->with('message', 'Failed to add user');
            }
        }

    }


    public function editAdmin($id){
        if(Admin::where('id',$id)->exists()){
            $admin=Admin::find($id);
            return view('server.company.admin.edit_admin',compact('admin'));
        }
        else{
            return back()->with('error','Admin with that id do not exists');
        }
    }

    public function updateAdmin(Request $request){
        if(Admin::where('id',$request->id)->exists()){
            $updateAdmin=Admin::where('id',$request->id)->update([
                'name'=>$request->name,
                'surname'=>$request->surname,
                'email'=>$request->email,
                'phonenumber'=>$request->phonenumber
            ]);

            if($updateAdmin){
                return redirect()->route('view_company_admins')->with('message', 'Admin successfully updated');
            }
            else{
                return redirect()->route('view_company_admins')->with('message', 'Failed to update admin');
            }
        }
        else{
            return redirect()->route('view_company_admins')->with('message', 'Admin with that id not found');
        }
    }

    public function deleteAdmin($id){
        if(Admin::where('id',$id)->exists()){
            $admin=Admin::find($id);
            if(User::where('email',$admin->email)->delete()){
                if(Admin::find($id)->delete()){
                    return redirect()->route('view_company_admins')->with('message','Admin successfully deleted');
                }
                else{
                    return redirect()->route('view_company_admins')->with('error','Failed to delete admin, please contact admin\'');
                }
            }
            else{
                return redirect()->route('view_company_admins')->with('error','Failed to delete user, please contact admin');
            }
        }
    }


}
