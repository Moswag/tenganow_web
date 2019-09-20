<?php

namespace App\Http\Controllers\RelierAdmin;


use App\Company;
use App\MyConstants;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CompanyController extends Controller
{
    //

    public function saveCompany(Request $request)
    {

        $image = $request->file('logo');
        $input['imagename'] = $image->getClientOriginalName();
        $extension = $image->getClientOriginalExtension();
        $myfile = bcrypt($input['imagename']) . '.' . $extension;
        $destination = 'companylogo';
        $image->storeAs($destination, $myfile);


        $company = new Company();
        $company->name = $request->name;
        $company->mission = $request->mission;
        $company->imageUrl = MyConstants::PATH_URL . $destination . '/' . $myfile;
        $company->status = $request->status;
        $company->has_delivery=$request->delivery;
        if ($company->save()) {
            return redirect()->route('view_companies')->with('message', 'Company successfully added');
        } else {
            return back()->with('error', 'Failed to add company');
        }
    }


    public function editCompany($id)
    {
        if (Company::find($id)->exists()) {
            $company = Company::find($id);
            return view('server.relier.company.edit_company', compact('company'));
        } else {
            return redirect()->route('view_companies')->with('error', 'Company with that id do not exists');
        }
    }

    public function updateCompany(Request $request)
    {

        if ($request->file('logo' != null)) {
            $image = $request->file('logo');
            $input['imagename'] = $image->getClientOriginalName();
            $extension = $image->getClientOriginalExtension();
            $myfile = bcrypt($input['imagename']) . '.' . $extension;
            $destination = 'companylogo';
            $image->storeAs($destination, $myfile);

            if ($request->mission != null) {
                $updateCompany = Company::where('id', $request->id)->update([
                    'name' => $request->name,
                    'mission' => $request->mission,
                    'imageUrl' => MyConstants::PATH_URL . $destination . '/' . $myfile,
                    'status' => $request->status,
                    'has_delivery'=>$request->delivery
                ]);

                if ($updateCompany) {
                    return redirect()->route('view_companies')->with('message', 'Company successfully updated');
                } else {
                    return redirect()->route('view_companies')->with('error', 'Failed to update Company');
                }
            }
            else{
                $updateCompany = Company::where('id', $request->id)->update([
                    'name' => $request->name,
                    'imageUrl' => MyConstants::PATH_URL . $destination . '/' . $myfile,
                    'status' => $request->status,
                    'has_delivery'=>$request->delivery
                ]);

                if ($updateCompany) {
                    return redirect()->route('view_companies')->with('message', 'Company successfully updated');
                } else {
                    return redirect()->route('view_companies')->with('error', 'Failed to update Company');
                }

            }
        } else {
            if ($request->mission != null) {
                $updateCompany = Company::where('id', $request->id)->update([
                    'name' => $request->name,
                    'mission' => $request->mission,
                    'status' => $request->status
                ]);

                if ($updateCompany) {
                    return redirect()->route('view_companies')->with('message', 'Company successfully updated');
                } else {
                    return redirect()->route('view_companies')->with('error', 'Failed to update Company');
                }
            } else {
                $updateCompany = Company::where('id', $request->id)->update([
                    'name' => $request->name,
                    'status' => $request->status
                ]);

                if ($updateCompany) {
                    return redirect()->route('view_companies')->with('message', 'Company successfully updated');
                } else {
                    return redirect()->route('view_companies')->with('error', 'Failed to update Company');
                }
            }


        }


    }


    public function viewCompanies()
    {
        $companies = Company::all();
        return view('server.relier.company.view_companies', compact('companies'));
    }


}
