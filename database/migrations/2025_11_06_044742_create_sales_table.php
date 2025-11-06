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
        Schema::create(ValuesDatabase::TABLE_SALES, function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger(ValuesDatabase::SALE_COLUMN_USER_ID);
            $table->unsignedBigInteger(ValuesDatabase::SALE_COLUMN_CLIENT_ID);
            $table->unsignedBigInteger(ValuesDatabase::SALE_COLUMN_BRANCH_ID);
            $table->decimal(ValuesDatabase::SALE_COLUMN_TOTAL_AMOUNT, 10, 2);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign(ValuesDatabase::SALE_COLUMN_USER_ID)
                  ->references(ValuesDatabase::USER_COLUMN_ID)
                  ->on(ValuesDatabase::TABLE_USERS)
                  ->onDelete('cascade');

            $table->foreign(ValuesDatabase::SALE_COLUMN_CLIENT_ID)
                  ->references(ValuesDatabase::CLIENT_COLUMN_ID)
                  ->on(ValuesDatabase::TABLE_CLIENTS)
                  ->onDelete('cascade');

            $table->foreign(ValuesDatabase::SALE_COLUMN_BRANCH_ID)
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
        Schema::dropIfExists(ValuesDatabase::TABLE_SALES);
    }
};
