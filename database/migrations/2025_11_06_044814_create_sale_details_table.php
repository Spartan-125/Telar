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
        Schema::create(ValuesDatabase::TABLE_SALE_DETAILS, function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger(ValuesDatabase::SALE_DETAIL_COLUMN_SALE_ID);
            $table->unsignedBigInteger(ValuesDatabase::SALE_DETAIL_COLUMN_PRODUCT_ID);
            $table->decimal(ValuesDatabase::SALE_DETAIL_COLUMN_PRICE_TOTAL, 10, 2);
            $table->integer(ValuesDatabase::SALE_DETAIL_COLUMN_QUANTITY);
            $table->timestamps();

            $table->foreign(ValuesDatabase::SALE_DETAIL_COLUMN_SALE_ID)
                  ->references(ValuesDatabase::SALE_COLUMN_ID)
                  ->on(ValuesDatabase::TABLE_SALES)
                  ->onDelete('cascade');

            $table->foreign(ValuesDatabase::SALE_DETAIL_COLUMN_PRODUCT_ID)
                  ->references(ValuesDatabase::PRODUCT_COLUMN_ID)
                  ->on(ValuesDatabase::TABLE_PRODUCTS)
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(ValuesDatabase::TABLE_SALE_DETAILS);
    }
};
