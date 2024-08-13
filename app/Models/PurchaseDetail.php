<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseDetail extends Model
{
    use HasFactory;

    /**
     * テーブル名の指定
     *
     * @var string
     */
    protected $table = 'purchase_details';

    /**
     * マスアサインメント可能な属性
     *
     * @var array
     */
    protected $fillable = [
        'total_amount',
        'status',
        'user_id',
    ];

    /**
     * リレーションシップ：ユーザーとのリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * リレーションシップ：購入商品とのリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function purchaseItems()
    {
        return $this->hasMany(PurchaseItem::class);
    }
}
