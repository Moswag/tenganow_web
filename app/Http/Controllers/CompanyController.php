<?php

namespace App\Http\Controllers;


use App\Company;
use App\MyConstants;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    //

    public function saveCompany(Request $request){

        $image=$request->file('logo');
        $input['imagename']=$image->getClientOriginalName();
        $extension=$image->getClientOriginalExtension();
        $myfile=bcrypt($input['imagename']).'.'.$extension;
        $destination = 'companylogo';
        $image->storeAs($destination, $myfile);


        $company=new Company();
        $company->name=$request->name;
        $company->mission=$request->mission;
        $company->imageUrl=MyConstants::PATH_URL.$destination.'/'.$myfile;
        $company->status=$request->status;
        if($company->save()){
            return redirect()->route('view_companies')->with('message','Company successfully added');
        }
        else{
            return back()->with('error','Failed to add company');
        }
    }



    public function viewCompanies(){
        $companies=Company::all();
        return view('server.relier.company.view_companies',compact('companies'));
    }


}
