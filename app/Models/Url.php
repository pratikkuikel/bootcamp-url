<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class Url extends Model
{
    protected $table = 'urls';

    protected $guarded = [];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($item) {
            Log::info('creating url');
            // 'user_id' => auth()->user()->id,
            $item->user_id = auth()->id();
            $item->visitor_count = 100;
        });

        static::created(function ($item) {
            Log::info('Deleting the record');
            // 'user_id' => auth()->user()->id,
            $item->delete();
        });
    }

    public function visitors(): HasMany
    {
        return $this->hasMany(Visitor::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
