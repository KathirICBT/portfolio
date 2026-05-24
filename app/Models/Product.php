<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'description',
        'product_number',
        'category_id',
        'price',
        'quantity',
        'unit_type',
        'unit_value',
        'image',
    ];

    // CATEGORY RELATIONSHIP
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}