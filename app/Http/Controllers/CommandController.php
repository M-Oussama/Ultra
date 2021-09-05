<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ChiffreEnLettre;
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
    public function edit($command_id){
        $commands = Command::find($command_id);
        $products = product::all();
        $command_products = CommandProduct::where('command_id',$command_id)->get();
       // return response()->json(["data"=>$command_products]);
        return view('dashboard.commands.edit_client_command')
            ->with('commands',$commands)
            ->with('command_products',$command_products)
            ->with('products',$products);

    }

    public function update(Request $request,$command_id)
    {
        $products = $request->products;
        $commandProducts = CommandProduct::where('command_id',$command_id)->get();
        $amount = 0;
        $command = Command::find($command_id);

       foreach ($commandProducts as $commandProduct)
            $commandProduct->delete();

        foreach ($products as $product){
        $command_product = new CommandProduct();
        $command_product->command_id = $command_id;
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

    public function destroy($command_id){
        $command = Command::find($command_id);
        $commandProducts = CommandProduct::where('command_id',$command_id)->get();

        foreach ($commandProducts as $commandProduct)
            $commandProduct->delete();

        $command->delete();

    }
    function isDecimal( $val )
    {
        return is_numeric( $val ) && floor( $val ) != $val;
    }
    public function viewInvoice($command_id){
        $command = Command::find($command_id);
        $lettre =new ChiffreEnLettre();

        $commandProducts = CommandProduct::where('command_id',$command_id)->get();
        $amountTax = $command->amount*1.19;
        if($this->isDecimal($amountTax)){
            list($int, $float) = explode('.',  $amountTax);
            $amountLetter =  $lettre->Conversion($int)." Dinar(s)";
            $centime = "";
            if($float>0){
                $centime =  $lettre->Conversion($float)." Cts";
            }
            $amountLetter .= $amountLetter.$centime;
        }else{
            $amountLetter =  $lettre->Conversion($amountTax)."Dinar(s)";

        }
         return view('invoice')->with((["amountLetter"=>$amountLetter,"commandProducts"=>$commandProducts, "command"=>$command]));
    }

}
