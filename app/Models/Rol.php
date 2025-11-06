<?php

namespace App\Models;

use App\Utils\ValuesDatabase;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Database\Factories\RolFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Rol newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Rol newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Rol query()
 * @method static \Illuminate\Database\Eloquent\Builder|Rol whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rol whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rol whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rol whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rol whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rol whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Rol extends Model
{
    use HasFactory;

    protected $table = ValuesDatabase::TABLE_ROLS;
    protected $primaryKey = ValuesDatabase::ROL_COLUMN_ID;

    protected $fillable = [
        ValuesDatabase::ROL_COLUMN_NAME,
        ValuesDatabase::ROL_COLUMN_DESCRIPTION,
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class, ValuesDatabase::USER_COLUMN_ROL_ID, ValuesDatabase::ROL_COLUMN_ID);
    }
}
