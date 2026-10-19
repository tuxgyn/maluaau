<?php
// app/Models/Product.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'category', 'description', 'price', 'stock', 'active'];

    protected $casts = [
        'price' => 'decimal:2',
        'active' => 'boolean',
    ];

    public function scopeAvailable($query)
    {
        return $query->where('active', true)->where('stock', '>', 0);
    }
}