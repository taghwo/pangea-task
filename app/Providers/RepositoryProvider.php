<?php

namespace App\Providers;

use App\Repository\Contracts\SubscriberInterface;
use App\Repository\Contracts\TopicInterface;
use App\Repository\Contracts\TopicSubscriberInterface;
use App\Repository\SubscriberRepository;
use App\Repository\TopicRepository;
use App\Repository\TopicSubscriberRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(TopicInterface::class, TopicRepository::class);
        $this->app->bind(SubscriberInterface::class, SubscriberRepository::class);
        $this->app->bind(TopicSubscriberInterface::class, TopicSubscriberRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
