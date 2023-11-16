<?php

use App\Models\RealEstateObject;
use App\Models\RealEstateObjectQuery;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(RealEstateObjectQuery::getTableName(), function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id')
                ->comment('ID пользователя, отправившего запрос');
            // Ограничения внешнего ключа
            $table->foreign('user_id')->references('id')->on(User::getTableName());

            $table->unsignedBigInteger('real_estate_object_id')
                ->nullable()
                ->comment('ID объекта недвижимости');
            // Ограничения внешнего ключа
            $table->foreign('real_estate_object_id')->references('id')->on(RealEstateObject::getTableName());

            $table->boolean('status')
                ->comment('Статус запроса');

            $table->string('text_status', 126)
                ->comment('Описание статуса запроса');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(RealEstateObjectQuery::getTableName());
    }
};
