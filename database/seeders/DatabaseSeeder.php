<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        Category::truncate();
        Post::truncate();



        $user = User::factory()->create();

        $JLPT5 = Category::create([
            'name' => 'JLPT5',
            'slug' => 'JLPT5'
        ]);

        $JLPT4 = Category::create([
            'name' => 'JLPT4',
            'slug' => 'JLPT4'
        ]);
        $JLPT3 = Category::create([
            'name' => 'JLPT3',
            'slug' => 'JLPT3'
        ]);

        Post::create([
            'title' => 'My first Post',
            'category_id' => $JLPT5->id,
            'user_id' => $user->id,
            'post_fragment' => 'my-first-post',
            'body' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'
        ]);
        Post::create([
            'title' => 'My second Post',
            'category_id' => $JLPT4->id,
            'user_id' => $user->id,
            'post_fragment' => 'my-second-post',
            'body' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'
        ]);
        Post::create([
            'title' => 'My third Post',
            'category_id' => $JLPT3->id,
            'user_id' => $user->id,
            'post_fragment' => 'my-third-post',
            'body' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'
        ]);


    }
}
