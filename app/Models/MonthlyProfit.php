<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonthlyProfit extends Model
{
    use HasFactory;

    protected $with = [
        'client',
    ];
    function products(){
        $products = MonthlyProducts::where('id',$this->id)->get();
        return $products;
    }

    function client(){
        return $this->belongsTo(Client::class);

    }


}
