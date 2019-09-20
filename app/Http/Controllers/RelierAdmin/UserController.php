<?php

namespace App\Http\Controllers\RelierAdmin;

use App\Admin;
use App\MyConstants;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function saveRelierAdmins(Request $request){
        $user=new User();
        $user->name=$request->name.' '.$request->surname;
        $user->email=$request->email;
        $user->role=MyConstants::USER_RELIER_ADMIN;
        $user->password=bcrypt($request->password);
        if($user->save()){
            $admin=new Admin();
            $admin->name=$request->name;
            $admin->surname=$request->surname;
            $admin->email=$request->email;
            $admin->phonenumber=$request->phonenumber;
            $admin->role=MyConstants::USER_RELIER_ADMIN;


            if($admin->save()){
                return redirect()->route('view_admins')->with('message','Admin successfully added');
            }
            else{
                return redirect()->route('view_admins')->with('error','Failed to add admin');
            }
        }
        else{
            return redirect()->route('view_admins')->with('message','Failed to add user');
        }
    }



    public function viewRelierAdmins(){
        $admins=Admin::where([['id','<>',auth()->user()->id],['role',MyConstants::USER_RELIER_ADMIN]])->get();
        return view('server.relier.user.view_admins',compact('admins'));
    }

    public function editRelierAdmin($id){
        if(Admin::where('id',$id)->exists()){
            $admin=Admin::find($id);
            return view('server.relier.user.edit_admin',compact('admin'));
        }
        else{
            return redirect()->route('view_admins')->with('error','Failed to delete admin');

        }
    }


    public function updateRelierAdmin(Request $request){
        if(Admin::where('id',$request->id)->exists()){
            $updateAdmin=Admin::where('id',$request->id)->update([
                'name'=>$request->name,
            'surname'=>$request->surname,
            'email'=>$request->email,
            'phonenumber'=>$request->phonenumber
            ]);

            if($updateAdmin){
                return redirect()->route('view_admins')->with('message','Admin successfully updated');
            }
            else{
                return redirect()->route('view_admins')->with('error','Failed to update admin for some reason');
            }
        }
        else{
            return redirect()->route('view_admins')->with('error','Admin with that id do not exists');
        }
    }


    public function deleteRelierAdmin($id){
        $admin=Admin::find($id);
        if(User::where('email',$admin->email)->delete()){
            if(Admin::find($id)->delete()){
                return redirect()->route('view_admins')->with('message','User Admin successfully deleted');
            }
            else{
                return redirect()->route('view_admins')->with('error','Failed to delete Admin');
            }
        }
        else{
            return redirect()->route('view_admins')->with('error','Failed to delete User');
        }


    }
}
