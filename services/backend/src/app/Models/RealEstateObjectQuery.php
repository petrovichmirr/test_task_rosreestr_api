<?php

namespace App\Models;

use App\Models\Utils\GetTableName;
use Illuminate\Database\Eloquent\Model;

/**
 * Запрос к базе объектов недвижимости
 *
 * Class RealEstateObjectQuery
 * @package App\Models
 */
class RealEstateObjectQuery extends Model
{
    use GetTableName;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'real_estate_object_queries';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'id',
        'user_id',
        'real_estate_object_id',
        'status',
        'text_status',
    ];
}
