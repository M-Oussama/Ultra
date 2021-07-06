<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Baladia
 *
 * @property int $id
 * @property string $BALADIA
 * @property string|null $name_ar
 * @property string|null $name_fr
 * @property int|null $daira_id
 * @property string|null $zip
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Baladia newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Baladia newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Baladia query()
 * @method static \Illuminate\Database\Eloquent\Builder|Baladia whereBALADIA($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Baladia whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Baladia whereDairaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Baladia whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Baladia whereNameAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Baladia whereNameFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Baladia whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Baladia whereZip($value)
 * @mixin \Eloquent
 */
class Baladia extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'BALADIA',
        'name_ar',
        'name_fr',
        'daira_id',
        'zip',
    ];

    public function users(){
        return $this->belongsToMany(User::class,'addresses')
            ->withPivot('zip', 'address')
            ->as('address');
    }
}
