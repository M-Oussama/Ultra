<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompanyProfile;

class CompanyProfileController extends Controller
{
    //
    function edit(){
        $company = CompanyProfile::find(1);

        return view('dashboard.company.editCompany')
                     ->with('company',$company);
    }
    function update(Request $request){
        $company = CompanyProfile::find(1);
         $company->name = $request->name;
        $company->email = $request->email;
        $company->address = $request->address;
        $company->phone = $request->phone;
        $company->capital = $request->capital;
        $company->NRC = $request->nrc;
        $company->NIF = $request->nif;
        $company->NART = $request->nart;
        $company->NIS = $request->nis;

          if (!empty($request->avatar)) {
            if (!empty($company->getFirstMedia('avatars'))) {
                $company->getFirstMedia('avatars')->delete();
            }
            $company->addMediaFromRequest('avatar')
                ->toMediaCollection('avatars');
        }

        if (!empty($request->avatar_remove)){
            $company->getFirstMedia('avatars')->delete();
        }

        session()->flash('type', 'success');
        session()->flash('message', 'Company updated successfully.');
        $company->save();
          return redirect('/dash');
    }
}
