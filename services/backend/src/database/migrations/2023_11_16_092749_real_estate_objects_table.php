<?php

use App\Models\RealEstateObject;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(RealEstateObject::getTableName(), function (Blueprint $table) {
            $table->id();

            $table->string('cadastral_number', 120)
                ->comment('Кадастровый номер');

            $table->text('address')
                ->comment('Адрес');

            $table->json('full_data')
                ->comment('Полные данные объекта');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(RealEstateObject::getTableName());
    }
};
