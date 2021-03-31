<?php
namespace App\Repository\Contracts;

interface TopicSubscriberInterface
{
    public function syncTopicSubscriber($topic, $subscriber);
}
