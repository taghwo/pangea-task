<?php
namespace App\Repository;

use App\Models\Topic;
use App\Repository\Contracts\TopicInterface;

class TopicRepository extends BaseAbstractRepository implements TopicInterface
{
    public function model()
    {
        return Topic::class;
    }


    public function fetchSubscribers($topic)
    {
        return $topic->subscribers()->get();
    }
}
