<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    //fillableプロパティを追加する。
    protected $fillable = [
        'user_id',
        'product_id',
    ];

    //Cart モデルは Product モデルと product_id を介して関連付けられる
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
