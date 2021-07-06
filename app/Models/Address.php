<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Address
 *
 * @property int $id
 * @property int|null $user_id
 * @property string|null $address
 * @property int|null $wilaya_id
 * @property int|null $daira_id
 * @property int|null $baladia_id
 * @property int|null $country_id
 * @property string|null $zip
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Address newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Address newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Address query()
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereBaladiaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereDairaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereWilayaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereZip($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Baladia|null $baladia
 * @property-read \App\Models\Country|null $country
 * @property-read \App\Models\Daira|null $daira
 * @property-read \App\Models\Wilaya|null $wilaya
 */
class Address extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'address',
        'wilaya_id',
        'daira_id',
        'baladia_id',
        'country_id',
        'zip',
    ];

    protected $with = [
        'wilaya',
        'daira',
        'baladia',
        'country',
    ];

    public function wilaya() {
        return $this->belongsTo(Wilaya::class);
    }

    public function daira() {
        return $this->belongsTo(Daira::class);
    }

    public function baladia() {
        return $this->belongsTo(Baladia::class);
    }

    public function country() {
        return $this->belongsTo(Country::class);
    }
}
