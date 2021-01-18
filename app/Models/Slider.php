<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'created_at' => 'date:Y-M-d',
    ];

    public function path()
    {
        return url('storage/images/' . $this->path);
    }
}
