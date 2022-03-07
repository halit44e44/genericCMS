<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CreateUsersSeed::class);
        $this->call(CreateSupplierSeed::class);
        $this->call(CreateCategorySeed::class);
        $this->call(CreateFlagSeed::class);
    }
}
