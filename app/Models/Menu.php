<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Menu
 *
 * @property int $id
 * @property int|null $menu_id
 * @property string|null $name
 * @property string|null $url
 * @property int|null $order
 * @property string|null $icon
 * @property int $isSection
 * @property int $isHidden
 * @property string|null $permissions
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|Menu[] $children
 * @property-read int|null $children_count
 * @property-read \Illuminate\Database\Eloquent\Collection|Menu[] $childrenAll
 * @property-read int|null $children_all_count
 * @property-read Menu|null $parent
 * @method static \Illuminate\Database\Eloquent\Builder|Menu newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Menu newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Menu query()
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereIsHidden($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereIsSection($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereMenuId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu wherePermissions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereUrl($value)
 * @mixin \Eloquent
 */
class Menu extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'menu_id',
        'name',
        'url',
        'icon',
        'order',
        'hasSection',
        'permissions',
        'isHidden',
    ];

    public function parent(){
        return $this->belongsTo('App\Models\Menu','menu_id');
    }

    public function children(){
        return $this->hasMany('App\Models\Menu','menu_id')->where('isHidden',false)->orderBy('order','asc');
    }

    public function childrenAll(){
        return $this->hasMany('App\Models\Menu','menu_id')->orderBy('order','asc');
    }

    public function checkUrl($menu, $url){
        $hasUrl = false;
        if(fnmatch($menu->url, $url)){
            $hasUrl = true;
        }else {
            foreach ($menu->childrenAll as $child){
                $hasUrl = $this->checkUrl($child, $url);
                if ($hasUrl)
                    break;
            }
        }
        return $hasUrl;
    }

    public function getPermissions($menu){
        $permissions = array();
        if (!empty($menu->permissions))
            $permissions = explode(" ", $menu->permissions);

        foreach ($menu->children as $child)
            if (!empty($child->permissions))
                $permissions = array_merge($permissions,explode(" ", $child->permissions));

        return $permissions;
    }

}
