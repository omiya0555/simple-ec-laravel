<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseItem extends Model
{
    use HasFactory;

    /**
     * テーブル名の指定
     *
     * @var string
     */
    protected $table = 'purchase_items';

    /**
     * マスアサインメント可能な属性
     *
     * @var array
     */
    protected $fillable = [
        'purchase_detail_id',
        'product_id',
        'quantity',
        'product_price',
        'product_image_path',
        'product_title',
        'product_description',
    ];

    /**
     * リレーションシップ：購入明細とのリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function purchaseDetail()
    {
        return $this->belongsTo(PurchaseDetail::class);
    }

    /**
     * リレーションシップ：商品とのリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
