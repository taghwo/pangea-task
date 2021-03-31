<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TopicSubscriber extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public $table = 'topic_subscribers';

    public static function boot()
    {
        parent::boot();
        static::creating(function ($subscription) {
            $subscription->created_at = now();
            $subscription->updated_at = now();
        });
    }
}
