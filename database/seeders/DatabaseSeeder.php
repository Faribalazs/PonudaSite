<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Http\Controllers\AdminController;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(LaratrustSeeder::class);

        $controller = new AdminController();
        $bar = $controller->insertAdmin();
    }
}