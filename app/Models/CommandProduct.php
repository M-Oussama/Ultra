<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommandProduct extends Model
{
    use HasFactory;

    protected $with = [
        'command',
        'product'
    ];
    public function command(){
        return $this->belongsTo(Command::class);
    }
    public function product(){
       return $this->belongsTo(product::class);
    }
}
