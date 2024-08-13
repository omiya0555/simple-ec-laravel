<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'product_id',
        'status',
        'title',
        'description',
        'price',
        'image_path',
        'created_at',
        'updated_at',
    ];

    // user_idとusersテーブルとの関連付け
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // product_idとproductsテーブルとの関連付け
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
