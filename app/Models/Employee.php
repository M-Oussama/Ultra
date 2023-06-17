<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Traits\HasRoles;

class Employee extends Model implements HasMedia
{
    use HasFactory, Notifiable, HasRoles, InteractsWithMedia;



    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function leaveApplications(){
        return $this->hasMany(LeaveApplications::class);
    }
}
