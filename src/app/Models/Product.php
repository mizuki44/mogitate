<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'image',
        'description',
    ];

    const ORDER_DEFAULT = '0';
    const ORDER_HIGHER = '1';
    const ORDER_LOWER = '2';
    const LIST = [
        'default' => self::ORDER_DEFAULT,
        'higherPrice' => self::ORDER_HIGHER,
        'lowerPrice' => self::ORDER_LOWER,
    ];

    public function productSeason()
    {
        return $this->hasMany(ProductSeason::class);
    }

    //受け取ったseason_idを選択しているか判定
    public function is_season($season_id)
    {
        return $this->productSeason()->where('season_id', $season_id)->exists();
    }

    // キーワード検索
    public function scopeSearchKeyword($query, $keyword)
    {
        if (!is_null($keyword)) {
            $query->where('name', 'like', '%' . $keyword . '%');
        }
    }

    // 価格で並べ替え
    public function scopeSortOrder($query, $sort_order)
    {
        if (!is_null($sort_order)) {
            if ($sort_order === self::LIST['higherPrice']) {
                $query->orderBy('price', 'desc');
            } elseif ($sort_order === self::LIST['lowerPrice']) {
                $query->orderBy('price', 'asc');
            }
        }
    }
}
