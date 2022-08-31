<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\MonthlyClientProfit;
use App\Models\product;
use App\Models\ProductMonthlyProfit;
use App\Models\Profit;
use Illuminate\Http\Request;

class ProfitController extends Controller
{
    public function index(){
        $profits = Profit::all();
        return view('dashboard.profit.index')->with('profits',$profits);
    }
    public function create(){
        $products = product::all();
        $months = [1=> "January",2=>"February",3=>"March",4=>"April",5=>"May",6=>"June",7=>"July ",8=>"August",9=>"September",10=>"October",11=>"November",12=>"December"];
        return view('dashboard.profit.create')->with('products',$products)->with('months',$months);
    }
    public function store(Request $request){
        $products = product::all();

        foreach ($products as $product){
            $object = new ProductMonthlyProfit();
            $object->month = $request->input('month');
            $object->product_id = $product->id;
            $object->depositor = true;
            $object->profit = $request->input('profit_depo_'.$product->id);
            $object->save();
        }

        foreach ($products as $product){
            $object = new ProductMonthlyProfit();
            $object->month = $request->input('month');
            $object->product_id = $product->id;
            $object->depositor = false;
            $object->profit = $request->input('profit_camion_'.$product->id);
            $object->save();
        }


        return redirect('/dash/profit');
    }

    public function createClientProfit(){
        $depositorProfit = MonthlyClientProfit::where('month',1)->get();
        $clients = Client::all();
        $products = product::all();
        $months = [1=> "January",2=>"February",3=>"March",4=>"April",5=>"May",6=>"June",7=>"July ",8=>"August",9=>"September",10=>"October",11=>"November",12=>"December"];
        return view('dashboard.profit.client.create')->with('months',$months)->with('products',$products)->with('clients',$clients);
    }

    public function StoreClientProfit(Request $request){
        $products = product::all();

        foreach ($products as $product){
            // return $request->input('product_id_'.$product->id);
            $object = new MonthlyClientProfit();
            $object->month = $request->month;
            $object->product_id = $product->id;
            $object->client_id = $request->client_id;
            $object->quantity = $request->input('profit_'.$product->id);
            $object->profit = $request->input('quantity_'.$product->id);
            $object->save();
        }
        return redirect('/dash/profit');
    }

    public function getMonthlyProfit($client_id,$month){
        $client = Client::find($client_id);
        $profits = ProductMonthlyProfit::where('depositor',$client->depositor)->where('month',$month)->get();
        return response()->json(["data"=>$profits]);
    }
}
