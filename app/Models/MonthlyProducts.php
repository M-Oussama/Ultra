<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonthlyProducts extends Model
{
    use HasFactory;
    protected $with = [
        'product',

    ];
    function monthlyProfit(){
        return $this->belongsTo(MonthlyProfit::class);
    }
    function product(){
        return $this->belongsTo(product::class);
    }
}
