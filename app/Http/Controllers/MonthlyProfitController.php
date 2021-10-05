<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\MonthlyProducts;
use App\Models\MonthlyProfit;
use App\Models\Profit;
use App\Models\product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MonthlyProfitController extends Controller
{

    public function index()
    {
        $profits = Profit::all();
        $months = ["January","February","March","April","May","June","July","August","September","October","November","December"];
        $clients = Client::all();
        $years = range(date('Y'), 2000);

        return view('dashboard.monthlyProfit.show')
            ->with('months',$months)
            ->with('years',$years)
            ->with('clients',$clients)
            ->with('monthlyProfits',$profits);
    }

    public function create()
    {
        $months = ["January","February","March","April","May","June","July","August","September","October","November","December"];
        $years = range(date('Y'), 2000);
        $products = product::all();
        $clients = Client::all();
        return view('dashboard.monthlyProfit.create')
            ->with('months',$months)
            ->with('products',$products)
            ->with('years',$years)
            ->with('clients',$clients);
    }

    public function store(Request $request, $client_id,$month,$year)
    {


        $profitExists = Profit::where('month',$month)->where('year',$year)->exists();


        if($profitExists)
            $profit = Profit::where('month',$month)->where('year',$year)->first();
        else
            $profit = new Profit();

        $monthlyProfit = new MonthlyProfit();
        $monthlyProduct = new MonthlyProducts();
        $products = $request->products;


        $profit->month = $month;
        $profit->year = $year;
        $profit->save();



        $monthlyProfit->client_id = $client_id;
        $monthlyProfit->date  = Carbon::now();
        $monthlyProfit->month  = $month;
        $monthlyProfit->profit_id = $profit->id;
        $monthlyProfit->save();
        $totale = 0;

        foreach ($products as $product){
            $monthlyProduct->product_id = $product["id"];
            $monthlyProduct->monthly_profits_id = $monthlyProfit->id;
            $monthlyProduct->product_monthly_profit = $request["monthlyQuantity"];
            $monthlyProduct->quantity = $request["monthlyProfit"];
            $monthlyProduct->save();
            $totale+= ($request["monthlyQuantity"]*$request["monthlyProfit"]);
        }
        $profit->profit += $profit->profit + $totale;
        $profit->save();

        $monthlyProfit->profit = $totale;
        $monthlyProfit->save();

        return response()->json(["data"=>true]);
    }

    public function show($profit_id)
    {
        $clients = Client::all();
        $monthlyProfit = MonthlyProfit::where('profit_id',$profit_id)->get();
        return view('dashboard.monthlyProfit.index')
            ->with('monthlyProfits',$monthlyProfit)
            ->with('clients',$clients);

    }
}
