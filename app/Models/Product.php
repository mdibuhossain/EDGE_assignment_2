<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = "products";
    protected $fillable = [
        'name',
        'price',
        'description',
        'category'
    ];
    protected $primaryKey = "product_id";
    public function carts()
    {
        return $this->hasMany(Cart::class, "product_id", "product_id");
    }
}
