<?php

namespace App\Models\Utils;

use Illuminate\Database\Eloquent\Model;

trait GetTableName
{
    /**
     * @return string Имя связанной с моделью таблицы
     */
    public static function getTableName(): string
    {
        /**
         * @var Model static
         */
        return (new static())->getTable();
    }
}
