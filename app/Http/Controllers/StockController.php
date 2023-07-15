<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $products = Stock::with('product')->get();


        return view('dashboard.pos.stock.index')

            ->with('products',$products);
    }
}
