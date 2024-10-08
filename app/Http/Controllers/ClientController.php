<?php

namespace App\Http\Controllers;

use App\Models\AccountType;
use App\Models\Address;
use App\Models\Client;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $clients = Client::all();
        return view('dashboard.people.clients.index')->with('clients',$clients);
    }

    public function create()
    {
        $types = AccountType::all();
        return view('dashboard.people.clients.create')->with('types',$types);
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
            return redirect('dash/clients/create')
                ->withErrors($validator)
                ->withInput();
        }

        $clients = Client::where('email', $request->input('email'))->get();


        if (count($clients) > 0 ) {
            session()->flash('type', "warning");
            session()->flash('message', "A Client with the same email already exists");

            return redirect('dash/products');
        }else{


            $client = new Client();
            $client->name = $request->name;
            $client->surname = $request->surname;
            $client->email = $request->email;
            $client->sold = $request->sold;
            $client->address = $request->address;
            $client->profession = $request->profession;
            $client->type_id = 1;
            $client->NRC = $request->nrc;
            $client->NIF = $request->nif;
            $client->NART = $request->nart;
            $client->NIS = $request->nis;
            $client->save();

            if (!empty($request->avatar)) {
                $client->addMediaFromRequest('avatar')
                    ->toMediaCollection('avatars');
            }

            session()->flash('type', 'success');
            session()->flash('message', 'Product created successfully.');

            return redirect('dash/clients');
        }

    }

    public function edit(Client $client)
    {
        $types = AccountType::all();
        return view('dashboard.people.clients.edit')
            ->with('client',$client)->with('types',$types);

    }

    public function update(Request $request, Client $client)
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

        $clients = Client::where('email', $request->input('email'))->get();

        if (count($clients) > 0 && $client->email != $request->email) {
            session()->flash('type', "warning");
            session()->flash('message', "A Client with the same email already exists");

            return redirect('dash/products');
        } else {

            $client->name = $request->name;
            $client->surname = $request->surname;
            $client->email = $request->email;
            $client->sold = $request->sold;
            $client->address = $request->address;
            $client->profession = $request->profession;
            $client->type_id = 1;
            $client->NRC = $request->nrc;
            $client->NIF = $request->nif;
            $client->NART = $request->nart;
            $client->NIS = $request->nis;
            $client->save();

            if (!empty($request->avatar)) {
                if (!empty($client->getFirstMedia('avatars'))) {
                    $client->getFirstMedia('avatars')->delete();
                }
                $client->addMediaFromRequest('avatar')
                    ->toMediaCollection('avatars');
            }

            if (!empty($request->avatar_remove)){
                $client->getFirstMedia('avatars')->delete();
            }

            session()->flash('type', 'success');
            session()->flash('message', 'Client updated successfully.');

            return redirect('dash/clients');
        }
    }
}
