<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;

/**
 * Class CommentsTableSeeder
 */
class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $userIds = User::all()->where('role', 'user')->pluck('id')->toArray();
        $postIds = Post::pluck('id')->toArray();
        $comments = factory(Comment::class, 20)->make()->each(static function ($comment) use ($userIds, $postIds) {
            $comment->user_id = array_rand(array_flip($userIds), 1);
            $comment->post_id = array_rand(array_flip($postIds), 1);
        })->toArray();
        Comment::insert($comments);
    }
}
