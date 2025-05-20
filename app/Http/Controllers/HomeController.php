<?php
namespace App\Http\Controllers;

use App\Models\Content;

class HomeController extends Controller
{
    public function home()
    {
        $newAnime = Content::scopeNewAnime();

        $updateAnime = Content::scopeUpdateAnime();

        $popularAnime = Content::scopePopularAnime();

        $anime = [
            'new'     => $newAnime,
            'update'  => $updateAnime,
            'popular' => $popularAnime,
        ];

        return view('member.anime.home', compact('anime'));
    }

    public function detail($id)
    {
        $anime     = Content::find($id);
        $animeName = $anime->name ?? null;

        if (! $anime) {
            return redirect()->route('home')->with('error', 'Anime not found');
        }

        return view('member.anime.detail', compact('anime', 'animeName'));
    }
}
