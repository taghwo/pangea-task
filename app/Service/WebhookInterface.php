<?php
namespace App\Service;

interface WebhookInterface
{
    public function notifySubscribers(object $subscriptions, array $data);
    public function makeHttpRequest(string $url, array $data);
}
