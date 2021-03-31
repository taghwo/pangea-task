<?php

namespace Database\Factories;

use App\Models\TopicSubscriber;
use Illuminate\Database\Eloquent\Factories\Factory;

class TopicSubscriberFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TopicSubscriber::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "topic_id" => rand(0, 100000),
            "subscriber_id" => rand(0, 100000)
        ];
    }
}
