<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Category;
use App\Post;

/**
 * Class CategoryPostTableSeeder
 */
class CategoryPostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $categorieIds = Category::pluck('id')->toArray();
        $postIds = Post::pluck('id')->toArray();
        for ($i = 1, $quantityOfPosts = 20; $i <= $quantityOfPosts; $i++) {
            $record['category_id'] = array_rand(array_flip($categorieIds), 1);
            $record['post_id'] = $postIds[$i-1];
            $record['created_at'] = now();
            $record['updated_at'] = now();
            DB::table('category_post')->insert($record);
        }
    }
}
