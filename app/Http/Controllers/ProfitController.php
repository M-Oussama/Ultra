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
        $profits = ProductMonthlyProfit::all();
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
            $object->depositor = $request->input('profit_depo_'.$product->id);
            $object->camion = $request->input('profit_camion_'.$product->id);
            $object->save();
        }

        return redirect('/dash/profit');
    }

    public function createClientProfit(){
        $monthlyProfit = ProductMonthlyProfit::where('month',1)->get();
        $clients = Client::all();
        $products = product::all();
        $months = [1=> "January",2=>"February",3=>"March",4=>"April",5=>"May",6=>"June",7=>"July ",8=>"August",9=>"September",10=>"October",11=>"November",12=>"December"];
        return view('dashboard.profit.client.create')->with('month',1)->with('months',$months)->with('products',$monthlyProfit)->with('clients',$clients);
    }

    public function getMonthlyProfit($month){
        $monthlyProfit = ProductMonthlyProfit::where('month',$month)->get();
        $clients = Client::all();
        $products = product::all();
        $months = [1=> "January",2=>"February",3=>"March",4=>"April",5=>"May",6=>"June",7=>"July ",8=>"August",9=>"September",10=>"October",11=>"November",12=>"December"];
        return view('dashboard.profit.client.create')->with('month',$month)->with('months',$months)->with('products',$monthlyProfit)->with('clients',$clients);
    }
    public function StoreClientProfit(Request $request){
        $products = product::all();
        $client =  json_decode((string) $request->client,true);

        foreach ($products as $product){

            $object = new MonthlyClientProfit();
            $object->month = $request->month;
            $object->product_id = $product->id;
            $object->client_id = $client['id'];
            $object->quantity = $request->input('quantity_'.$product->id);
            $object->profit = $request->input('profit_'.$product->id);
            $object->save();
        }
        return redirect('/dash/profit');
    }


}
