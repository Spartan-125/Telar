<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Rol;
use App\Models\User;
use App\Utils\ValuesDatabase;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Rol::factory()->create(
            [
                ValuesDatabase::ROL_COLUMN_NAME => 'Admin',
                ValuesDatabase::ROL_COLUMN_DESCRIPTION => 'Administrator role',
            ]
        );
        Rol::factory()->create(
            [
                ValuesDatabase::ROL_COLUMN_NAME => 'Seller',
                ValuesDatabase::ROL_COLUMN_DESCRIPTION => 'Seller role',
            ]
        );
        User::factory()->create(
            [
                ValuesDatabase::USER_COLUMN_NAME => 'Admin User',
                ValuesDatabase::USER_COLUMN_EMAIL => 'admin@example.com',
                ValuesDatabase::USER_COLUMN_PASSWORD => bcrypt('password'),
                ValuesDatabase::USER_COLUMN_ROL_ID => 1,
            ]
        );
    }
}
