<?php
namespace App\Repository;

use App\Models\Subscriber;
use App\Repository\Contracts\SubscriberInterface;

class SubscriberRepository extends BaseAbstractRepository implements SubscriberInterface
{
    public function model()
    {
        return Subscriber::class;
    }
}
