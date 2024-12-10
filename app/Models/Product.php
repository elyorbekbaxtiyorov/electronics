<?php

namespace App\Models;
use App\Models\Product;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'name', 'description', 'price'];

    // Kategoriya bilan aloqani o'rnatish
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
