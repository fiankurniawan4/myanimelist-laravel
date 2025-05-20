<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Author extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function mangas(): BelongsToMany
    {
        return $this->belongsToMany(Manga::class)->withPivot('role');
    }

    // Get mangas where this author is the story writer
    public function storyMangas()
    {
        return $this->mangas()->wherePivot('role', 'Story');
    }

    // Get mangas where this author is the artist
    public function artMangas()
    {
        return $this->mangas()->wherePivot('role', 'Art');
    }
}
