<?php

namespace Tests\Feature;

use App\Models\Topic;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TopicTest extends TestCase
{
    use WithFaker;

    /**
     * @test
     *
     */
    public function test_validation_error_is_received_if_title_is_not_part_topic_request_body()
    {
        $data = ['title' => ""];

        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
        ])->postJson('api/v1/topic', $data);

        $response->assertStatus(422);
    }


    /**
     * @test
     *
     */
    public function test_topic_is_created_with_title_in_request_body()
    {
        $data = ['title' => $this->faker->sentence];

        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
        ])->postJson('api/v1/topic', $data);

        $response->assertStatus(201);
        $response->assertJson(["status" => "success"]);
        $this->assertTrue($response['data']['title'] === $data['title']);
    }

    /**
    * @test
    *
    */
    public function test_topic_is_persisted_to_database()
    {
        $data = Topic::factory()->create();

        $this->assertDatabaseHas('topics', [
            'title' =>  $data['title']
        ]);
    }

    /**
     * @test
     *
     */
    public function test_a_404_status_is_received_for_publishing_to_wrong_topic_uuid()
    {
        $data = ['url' => $this->faker->url];

        $wrongUUID = $this->faker->uuid;

        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
        ])->postJson("api/v1/publish/{$wrongUUID}", $data);

        $response->assertStatus(404);
        $response->assertJson(["status" => "failed"]);
        $this->assertTrue($response['message'] === "Topic not found");
    }
}
