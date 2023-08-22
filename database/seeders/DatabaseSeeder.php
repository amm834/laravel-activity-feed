<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Action;
use App\Models\Activity;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Action::create(['name' => 'like']);
        Action::create(['name' => 'comment']);
        Action::create(['name' => 'share']);

        User::factory(10)->create()->each(
            fn(User $user) => $user->posts()->createMany(
                Post::factory(5)
                    ->make()
                    ->toArray()
            )
        );

        Post::all()->each(
            fn(Post $post) => $post->comments()->createMany(
                Comment::factory(5)
                    ->make()
                    ->toArray()
            )
        );


        User::all()
            ->each(
                fn(User $user) => $user->activityLogs()->createMany(
                    Activity::factory(5)
                        ->make()
                        ->toArray()
                )
            );

    }
}
