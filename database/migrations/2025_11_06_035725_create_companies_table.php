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
        Schema::create(ValuesDatabase::TABLE_COMPANIES, function (Blueprint $table) {
            $table->id();
            $table->string(ValuesDatabase::COMPANY_COLUMN_NAME);
            $table->string(ValuesDatabase::COMPANY_COLUMN_ADDRESS)->nullable();
            $table->string(ValuesDatabase::COMPANY_COLUMN_PHONE)->nullable();
            $table->string(ValuesDatabase::COMPANY_COLUMN_EMAIL)->nullable();
            $table->text(ValuesDatabase::COMPANY_COLUMN_DESCRIPTION)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(ValuesDatabase::TABLE_COMPANIES);
    }
};
