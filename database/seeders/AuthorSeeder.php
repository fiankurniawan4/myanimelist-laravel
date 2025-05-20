<?php
namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AuthorSeeder extends Seeder
{
    public function run(): void
    {
        $authors = [
            'Eiichiro Oda'      => 'Creator of One Piece, one of the best-selling manga series of all time.',
            'Masashi Kishimoto' => 'Creator of Naruto, one of the most popular manga and anime franchises.',
            'Akira Toriyama'    => 'Created Dragon Ball, one of the most influential manga and anime series.',
            'Kohei Horikoshi'   => 'Creator of My Hero Academia.',
            'ONE'               => 'Creator of One Punch Man (original webcomic) and Mob Psycho 100.',
            'Yusuke Murata'     => 'Manga artist who redrew One Punch Man for serialization.',
            'Hajime Isayama'    => 'Creator of Attack on Titan.',
            'Hiromu Arakawa'    => 'Creator of Fullmetal Alchemist.',
            'Naoko Takeuchi'    => 'Creator of Sailor Moon.',
            'CLAMP'             => 'Group of manga artists known for works like Cardcaptor Sakura.',
            'Kentaro Miura'     => 'Creator of Berserk.',
            'Yoshihiro Togashi' => 'Creator of Hunter x Hunter and Yu Yu Hakusho.',
            'Rumiko Takahashi'  => 'Creator of Inuyasha and Ranma ½.',
            'Sui Ishida'        => 'Creator of Tokyo Ghoul.',
            'Tite Kubo'         => 'Creator of Bleach.',
            'Gosho Aoyama'      => 'Creator of Detective Conan (Case Closed).',
            'Osamu Tezuka'      => 'Pioneer of manga and anime, created Astro Boy.',
            'Junji Ito'         => 'Horror manga artist, creator of Uzumaki.',
            'Yana Toboso'       => 'Creator of Black Butler.',
            'Koyoharu Gotouge'  => 'Creator of Demon Slayer.',
            'Gege Akutami'      => 'Creator of Jujutsu Kaisen.',
            'Katsuhiro Otomo'   => 'Creator of Akira.',
            'Makoto Shinkai'    => 'Creator of Your Name and Weathering With You.',
            'Hayao Miyazaki'    => 'Co-founder of Studio Ghibli and creator of many beloved anime films.',
            'Shiraishi, Jougi'  => 'Creator of many light novels and manga series.',
            'Nanao, Itsuki'     => 'Manga artist known for detailed art style.',
        ];

        foreach ($authors as $name => $biography) {
            Author::create([
                'name'      => $name,
                'slug'      => Str::slug($name),
                'biography' => $biography,
            ]);
        }
    }
}
