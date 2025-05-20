<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Manga extends Model
{
    use HasFactory;

    protected $fillable = [
        'content_id',
        'volumes',
        'chapters',
        'published_from',
        'published_to',
        'serialization',
    ];

    protected $casts = [
        'published_from' => 'date',
        'published_to'   => 'date',
        'volumes'        => 'integer',
        'chapters'       => 'integer',
    ];

    public function content(): BelongsTo
    {
        return $this->belongsTo(Content::class);
    }

    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(Author::class)->withPivot('role');
    }
}
