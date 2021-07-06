<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Wilaya
 *
 * @property int $id
 * @property string $WILAYA
 * @property string|null $name_ar
 * @property string|null $name_fr
 * @property string|null $zip
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Wilaya newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Wilaya newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Wilaya query()
 * @method static \Illuminate\Database\Eloquent\Builder|Wilaya whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wilaya whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wilaya whereNameAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wilaya whereNameFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wilaya whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wilaya whereWILAYA($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wilaya whereZip($value)
 * @mixin \Eloquent
 */
class Wilaya extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'WILAYA',
        'name_ar',
        'name_fr',
        'zip',
    ];

    public function users(){
        return $this->belongsToMany(User::class,'addresses')
            ->withPivot('zip', 'address')
            ->as('address');
    }
}
