<?php

namespace App\Models;

use App\Models\Utils\GetTableName;
use Illuminate\Database\Eloquent\Model;

/**
 * Данные объекта недвижимости
 *
 * Class RealEstateObject
 * @package App\Models
 */
class RealEstateObject extends Model
{
    use GetTableName;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'real_estate_objects';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'id',
        'cadastral_number',
        'address',
        'record_created_at',
        'record_updated_at',
        'owners_count',
        'restrictions_count',
        'full_data',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'record_created_at' => 'date:Y-m-d',
        'record_updated_at' => 'date:Y-m-d',
        'full_data' => 'object',
    ];

    /**
     * The attributes that should be visible in serialization.
     *
     * @var array<string>
     */
    protected $visible = [
        'cadastral_number',
        'address',
        'record_created_at',
        'record_updated_at',
        'owners_count',
        'restrictions_count',
    ];
}
