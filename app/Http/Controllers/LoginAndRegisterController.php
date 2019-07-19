<?php

namespace App\Http\Controllers;

use App\User;
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
        $image=$request->file('logo');
        $input['imagename']=$image->getClientOriginalName();
        $extension=$image->getClientOriginalExtension();
        $myfile=bcrypt($input['imagename']).'.'.$extension;
        $destination = 'companylogo';
        $image->storeAs($destination, $myfile);


        $user=new User();
        $user->company_name=$request->name;
        $user->company_address=$request->address;
        $user->email=$request->email;
        $user->location=$request->location;
        $user->company_address=$request->address;
        $user->ecocash=$request->ecocash;
        $user->logo='http://localhost/tenganow/storage/app/'.$destination.'/'.$myfile;
        $user->tel=$request->tel;
        $user->password=bcrypt($request->password);
        $user->status='pending';
        $user->save();
        return redirect()->route('login')->with('message','Company successfully registered, you will receive an email when the company has been verified');
    }

    public function login(Request $request){

        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
            return redirect()->route('view_products');
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
