<?php
namespace Database\Seeders;

use App\Models\Producer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProducerSeeder extends Seeder
{
    public function run(): void
    {
        $producers = [
            'Aniplex',
            'Bandai Visual',
            'Kadokawa',
            'Pony Canyon',
            'Avex Pictures',
            'Dentsu',
            'TV Tokyo',
            'Shueisha',
            'Kodansha',
            'Fuji TV',
            'TBS',
            'NHK',
            'Lantis',
            'Movic',
            'AT-X',
            'Kadokawa Media House',
            'SB Creative',
            'Mainichi Broadcasting',
            'Crunchyroll',
            'Netflix',
            'Tokyo MX',
            'BS11',
            'MBS',
            'KlockWorx',
            'Toho',
            'Genco',
            'Sony Pictures Entertainment',
            'NBCUniversal Entertainment Japan',
            'Warner Bros. Japan',
            'Hakusensha',
        ];

        foreach ($producers as $name) {
            Producer::create([
                'name' => $name,
                'slug' => Str::slug($name),
            ]);
        }
    }
}
