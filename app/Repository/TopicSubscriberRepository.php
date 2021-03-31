<?php
namespace App\Repository;

use App\Models\TopicSubscriber;
use App\Repository\Contracts\TopicSubscriberInterface;

class TopicSubscriberRepository extends BaseAbstractRepository implements TopicSubscriberInterface
{
    public function model()
    {
        return TopicSubscriber::class;
    }

    public function syncTopicSubscriber($topic, $subscriber)
    {
        $topic->subscribers()->attach($subscriber);
    }
}
