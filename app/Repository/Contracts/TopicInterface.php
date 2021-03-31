<?php
namespace App\Repository\Contracts;

interface TopicInterface
{
    public function fetchSubscribers($topic);
}
