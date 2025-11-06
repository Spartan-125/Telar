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
        Schema::create(ValuesDatabase::TABLE_BRANCHES, function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger(ValuesDatabase::BRANCH_COLUMN_COMPANY_ID);
            $table->string(ValuesDatabase::BRANCH_COLUMN_NAME);
            $table->string(ValuesDatabase::BRANCH_COLUMN_ADDRESS)->nullable();
            $table->string(ValuesDatabase::BRANCH_COLUMN_PHONE)->nullable();
            $table->string(ValuesDatabase::BRANCH_COLUMN_EMAIL)->nullable();
            $table->text(ValuesDatabase::BRANCH_COLUMN_DESCRIPTION)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign(ValuesDatabase::BRANCH_COLUMN_COMPANY_ID)
                ->references(ValuesDatabase::COMPANY_COLUMN_ID)
                ->on(ValuesDatabase::TABLE_COMPANIES)
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(ValuesDatabase::TABLE_BRANCHES);
    }
};
