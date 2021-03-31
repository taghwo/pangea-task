<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateSubscriptionRequest;
use App\Repository\Contracts\SubscriberInterface;
use App\Repository\Contracts\TopicInterface;
use App\Repository\Contracts\TopicSubscriberInterface;

class SubscribeController extends Controller
{
    protected $topic;
    protected $subscriber;
    protected $topicSubscription;

    public function __construct(TopicInterface $topic, SubscriberInterface $subscriber, TopicSubscriberInterface $topicSubscription)
    {
        $this->topic = $topic;
        $this->subscriber = $subscriber;
        $this->topicSubscription = $topicSubscription;
    }

    public function subscribe(CreateSubscriptionRequest $request, $uuid)
    {
        $validatedAttr = $request->validated();

        if (!$topic = $this->topic->findByUUID($uuid)) {
            return $this->respondModelNotFoundError("Topic");
        }

        try {
            $newSubscriber = $this->subscriber->create($validatedAttr);

            $this->topicSubscription->syncTopicSubscriber($topic, $newSubscriber->id);

            $payload = [
                'topic' => $topic->title,
                'topic_identifier' => $topic->uuid,
                'url' =>  $newSubscriber->url
            ];

            return  $this->respondSuccessWithData($payload, 201);
        } catch (\Exception $e) {
            return $this->respondErrorWithMessage($e->getMessage());
        }
    }
}
