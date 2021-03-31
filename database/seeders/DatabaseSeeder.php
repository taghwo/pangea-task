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
        // \App\Models\User::factory(10)->create();
        $topic = \App\Models\Topic::factory(1)->create();
        $subscriber = \App\Models\Subscriber::factory(1)->create();
        \App\Models\TopicSubscriber::factory(1)->create([
             "topic_id" =>  $topic->first()->id,
             "subscriber_id" =>  $subscriber->first()->id
         ]);
    }
}
