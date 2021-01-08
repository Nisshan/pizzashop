<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Delivery extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
      'created_at' => 'datetime:Y-m-d'
    ];

    public function setDeliveryTypeAttribute($delivery_type)
    {
        $this->attributes['delivery_type'] = ucwords($delivery_type);
        $this->attributes['slug'] = $this->slug($delivery_type);
    }

    private function slug($name)
    {
        $slug = Str::slug($name);
        $count = Delivery::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();

        if (request()->method() == 'PATCH') {
            return $this->slug == $slug ? $slug : "{$slug}-{$count}";
        }

        return $count ? "{$slug}-{$count}" : $slug;
    }

}
