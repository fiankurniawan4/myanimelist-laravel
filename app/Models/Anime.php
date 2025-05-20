<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Anime extends Model
{
    use HasFactory;

    protected $with                      = [];
    protected static $lazyLoadingEnabled = true;

    protected $fillable = [
        'content_id',
        'episodes',
        'aired_from',
        'aired_to',
        'premiered',
        'broadcast',
        'source',
        'duration',
        'rating',
    ];

    protected $casts = [
        'aired_from' => 'date',
        'aired_to'   => 'date',
        'episodes'   => 'integer',
    ];

    public function content(): BelongsTo
    {
        return $this->belongsTo(Content::class);
    }

    public function studios(): BelongsToMany
    {
        return $this->belongsToMany(Studio::class);
    }

    public function producers(): BelongsToMany
    {
        return $this->belongsToMany(Producer::class);
    }

    public function licensors(): BelongsToMany
    {
        return $this->belongsToMany(Licensor::class);
    }
}
