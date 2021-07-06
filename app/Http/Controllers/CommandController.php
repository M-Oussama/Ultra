<?php

namespace App\Http\Controllers;

use App\Models\Command;
use App\Models\product;
use App\Models\Client;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class CommandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $commands = Command::all();

        return view('dashboard.commands.index')->with('commands',$commands);
    }

    public function create($client_id)
    {
        $commands = Command::all();
        $products = product::all();
        $client = Client::find($client_id);
        return view('dashboard.commands.create_client_command')
            ->with('commands',$commands)
            ->with('client',$client)
            ->with('products',$products);
    }

    public function store(Response $response)
    {
        return response()->json(["data"=>$response->products]);
    }
}
