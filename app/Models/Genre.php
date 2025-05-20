<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Genre extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function contents(): BelongsToMany
    {
        return $this->belongsToMany(Content::class);
    }

    // Get only anime with this genre
    public function animes()
    {
        return $this->contents()->whereHas('anime');
    }

    // Get only manga with this genre
    public function mangas()
    {
        return $this->contents()->whereHas('manga');
    }
}
