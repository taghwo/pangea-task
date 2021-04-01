<?php
namespace App\Service;

use App\Models\WebHookNotificationLog;
use Illuminate\Support\Facades\Http;

class WebhookService implements WebhookInterface
{
    public function notifySubscribers(object $subscriptions, array $data)
    {
        foreach ($subscriptions as $subscriber) {
            $this->makeHttpRequest($subscriber->url, $data);
        }
        return true;
    }

    public function makeHttpRequest($url, $data)
    {
        try {
            Http::post($url, $data);
            WebHookNotificationLog::new($url, $data);
        } catch (\Exception $e) {
            WebHookNotificationLog::new($url, $data, false, $e->getMessage());
        }
    }
}
