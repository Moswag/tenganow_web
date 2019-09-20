<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
    public function changePassword(){
        return view('server.change_password');
    }

    public function updatePassword(Request $request){
        if(User::where('id',auth()->user()->id)->exists()){
            $updateUser=User::where('id',auth()->user()->id)->update([
                'password'=>bcrypt($request->password)
            ]);

            if($updateUser){
                return redirect()->route('change_password')->with('message','Your password has been successfully changed');
            }
            else{
                return redirect()->route('change_password')->with('error','Failed to update password, please contact admin');
            }
        }
        else{
            return redirect()->route('change_password')->with('error','User with that id do not exists, please contact admin');
        }
    }
}
