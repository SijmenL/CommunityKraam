<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['title', 'subtitle', 'description', 'price', 'product_owner', 'image', 'valuta', 'private'];

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }}
