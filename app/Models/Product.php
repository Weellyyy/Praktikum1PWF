<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'qty',
        'price',
    ];

    public function kategori()
    {
        return $this->hasMany(Kategori::class);
    }
}
