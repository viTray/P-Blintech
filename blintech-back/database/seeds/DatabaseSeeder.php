<?php

use Illuminate\Database\Seeder;
use phpDocumentor\Reflection\Types\Integer;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Title::class, 60)->create();
        factory(App\Brand::class, 54)->create();
        factory(App\Type::class, 13)->create();
        factory(App\User::class, 1)->create();
    }
}
