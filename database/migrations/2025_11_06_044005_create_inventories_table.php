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
        Schema::create(ValuesDatabase::TABLE_INVENTORIES, function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger(ValuesDatabase::INVENTORY_COLUMN_PRODUCT_ID);
            $table->unsignedBigInteger(ValuesDatabase::INVENTORY_COLUMN_PRODUCT_SIZE_ID);
            $table->unsignedBigInteger(ValuesDatabase::INVENTORY_COLUMN_TYPE_ID);
            $table->unsignedBigInteger(ValuesDatabase::INVENTORY_COLUMN_BRAND_ID);
            $table->integer(ValuesDatabase::INVENTORY_COLUMN_STOCK)->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign(ValuesDatabase::INVENTORY_COLUMN_PRODUCT_ID)
                  ->references(ValuesDatabase::PRODUCT_COLUMN_ID)
                  ->on(ValuesDatabase::TABLE_PRODUCTS)
                  ->onDelete('cascade');
                  
            $table->foreign(ValuesDatabase::INVENTORY_COLUMN_PRODUCT_SIZE_ID)
                  ->references(ValuesDatabase::PRODUCT_SIZE_COLUMN_ID)
                  ->on(ValuesDatabase::TABLE_PRODUCT_SIZES)
                  ->onDelete('cascade');
                  
            $table->foreign(ValuesDatabase::INVENTORY_COLUMN_TYPE_ID)
                  ->references(ValuesDatabase::TYPE_PRODUCT_COLUMN_ID)
                  ->on(ValuesDatabase::TABLE_TYPE_PRODUCTS)
                  ->onDelete('cascade');
                  
            $table->foreign(ValuesDatabase::INVENTORY_COLUMN_BRAND_ID)
                  ->references(ValuesDatabase::BRANCH_COLUMN_ID)
                  ->on(ValuesDatabase::TABLE_BRANCHES)
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(ValuesDatabase::TABLE_INVENTORIES);
    }
};
