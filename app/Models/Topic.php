<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use illuminate\Support\Str;

class Topic extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function subscribers()
    {
        return $this->belongsToMany(Subscriber::class, 'topic_subscribers');
    }

    public static function boot()
    {
        parent::boot();
        static::creating(function ($topic) {
            $topic->uuid = (string)Str::uuid();
        });
    }
}
