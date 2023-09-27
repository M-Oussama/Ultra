<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Traits\HasRoles;

class product extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, Notifiable, HasRoles, InteractsWithMedia;

   // protected $with = ['stock'];

    public function stock(){
        return $this->hasMany(Stock::class);
    }

    public function sells()
    {
        return $this->hasMany(Sale::class);
    }
    public function commandProduct()
    {
        return $this->hasMany(CommandProduct::class);
    }

}
