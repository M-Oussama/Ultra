<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;


    protected $with = ['product'];

    public function product(){
        return $this->belongsTo(product::class);
    }
}
