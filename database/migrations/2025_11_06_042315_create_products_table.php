<?php

use App\Utils\ValuesDatabase;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(ValuesDatabase::TABLE_PRODUCTS, function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger(ValuesDatabase::PRODUCT_COLUMN_TYPE_ID);
            $table->unsignedBigInteger(ValuesDatabase::PRODUCT_COLUMN_SIZE_ID);
            $table->string(ValuesDatabase::PRODUCT_COLUMN_NAME);
            $table->text(ValuesDatabase::PRODUCT_COLUMN_DESCRIPTION)->nullable();
            $table->decimal(ValuesDatabase::PRODUCT_COLUMN_PRICE, 10, 2);
            $table->decimal(ValuesDatabase::PRODUCT_COLUMN_IVA, 5, 2);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign(ValuesDatabase::PRODUCT_COLUMN_TYPE_ID)
                ->references(ValuesDatabase::TYPE_PRODUCT_COLUMN_ID)
                ->on(ValuesDatabase::TABLE_TYPE_PRODUCTS)
                ->onDelete('cascade');

            $table->foreign(ValuesDatabase::PRODUCT_COLUMN_SIZE_ID)
                ->references(ValuesDatabase::PRODUCT_SIZE_COLUMN_ID)
                ->on(ValuesDatabase::TABLE_PRODUCT_SIZES)
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(ValuesDatabase::TABLE_PRODUCTS);
    }
};
