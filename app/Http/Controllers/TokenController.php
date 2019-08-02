<?php

namespace App\Http\Controllers;

use App\Company;
use App\MyConstants;
use App\RelierToken;
use Illuminate\Http\Request;

class TokenController extends Controller
{
    public function viewTokens(){
        $tokens=RelierToken::all();
        $companies=Company::all();
        return view('server.relier.token.view_tokens',compact('tokens','companies'));
    }


    public function saveToken(Request $request){
        $token=new RelierToken();
        $token->token=bcrypt(rand(1000,9999999999));
        $token->company=$request->company;
        $token->status=MyConstants::TOKEN_UNUSED;

        if($token->save()){
            return redirect()->route('view_tokens')->with('message','Token successfully added');
        }
        else{
            return redirect()->route('view_tokens')->with('error','Failed to add Token');
        }
    }

    public function deleteToken($id){
        if(RelierToken::find($id)->delete()){
            return redirect()->route('view_tokens')->with('message','Token successfully deleted');
        }
        else{
            return redirect()->route('view_tokens')->with('error','Failed to delete token');
        }
    }
}
