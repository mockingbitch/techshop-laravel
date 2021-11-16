<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
        'productName',
        'productDescription',
        'productContent',
        'productPrice',
        'productImage',
        'categoryId',
        'brandId',
        'productQuantity',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class, 'categoryId');
    }
}
