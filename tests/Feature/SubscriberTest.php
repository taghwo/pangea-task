<?php

namespace Tests\Feature;

use App\Models\Subscriber;
use App\Models\Topic;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SubscriberTest extends TestCase
{
    use WithFaker;

    protected $topic;
    protected function setUp():void
    {
        parent::setUp();
        $this->topic = Topic::factory()->create();
    }
    /**
     * @test
     *
     */
    public function test_validation_error_is_received_if_url_is_not_part_subscriber_request_body()
    {
        $data = ['url' => ""];

        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
        ])->postJson("api/v1/subscribe/{$this->topic->uuid}", $data);

        $response->assertStatus(422);
    }


    /**
     * @test
     *
     */
    public function test_subscriber_can_be_created_and_synced_to_topic()
    {
        $data = ['url' => $this->faker->url];

        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
        ])->postJson("api/v1/subscribe/{$this->topic->uuid}", $data);

        $response->assertStatus(201);
        $response->assertJson(["status" => "success"]);
        $this->assertTrue($response['data']['topic'] === $this->topic->title);
    }


    /**
     * @test
     *
     */
    public function test_a_404_status_is_received_for_wrong_topic_uuid()
    {
        $data = ['url' => $this->faker->url];

        $wrongUUID = $this->faker->uuid;

        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
        ])->postJson("api/v1/subscribe/{$wrongUUID}", $data);

        $response->assertStatus(404);
        $response->assertJson(["status" => "failed"]);
        $this->assertTrue($response['message'] === "Topic not found");
    }

    /**
    * @test
    *
    */
    public function test_subscriber_is_persisted_to_database()
    {
        $data = Subscriber::factory()->create();

        $this->assertDatabaseHas('subscribers', [
            'url' =>  $data['url']
        ]);
    }
}
