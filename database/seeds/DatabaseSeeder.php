<?php

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
        // $this->call(UserSeeder::class);
        //\App\Tipo::factory(100)->create();
        factory(App\Tipo::class, 50)->create();
    }
}
