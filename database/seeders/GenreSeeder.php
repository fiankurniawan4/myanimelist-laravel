<?php
namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class GenreSeeder extends Seeder
{
    public function run(): void
    {
        $genres = [
            'Action'        => 'Exciting scenes where characters engage in physical stunts, battles, and fights',
            'Adventure'     => 'Characters go on a journey to explore new places and experience exciting things',
            'Comedy'        => 'Intended to be humorous and designed to make the audience laugh',
            'Drama'         => 'Focuses on realistic characters dealing with emotional themes',
            'Fantasy'       => 'Features various magical and supernatural elements',
            'Horror'        => 'Intended to create feelings of fear, dread, and terror',
            'Mystery'       => 'Revolves around a puzzle or mysterious event that characters must solve',
            'Psychological' => 'Focuses on the psychological state of characters and their mental processes',
            'Romance'       => 'Focuses on the romantic relationships of characters',
            'Sci-Fi'        => 'Features advanced science and technology, often set in the future or space',
            'Slice of Life' => 'Portrays realistic everyday experiences in characters\' lives',
            'Sports'        => 'Focuses on sports and athletic competitions',
            'Supernatural'  => 'Features supernatural and paranormal elements',
            'Thriller'      => 'Creates intense excitement and suspense',
            'Historical'    => 'Set in historical time periods or based on historical events',
            'Music'         => 'Focuses on musical performances or the music industry',
            'Mecha'         => 'Features giant robots or machines controlled by people',
            'Military'      => 'Focuses on warfare and military conflicts',
            'Harem'         => 'Features one male character surrounded by many female characters',
            'Ecchi'         => 'Contains suggestive sexual content, but not explicit',
            'Seinen'        => 'Aimed at young adult men (18-40)',
            'Shoujo'        => 'Aimed primarily at teenage girls',
            'Shounen'       => 'Aimed primarily at teenage boys',
            'Josei'         => 'Aimed at adult women',
            'Isekai'        => 'Characters transported to or reborn in another world',
        ];

        foreach ($genres as $name => $description) {
            Genre::create([
                'name'        => $name,
                'slug'        => Str::slug($name),
                'description' => $description,
            ]);
        }
    }
}
