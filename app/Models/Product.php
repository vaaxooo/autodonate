<?php

namespace App\Models;

use App\Helpers\MoneyFormat;
use Cknow\Money\Money;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use NumberFormatter;

class Product extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        'shop_id',
        'category_id',
        'name',
        'description',
        'image',
        'name',
        'issuance_command',
        'withdraw_command',
        'withdraw_command_timeout',
        'price',
        'position',
        'active'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function shop()
    {
        return $this->belongsTo(Shop::class, 'shop_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function formatPrice()
    {
        return (new MoneyFormat)->money($this->price);
    }

}
