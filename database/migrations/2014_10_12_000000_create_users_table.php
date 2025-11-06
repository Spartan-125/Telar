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
        Schema::create(ValuesDatabase::TABLE_USERS, function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger(ValuesDatabase::USER_COLUMN_ROL_ID);
            $table->string(ValuesDatabase::USER_COLUMN_NAME);
            $table->string(ValuesDatabase::USER_COLUMN_EMAIL)->unique();
            $table->string(ValuesDatabase::USER_COLUMN_PASSWORD);
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign(ValuesDatabase::USER_COLUMN_ROL_ID)
                  ->references(ValuesDatabase::ROL_COLUMN_ID)
                  ->on(ValuesDatabase::TABLE_ROLS)
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(ValuesDatabase::TABLE_USERS);
    }
};
