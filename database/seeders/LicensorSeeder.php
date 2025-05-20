<?php
namespace Database\Seeders;

use App\Models\Licensor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class LicensorSeeder extends Seeder
{
    public function run(): void
    {
        $licensors = [
            'Funimation',
            'Crunchyroll',
            'Netflix',
            'Sentai Filmworks',
            'Viz Media',
            'Aniplex of America',
            'Discotek Media',
            'HIDIVE',
            'Amazon Prime Video',
            'Bandai Entertainment',
            'ADV Films',
            'Right Stuf',
            'NIS America',
            'Ponycan USA',
            'Section23 Films',
            'Media Blasters',
            'Maiden Japan',
            'TMS Entertainment',
            'Nozomi Entertainment',
            'AnimEigo',
            'Central Park Media',
            'Geneon Entertainment',
            'Manga Entertainment',
            'Eastern Star',
            'Eleven Arts',
        ];

        foreach ($licensors as $name) {
            Licensor::create([
                'name' => $name,
                'slug' => Str::slug($name),
            ]);
        }
    }
}
