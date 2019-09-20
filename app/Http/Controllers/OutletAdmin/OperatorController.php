<?php

namespace App\Http\Controllers\OutletAdmin;

use App\Http\Controllers\Controller;
use App\MyConstants;
use App\Operator;
use App\Outlet;
use App\OutletAdmin;
use App\User;
use Illuminate\Http\Request;

class OperatorController extends Controller
{
    public function viewOutletOperators(){
        $admins = Operator::where('outlet_id', auth()->user()->company_or_outlet_id)->get();
        return view('server.outlet.admin.operator.view_operators', compact('admins'));
    }


    public function saveOutletOperator(Request $request){
        $userExist = User::where('email', $request->email)->exists();
        if ($userExist) {
            return back()->with('error', 'User already exists');
        } else {
            $user = new User();
            $user->name = $request->name . ' ' . $request->surname;
            $user->email = $request->email;
            $user->role = MyConstants::USER_OUTLET_OPERATOR;
            $user->company_or_outlet_id =auth()->user()->company_or_outlet_id;
            $user->password = bcrypt($request->password);

            if ($user->save()) {
                $admin = new Operator();
                $admin->name = $request->name;
                $admin->surname = $request->surname;
                $admin->email = $request->email;
                $admin->phonenumber = $request->phonenumber;
                $admin->role = MyConstants::USER_OUTLET_OPERATOR;
                $admin->outlet_id = auth()->user()->company_or_outlet_id;

                if ($admin->save()) {
                    return redirect()->route('view_operators')->with('message', 'Outlet Operator successfully added');
                } else {
                    return redirect()->route('view_operators')->with('error', 'Failed to add outlet Operator');
                }
            } else {
                return redirect()->route('view_operators')->with('error', 'Failed to add user');
            }
        }
    }


    public function editOutletOperator($id){
        $operator=Operator::find($id);
        return view('server.outlet.admin.operator.edit_operator', compact('operator'));
    }

    public function updateOutletOperator(Request $request){
        if(Operator::where('id',$request->id)->exists()){
            $upd=Operator::where('id',$request->id)->update([
                'name'=>$request->name,
                'surname'=>$request->surname,
                'email'=>$request->email,
                'phonenumber'=>$request->phonenumber
            ]);

            if($upd){
                return redirect()->route('view_operators')->with('message', 'Outlet Operator successfully updated');
            }
            else{
                return redirect()->route('view_operators')->with('error', 'Failed to update operator');
            }
        }


    }

    public function deleteOutletOperator($id){
        $operator=Operator::find($id);
        if(User::where('email',$operator->email)->delete()){
            if(Operator::find($id)->delete()){
                return redirect()->route('view_operators')->with('message', 'Operator successfully deleted');
            }
            else{
                return redirect()->route('view_operators')->with('error', 'Failed to delete operator');
            }
        }
        else{
            return redirect()->route('view_operators')->with('error', 'Failed to delete user');
        }

    }

}
