<?php

namespace App\Http\Controllers;

use App\Models\Command;
use App\Models\CommandProduct;
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
        $commands = Command::with('client')->get();

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

    public function store(Request $request)
    {
        $products = $request->products;
        $client = Client::find($request->client_id);

        $command = new Command();
        $command->date = date("Y-m-d H:i:s");
        $command->client_id = $client->id;
        $command->payment_type = $request->payment_type;
        $command->save();
        $amount = 0;

        foreach ($products as $product){
            $command_product = new CommandProduct();
            $command_product->command_id = $command->id;
            $command_product->product_id = $product['id'];
            $command_product->price = $product['price'];
            $command_product->quantity = $product['quantity'];
            $command_product->amount = $product['amount'];
            $command_product->save();
            $amount += $product['amount'];
        }
        $command->amount = $amount;
        $command->save();

        return response()->json(["success"=>true]);
    }
    public function createCommandReturn($id){
        $commands = Command::find($id);
        $products = product::all();
        $command_products = CommandProduct::with('product')->get();
        return view('dashboard.commands.create_return_command')
            ->with('commands',$commands)
            ->with('command_products',$command_products)
            ->with('products',$products);

    }
}
