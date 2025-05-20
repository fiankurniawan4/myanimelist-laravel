<?php
namespace Database\Seeders;

use App\Models\Studio;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class StudioSeeder extends Seeder
{
    public function run(): void
    {
        $studios = [
            'Madhouse'        => 'Known for Death Note, One Punch Man S1, and Hunter x Hunter (2011)',
            'Kyoto Animation' => 'Known for Violet Evergarden, K-On!, and A Silent Voice',
            'Bones'           => 'Known for Fullmetal Alchemist: Brotherhood and My Hero Academia',
            'Wit Studio'      => 'Known for Attack on Titan S1-S3 and Vinland Saga',
            'Ufotable'        => 'Known for Demon Slayer and Fate series',
            'MAPPA'           => 'Known for Jujutsu Kaisen and Attack on Titan Final Season',
            'A-1 Pictures'    => 'Known for Sword Art Online and Your Lie in April',
            'Toei Animation'  => 'Known for One Piece and Dragon Ball series',
            'Production I.G'  => 'Known for Haikyuu!! and Psycho-Pass',
            'Sunrise'         => 'Known for Cowboy Bebop and Gintama',
            'J.C.Staff'       => 'Known for Food Wars! and One Punch Man S2',
            'Shaft'           => 'Known for Monogatari series and Madoka Magica',
            'Studio Ghibli'   => 'Known for Spirited Away and My Neighbor Totoro',
            'Gainax'          => 'Known for Neon Genesis Evangelion',
            'Trigger'         => 'Known for Kill la Kill and Little Witch Academia',
            'White Fox'       => 'Known for Steins;Gate and Re:Zero',
            'P.A. Works'      => 'Known for Angel Beats! and Charlotte',
            'Studio Deen'     => 'Known for KonoSuba and Fate/stay night',
            'CloverWorks'     => 'Known for The Promised Neverland and Darling in the Franxx',
            'OLM'             => 'Known for Pokémon series',
            'C2C'             => 'Known for WorldEnd and Tsukimichi: Moonlit Fantasy',
        ];

        foreach ($studios as $name => $description) {
            Studio::create([
                'name'        => $name,
                'slug'        => Str::slug($name),
                'description' => $description,
            ]);
        }
    }
}
