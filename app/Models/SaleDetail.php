<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $sale_id
 * @property int $product_id
 * @property string $price_total
 * @property int $quantity
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|SaleDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SaleDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SaleDetail query()
 * @method static \Illuminate\Database\Eloquent\Builder|SaleDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleDetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleDetail wherePriceTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleDetail whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleDetail whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleDetail whereSaleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleDetail whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SaleDetail extends Model
{
    use HasFactory;
}
