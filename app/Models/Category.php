<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'created_at' => 'date:Y-M-d'
    ];

    protected static function booted()
    {
        Category::creating(function ($model) {
            if (auth()->user()) {
                $model->user_id = auth()->id();
                $model->position = Category::count() + 1;
            }
        });
    }

    public function setNameAttribute($name)
    {
        $this->attributes['name'] = ucwords($name);
        $this->attributes['slug'] = $this->slug($name);
    }


    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    public function products(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }


    private function slug($name)
    {
        $slug = Str::slug($name);
        $count = Category::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();

        if (request()->method() == 'PATCH') {
            return $this->slug == $slug ? $slug : "{$slug}-{$count}";
        }

        return $count ? "{$slug}-{$count}" : $slug;
    }
}
