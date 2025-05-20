<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContentRating extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'content_id',
        'rating',
        'review',
    ];

    protected $casts = [
        'rating' => 'integer',
    ];

    // Trigger recalculation of content's average rating when a rating is saved or deleted
    protected static function booted(): void
    {
        static::saved(function (ContentRating $rating): void {
            $rating->content->recalculateRating();
        });

        static::deleted(function (ContentRating $rating): void {
            $rating->content->recalculateRating();
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function content(): BelongsTo
    {
        return $this->belongsTo(Content::class);
    }

    // Set rating within valid range (1-10)
    public function setRatingAttribute($value): void
    {
        $this->attributes['rating'] = max(1, min(10, $value));
    }
}
