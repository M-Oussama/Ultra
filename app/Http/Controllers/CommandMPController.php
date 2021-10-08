<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Command;
use App\Models\product;
use Illuminate\Http\Request;

class CommandMPController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $commands = Command::with('client')->get();

        return view('dashboard.commandsMP.index')->with('commands',$commands);
    }
    public function create()
    {
        $commands = Command::all();
        $products = product::all();
        $clients = Client::all();
        return view('dashboard.commandsMP.create_client_command')
            ->with('commands',$commands)
            ->with('clients',$clients)
            ->with('products',$products);
    }
}
