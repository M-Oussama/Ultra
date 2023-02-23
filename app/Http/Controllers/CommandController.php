<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ChiffreEnLettre;
use App\Models\Command;
use App\Models\CommandProduct;
use App\Models\product;
use App\Models\Client;
use App\Models\PaymentTypes;

use Carbon\Carbon;
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


        return view('dashboard.commands.index')

        ->with('commands',$commands);
    }

    public function create()
    {
        $commands = Command::all();
        $products = product::all();
        $clients = Client::all();
        $payment_types = PaymentTypes::all();
        $last_id = 0;
        if(count($commands) >0){
            $last_id = Command::whereBetween('date', [
                Carbon::now()->startOfYear(),
                Carbon::now()->endOfYear(),
            ])->orderBy('fac_id')->get()->last();
            if($last_id != null)
                $last_id = $last_id->fac_id;
        }else
            $last_id = 0;

        return view('dashboard.commands.create_client_command')
            ->with('commands',$commands)
            ->with('clients',$clients)
             ->with('payment_types',$payment_types)
            ->with('products',$products)
            ->with('last_id',$last_id);
    }

    public function store(Request $request)
    {

        $products = $request->products;
        $fac_id = $request->fac_id;
        $fac_date = date('Y-m-d',strtotime($request->fac_date));
        $client = Client::find($request->client_id);
        $command = new Command();
        $command->fac_id = $fac_id;
        $command->date = $fac_date;
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
        $clients = Client::all();
        $command_products = CommandProduct::where('command_id',$command_id)->get();
       // return response()->json(["data"=>$command_products]);
        return view('dashboard.commands.edit_client_command2')
            ->with('commands',$commands)
            ->with('clients',$clients)
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
        $command_product->amount = $product['price']*$product['quantity'];
        $command_product->save();
        $amount += $product['price']*$product['quantity'];
        }
        $command->amount = $amount;
        $command->client_id = $request->client_id;
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
                $centime =  $lettre->Conversion($float)." Centimes";
            }
            $amountLetter = $amountLetter.$centime;
        }else{
            $amountLetter =  $lettre->Conversion($amountTax)."Dinar(s)";

        }
         return view('ultra_invoice')->with((["amountLetter"=>$amountLetter,"commandProducts"=>$commandProducts, "command"=>$command]));
    }


    function int2str($a)
    {
        $convert = explode('.',$a);
        if (isset($convert[1]) && $convert[1]!=''){
            return $this->int2str($convert[0]).'Dinars'.' et '.$this->int2str($convert[1]).'Centimes' ;
        }
        if ($a<0) return 'moins '.int2str(-$a);
        if ($a<17){
            switch ($a){
                case 0: return 'zero';
                case 1: return 'un';
                case 2: return 'deux';
                case 3: return 'trois';
                case 4: return 'quatre';
                case 5: return 'cinq';
                case 6: return 'six';
                case 7: return 'sept';
                case 8: return 'huit';
                case 9: return 'neuf';
                case 10: return 'dix';
                case 11: return 'onze';
                case 12: return 'douze';
                case 13: return 'treize';
                case 14: return 'quatorze';
                case 15: return 'quinze';
                case 16: return 'seize';
            }
        } else if ($a<20){
            return 'dix-'.$this->int2str($a-10);
        } else if ($a<100){
            if ($a%10==0){
                switch ($a){
                    case 20: return 'vingt';
                    case 30: return 'trente';
                    case 40: return 'quarante';
                    case 50: return 'cinquante';
                    case 60: return 'soixante';
                    case 70: return 'soixante-dix';
                    case 80: return 'quatre-vingt';
                    case 90: return 'quatre-vingt-dix';
                }
            } elseif (substr($a, -1)==1){
                if( ((int)($a/10)*10)<70 ){
                    return $this->int2str((int)($a/10)*10).'-et-un';
                } elseif ($a==71) {
                    return 'soixante-et-onze';
                } elseif ($a==81) {
                    return 'quatre-vingt-un';
                } elseif ($a==91) {
                    return 'quatre-vingt-onze';
                }
            } elseif ($a<70){
                return $this->int2str($a-$a%10).'-'.$this->int2str($a%10);
            } elseif ($a<80){
                return $this->int2str(60).'-'.$this->int2str($a%20);
            } else{
                return $this->int2str(80).'-'.$this->int2str($a%20);
            }
        } else if ($a==100){
            return 'cent';
        } else if ($a<200){
            return $this->int2str(100).' '.$this->int2str($a%100);
        } else if ($a<1000){
            return $this->int2str((int)($a/100)).' '.$this->int2str(100).' '.$this->int2str($a%100);
        } else if ($a==1000){
            return 'mille';
        } else if ($a<2000){
            return $this->int2str(1000).' '.$this->int2str($a%1000).' ';
        } else if ($a<1000000){
            return $this->int2str((int)($a/1000)).' '.$this->int2str(1000).' '.$this->int2str($a%1000);
        }
        else if ($a==1000000){
            return 'millions';
        }
        else if ($a<2000000){
            return $this->int2str(1000000).' '.$this->int2str($a%1000000).' ';
        }
        else if ($a<1000000000){
            return $this->int2str((int)($a/1000000)).' '.$this->int2str(1000000).' '.$this->int2str($a%1000000);
        }
    }

    function getLastYearID($year){

        $last_id = Command::whereYear('date',$year)->orderBy('fac_id')->get()->last();

          if($last_id == null)
               $last_id = 0;
          else
              $last_id = $last_id->fac_id;
        return \response()->json(["ID"=>$last_id]);
    }

}
