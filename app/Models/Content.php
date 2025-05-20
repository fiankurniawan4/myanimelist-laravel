<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Cache;

class Content extends Model
{
    use HasFactory;

    protected $with                      = ['anime'];
    protected static $lazyLoadingEnabled = true;

    protected $fillable = [
        'title',
        'slug',
        'type',
        'synopsis',
        'image',
        'status',
        'content_type',
        'average_rating',
        'total_ratings',
    ];

    protected $casts = [
        'average_rating' => 'decimal:2',
        'total_ratings'  => 'integer',
    ];

    public static function scopeNewAnime()
    {
        $cacheKey      = 'new_anime_content';
        $cacheDuration = 900;

        return Cache::remember($cacheKey, $cacheDuration, function () {
            return self::select('id', 'title', 'slug', 'image')
                ->where('content_type', 'anime')
                ->orderBy('created_at', 'desc')
                ->limit(10)
                ->get();
        });
    }

    public static function scopeUpdateAnime()
    {
        $cacheKey      = 'update_anime_content';
        $cacheDuration = 600;
        return Cache::remember($cacheKey, $cacheDuration, function () {
            return self::select('id', 'title', 'slug', 'image')
                ->where('content_type', 'anime')
                ->orderBy('updated_at', 'desc')
                ->limit(10)
                ->get();
        });
    }

    public static function scopePopularAnime()
    {
        $cacheKey      = 'popular_anime_content';
        $cacheDuration = 3600;
        return Cache::remember($cacheKey, $cacheDuration, function () {
            return self::select('id', 'title', 'slug', 'image')
                ->where('content_type', 'anime')
                ->orderBy('average_rating', 'desc')
                ->limit(10)
                ->get();
        });
    }

    public function anime(): HasOne
    {
        return $this->hasOne(Anime::class);
    }

    public function manga(): HasOne
    {
        return $this->hasOne(Manga::class);
    }

    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class);
    }

    public function ratings(): HasMany
    {
        return $this->hasMany(ContentRating::class);
    }

    /**
     * Get the rating for a specific user
     */
    public function getUserRating(int $userId): ?ContentRating
    {
        return $this->ratings()->where('user_id', $userId)->first();
    }

    /**
     * Check if the content has been rated by a specific user
     */
    public function hasUserRated(int $userId): bool
    {
        return $this->ratings()->where('user_id', $userId)->exists();
    }

    // Helper method to recalculate rating
    public function recalculateRating(): void
    {
        $ratings = $this->ratings;
        $count   = $ratings->count();

        if ($count > 0) {
            $this->average_rating = round($ratings->avg('rating'), 2);
            $this->total_ratings  = $count;
            $this->save();
        } else {
            $this->average_rating = 0;
            $this->total_ratings  = 0;
            $this->save();
        }
    }
}
