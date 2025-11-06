<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|TypeProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TypeProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TypeProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|TypeProduct whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TypeProduct whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TypeProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TypeProduct whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TypeProduct whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class TypeProduct extends Model
{
    use HasFactory;
}
