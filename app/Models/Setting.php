<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $primaryKey = 'key';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'key',
        'value',
    ];

    protected static function booted()
    {
        static::saved(function () {
            \Illuminate\Support\Facades\Cache::forget('settings_all');
        });
        static::deleted(function () {
            \Illuminate\Support\Facades\Cache::forget('settings_all');
        });
    }

    /**
     * Get a setting by its key, auto-decoding JSON values if applicable.
     */
    public static function get(string $key, $default = null)
    {
        $settings = \Illuminate\Support\Facades\Cache::remember('settings_all', 86400, function () {
            return self::all()->pluck('value', 'key')->toArray();
        });

        if (array_key_exists($key, $settings)) {
            $val = $settings[$key];
            if ($val === null) return $default;
            
            // Check if string is a JSON array/object or boolean/number
            if (in_array(substr($val, 0, 1), ['{', '['])) {
                $decoded = json_decode($val, true);
                if (json_last_error() === JSON_ERROR_NONE) {
                    return $decoded;
                }
            }
            return $val;
        }
        return $default;
    }

    /**
     * Set a setting by its key, auto-encoding array values to JSON.
     */
    public static function set(string $key, $value): self
    {
        $val = is_array($value) || is_object($value) ? json_encode($value) : $value;
        return self::updateOrCreate(['key' => $key], ['value' => $val]);
    }
}
