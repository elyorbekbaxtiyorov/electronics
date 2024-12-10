<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['name', 'description']; // Added 'description' if it's used in your forms

    /**
     * Establish a relationship with the Product model.
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
