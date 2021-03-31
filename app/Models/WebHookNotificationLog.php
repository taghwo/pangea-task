<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebHookNotificationLog extends Model
{
    use HasFactory;
    public $table = 'web_hook_notifications_logs';
    protected $guarded = ['id'];
    protected $casts = ['status' => 'boolean'];

    public static function new(string $url, array $data, bool $status=true, $error='')
    {
        self::create([
            'url' => $url,
            'data' => $data,
            'logs' => $error,
            'status' => $status,
            'attempt' => 1 //handy for retrying notification
        ]);
    }
    public function setLogsAttribute($value)
    {
        $this->attributes['logs'] = serialize($value);
    }

    public function getLogsAttribute($value)
    {
        return unserialize($value);
    }

    public function setDataAttribute($value)
    {
        $this->attributes['data'] = serialize($value);
    }

    public function getDataAttribute($value)
    {
        return unserialize($value);
    }

    public function setUrlAttribute($value)
    {
        $this->attributes['url'] = serialize($value);
    }

    public function getUrlAttribute($value)
    {
        return unserialize($value);
    }
}
