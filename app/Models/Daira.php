<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Daira
 *
 * @property int $id
 * @property string $DAIRA
 * @property string|null $name_ar
 * @property string|null $name_fr
 * @property int|null $wilaya_id
 * @property string|null $zip
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Daira newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Daira newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Daira query()
 * @method static \Illuminate\Database\Eloquent\Builder|Daira whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Daira whereDAIRA($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Daira whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Daira whereNameAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Daira whereNameFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Daira whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Daira whereWilayaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Daira whereZip($value)
 * @mixin \Eloquent
 */
class Daira extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'DAIRA',
        'name_ar',
        'name_fr',
        'wilaya_id',
        'zip',
    ];

    public function users(){
        return $this->belongsToMany(User::class,'addresses')
            ->withPivot('zip', 'address')
            ->as('address');
    }
}
