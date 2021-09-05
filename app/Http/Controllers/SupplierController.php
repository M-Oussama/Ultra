<?php

namespace App\Http\Controllers;

use App\Models\AccountType;
use App\Models\Client;
use App\Models\product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mpdf\Tag\Sup;

class SupplierController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $suppliers = Supplier::all();
        return view('dashboard.people.suppliers.index')->with('suppliers',$suppliers);
    }

    public function create()
    {
        $types = AccountType::all();
        return view('dashboard.people.suppliers.create')->with('types',$types);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'surname' => 'required',
        ]);

        if ($validator->fails()) {
            session()->flash('type', "error");
            session()->flash('message', "Please verify your form");
            return redirect('dash/suppliers/create')
                ->withErrors($validator)
                ->withInput();
        }


        $supplier = new Supplier();
        $supplier->name = $request->name;
        $supplier->surname = $request->surname;
        $supplier->email = $request->email;
       // $supplier->phone = $request->phone;
        $supplier->type_id = 1;
        $supplier->debt = $request->debt;
        $supplier->save();

        if (!empty($request->avatar)) {
            $supplier->addMediaFromRequest('avatar')
                ->toMediaCollection('avatars');
        }

        session()->flash('type', 'success');
        session()->flash('message', 'Supplier created successfully.');

        return redirect('dash/suppliers');
    }

    public function edit(Supplier $supplier)
    {
        $types = AccountType::all();
        return view('dashboard.people.suppliers.edit')
            ->with('supplier',$supplier)->with('types',$types);
    }

    public function update(Request $request, Supplier $supplier)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'surname' => 'required',

        ]);

        if ($validator->fails()) {
            session()->flash('type', "error");
            session()->flash('message', "Please verify your form");
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $suppliers = supplier::where('email', $request->input('email'))->get();

        if (count($suppliers) > 0 && $supplier->email != $request->email) {
            session()->flash('type', "warning");
            session()->flash('message', "A Supplier with the same email already exists");

            return redirect('dash/products');
        } else {

            $supplier->name = $request->name;
            $supplier->surname = $request->surname;
            $supplier->email = $request->email;
            $supplier->sold = $request->sold;
            $supplier->type_id = 1;
            $supplier->NRC = $request->nrc;
            $supplier->NIF = $request->nif;
            $supplier->NART = $request->nart;
            $supplier->NIS = $request->nis;
            $supplier->save();

            if (!empty($request->avatar)) {
                if (!empty($supplier->getFirstMedia('avatars'))) {
                    $supplier->getFirstMedia('avatars')->delete();
                }
                $supplier->addMediaFromRequest('avatar')
                    ->toMediaCollection('avatars');
            }

            if (!empty($request->avatar_remove)){
                $supplier->getFirstMedia('avatars')->delete();
            }

            session()->flash('type', 'success');
            session()->flash('message', 'Supplier Data updated successfully.');

            return redirect('dash/suppliers');
        }
    }

}
