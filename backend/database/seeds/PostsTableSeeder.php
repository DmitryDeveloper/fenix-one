<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Post;

/**
 * Class PostsTableSeeder
 */
class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $userIds = User::all()->where('role', 'user')->pluck('id')->toArray();
        $posts = factory(Post::class, 20)->make()->each(static function ($post) use ($userIds) {
            $post->user_id = array_rand(array_flip($userIds), 1);
        })->toArray();
        Post::insert($posts);
    }
}
