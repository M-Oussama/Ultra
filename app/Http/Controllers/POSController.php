<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Command;
use App\Models\PaymentTypes;
use App\Models\product;
use App\Models\Sale;
use App\Models\SalesOperation;
use App\Models\Stock;
use Carbon\Carbon;
use Illuminate\Http\Request;

class POSController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $sales = SalesOperation::with('client')->get();


        return view('dashboard.pos.sales.index')

            ->with('sales',$sales);
    }


    public function create()
    {

        $products = product::with('stock')->get();
        $clients = Client::all();
        $payment_types = [
            [
                "id" => 1,
                "name" => "Espece"
            ],
            [
                "id" => 2,
                "name" => "A Terme"
            ],

        ];

//        foreach ($products as $product){
//            $product->stock->current_stock =  $product->stock->quantity;
//        }



        return view('dashboard.pos.sales.create')
            /*->with('commands',$commands)*/
            ->with('clients',$clients)
            ->with('payment_types',$payment_types)
            ->with('products',$products);
    }

    public function store(Request $request){
        $products = $request->products;
        foreach ($products as $product){
            $db_product = product::find($product['id']);
            if($product['quantity'] > $db_product->stock->quantity)
                 return response()->json(["success"=>false,"stock"=>"Low Stock"]);
        }


        $salesOps = new SalesOperation();
        $salesOps->client_id = $request->client_id;
        $salesOps->amount = $request->total;
        $salesOps->payment = $request->amount;
        $salesOps->date = $request->date;
        $salesOps->rest = $request->rest;
        if($request->rest >= 0)
            $salesOps->paid = true;
        else
            $salesOps->paid = false;
        $salesOps->payment_type = $request->payment_type;
        $salesOps->save();



        foreach ($products as $product){
            $sale = new Sale();
            $sale->sales_operations_id = $salesOps->id;
            $sale->product_id = $product['id'];
            $sale->quantity = $product['quantity'];
            $sale->price = $product['price'];
            $sale->total = $product['amount'];
            $sale->date = $request->date;
            $sale->save();

            $stock = Stock::where('product_id',$product['id'])->get()->first();
            $stock->quantity = $stock->quantity - $product['quantity'];
            $stock->save();
        }



        return response()->json(["success"=>true]);

    }



    public function edit($sale_id){
        $saleOps = SalesOperation::find($sale_id);
        $products = product::with('stock')->get();

        $clients = Client::all();
        $payment_types = [
            [
                "id" => 1,
                "name" => "Espece"
            ],
            [
                "id" => 2,
                "name" => "A Terme"
            ],

        ];
        $sales = Sale::where('sales_operations_id',$sale_id)->with('product.stock')->get();

        foreach ($products as $product){
            $product->stock->current_stock =  $product->stock->quantity;
        }



        return view('dashboard.pos.sales.edit')
            ->with('salesops',$saleOps)
            ->with('clients',$clients)
            ->with('payment_types',$payment_types)
            ->with('sales',$sales)
            ->with('products',$products);

    }


    public function update(Request $request,$saleops_id){

        $products = $request->products;
        foreach ($products as $product){
            $db_product = product::find($product['id']);
            if($product['quantity'] > $db_product->stock->quantity)
                return response()->json(["success"=>false,"stock"=>"Low Stock"]);
        }

        $salesOps = SalesOperation::find($saleops_id);
        $salesOps->client_id = $request->client_id;
        $salesOps->amount = $request->total;
        $salesOps->payment = $request->amount;
        $salesOps->date = $request->date;
        $salesOps->rest = $request->rest;
        if($request->rest >= 0)
            $salesOps->paid = true;
        else
            $salesOps->paid = false;
        $salesOps->payment_type = $request->payment_type;
        $salesOps->save();

        $sales = Sale::where('sales_operations_id',$saleops_id)->get();




        foreach ($sales as $sale)
                $sale->delete();


        foreach ($products as $product){
            $sale = new Sale();
            $sale->sales_operations_id = $salesOps->id;
            $sale->product_id = $product['id'];
            $sale->quantity = $product['quantity'];
            $sale->price = $product['price'];
            $sale->total = $product['price'] * $product['quantity'];
            $sale->date = $request->date;
            $sale->save();
        }
        return response()->json(["success"=>true]);

    }

    public function destroy($id){
        $salesops = SalesOperation::find($id);

        $sales = Sale::where('sales_operations_id',$id)->get();

        foreach ($sales as $sale)
            $sale->delete();

        $salesops->delete();
        session()->flash('type', 'success');
        session()->flash('message', 'Sale deleted successfully.');
        return redirect("/dash/sales");
    }



}
