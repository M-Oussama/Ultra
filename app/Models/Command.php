<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Command extends Model
{
    use HasFactory;

    protected $with = ['client','payment'];
    protected $casts = [
        'timber' => 'boolean',
    ];
    protected $fillable=[
        'fac_id',
        'date',
        'client_id',
        'payment_type',
        'timber',
        'timber_val',
    ];
    public function client(){
        return $this->belongsTo(Client::class);
    }
     public function payment(){
        return $this->belongsTo(PaymentTypes::class,'payment_type','id');
    }
}
