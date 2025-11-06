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
        Schema::create(ValuesDatabase::TABLE_CLIENTS, function (Blueprint $table) {
            $table->id();
            $table->string(ValuesDatabase::CLIENT_COLUMN_NAME);
            $table->string(ValuesDatabase::CLIENT_COLUMN_NIP);
            $table->string(ValuesDatabase::CLIENT_COLUMN_EMAIL)->nullable();
            $table->string(ValuesDatabase::CLIENT_COLUMN_PHONE)->nullable();
            $table->string(ValuesDatabase::CLIENT_COLUMN_ADDRESS)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(ValuesDatabase::TABLE_CLIENTS);
    }
};
