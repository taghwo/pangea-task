<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePublishRequest;
use App\Http\Requests\CreateTopicRequest;
use App\Repository\Contracts\TopicInterface;
use App\Service\WebhookInterface;

class TopicController extends Controller
{
    protected $topic;
    protected $webhook;

    public function __construct(TopicInterface $topic, WebhookInterface $webhook)
    {
        $this->topic = $topic;
        $this->webhook = $webhook;
    }

    public function store(CreateTopicRequest $request)
    {
        $validatedAttr = $request->validated();

        try {
            $newTopic = $this->topic->create($validatedAttr);
            return  $this->respondSuccessWithData($newTopic, 201);
        } catch (\Exception $e) {
            return $this->respondErrorWithMessage($e->getMessage());
        }
    }

    public function publish(CreatePublishRequest $request, $uuid)
    {
        $data = $request->all();

        if (!$topic = $this->topic->findByUUID($uuid)) {
            return $this->respondModelNotFoundError("Topic");
        }

        $subscriptions = $this->topic->fetchSubscribers($topic);

        if (count($subscriptions) > 0) {
            if ($this->webhook->notifySubscribers($subscriptions, $data)) {
                return  response()->json([
                    "status" => "success",
                    "message" => "Webhook Notifications sent"
                ], 200);
            };
        }
        return $this->respondWithSuccess("Publishing completed succesfully");
    }
}
