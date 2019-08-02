<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Company;
use App\MyConstants;
use App\RelierToken;
use App\User;
use foo\bar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginAndRegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('session.login');
    }

    public function signup(){
        return view('session.register');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userExists=User::where('email',$request->email)->exists();
        if($userExists){
            return back()->with('error','User already registered, please login to proceed');
        }
        else{
            $tokenValid=RelierToken::where('token',$request->token)->exists();
            if($tokenValid){
                $token=RelierToken::where('token',$request->token)->get();
                foreach ($token as $k){
                    $tok_status=$k->status;
                    $comp=$k->company;
                }
                $company=Company::where('name',$comp)->get();
                foreach ($company as $c){
                    $cmp_image=$c->imageUrl;
                    $cmp_name=$c->name;
                    $cmpid=$c->id;
                }
                if($tok_status==MyConstants::TOKEN_UNUSED){
                    $user=new User();
                    $user->name=$request->name.' '.$request->surname;
                    $user->email=$request->email;
                    $user->role=MyConstants::USER_COMPANY_ADMIN;
                    $user->image=$cmp_image;
                    $user->company_or_outlet_id=$cmpid;
                    $user->password=bcrypt($request->password);
                    if($user->save()){
                        $admin=new Admin();
                        $admin->name=$request->name;
                        $admin->surname=$request->surname;
                        $admin->email=$request->email;
                        $admin->phonenumber=$request->phonenumber;
                        $admin->role=MyConstants::USER_COMPANY_ADMIN;
                        if($admin->save()){
                            return redirect()->route('login')->with('message',$cmp_name.' Admin successfully registered, you can login now');
                        }
                        else{
                            return back()->with('error','Failed to add company admin, please contact admin');
                        }

                    }
                    else{
                        return back()->with('error','Failed to add user, please contact admin');
                    }
                }
                else{
                    return back()->with('error','Token already used, please contact admin '.$tok_status);
                }
            }
            else{
                return back()->with('error','Token do not exists, please contact admin');
            }


        }



    }

    public function login(Request $request){

        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
            if(auth()->user()->role=='relier_admin'){
                return redirect()->route('view_products');
            }
            else if(auth()->user()->role=='company_admin'){
                return redirect()->route('view_products');
            }
            else if(auth()->user()->role=='outlet_admin'){
                return redirect()->route('view_products');
            }
            else if(auth()->user()->role=='outlet_operator'){
                return redirect()->route('view_products');
            }


        }
        else{
            return back()->with('error','Wrong credentials please try again');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function logout(){
        auth()->logout();
        session()->flush();
        return redirect()->route('login')->with('message','Successfully logged out');
    }
}
