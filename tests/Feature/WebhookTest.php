<?php

namespace Tests\Feature;

use App\Models\Subscriber;
use App\Models\Topic;
use App\Models\TopicSubscriber;
use App\Service\WebhookInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Mockery;
use Tests\TestCase;

class WebhookTest extends TestCase
{
    protected $webhook;
    public function setUp():void
    {
        parent::setUp();

        $this->webhook = Mockery::mock(WebhookInterface::class);

        $this->topic = Topic::factory()->create();

        $this->subscriber = Subscriber::factory()->create();

        $this->syncSubscription = TopicSubscriber::factory()->create([
                                            "topic_id" =>  $this->topic->id,
                                            "subscriber_id" => $this->subscriber->id
                                        ]);
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_webhook()
    {
        $data = ["message" => "here and there","detail" => "brick by brick they said"];

        $subscriptions = $this->topic->subscribers()->get();
        $this->webhook->shouldReceive('notifySubscribers')->once()->andReturn(true);
        $response = $this->webhook->notifySubscribers($subscriptions, $data);

        $this->assertTrue($response === true);
    }
}
