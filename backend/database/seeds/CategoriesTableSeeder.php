<?php

use Illuminate\Database\Seeder;
use App\Category;

/**
 * Class CategoriesTableSeeder
 */
class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        factory(Category::class, 10)->create();
    }
}