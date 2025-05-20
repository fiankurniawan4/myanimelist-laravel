<?php
namespace App\Http\Controllers;

use App\Models\Anime;
use App\Models\Content;
use App\Models\Genre;
use App\Models\Licensor;
use App\Models\Producer;
use App\Models\Studio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard');
    }

    // view to create a new anime
    public function posts()
    {
        $genres    = Genre::orderBy('name')->get();
        $studios   = Studio::orderBy('name')->get();
        $producers = Producer::orderBy('name')->get();
        $licensors = Licensor::orderBy('name')->get();

        return view('admin.posts', compact('genres', 'studios', 'producers', 'licensors'));
    }

    public function data()
    {
        $anime = Anime::orderBy('created_at', 'desc')->get();
        return view('admin.database', compact('anime'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'title'      => 'required|string|max:255',
            'synopsis'   => 'nullable|string',
            'type'       => 'required|string',
            'status'     => 'required|string',
            'episodes'   => 'nullable|integer|min:0',
            'aired_from' => 'nullable|date',
            'aired_to'   => 'nullable|date',
            'premiered'  => 'nullable|string',
            'broadcast'  => 'nullable|string',
            'source'     => 'nullable|string',
            'duration'   => 'nullable|string',
            'rating'     => 'nullable|string',
            'image'      => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'genres'     => 'nullable|array',
            'studios'    => 'nullable|array',
            'producers'  => 'nullable|array',
            'licensors'  => 'nullable|array',
        ]);

        if ($request->hasFile('image')) {
            Log::info('Image upload details:', [
                'name' => $request->file('image')->getClientOriginalName(),
                'size' => $request->file('image')->getSize(),
                'mime' => $request->file('image')->getMimeType(),
            ]);
        } else {
            Log::warning('No image found in request');
        }

        // Start a database transaction
        DB::beginTransaction();

        try {
            // Create slug
            $slug     = Str::slug($request->title);
            $baseSlug = $slug;
            $counter  = 1;

            // Check if slug exists
            while (Content::where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }

            // Handle image upload
            $imagePath = null;
            if ($request->hasFile('image')) {
                try {
                    Log::info('Attempting to upload image to content directory');

                    // Use storeAs for more control over the filename
                    $imagePath = $request->file('image')->store('content', 'public');

                    Log::info('Image uploaded successfully to: ' . $imagePath);

                    // Verify file exists after upload
                    if (! Storage::disk('public')->exists($imagePath)) {
                        Log::error('File was not saved to disk after upload');
                        throw new \Exception('File upload failed: Storage verification failed');
                    }
                } catch (\Exception $e) {
                    Log::error('Failed to upload image: ' . $e->getMessage());
                    return back()->withInput()
                        ->with('error', 'Error uploading image: ' . $e->getMessage());
                }
            }
            $content = Content::create([
                'title'        => $request->title,
                'slug'         => $slug,
                'type'         => $request->type,
                'synopsis'     => $request->synopsis,
                'status'       => $request->status,
                'content_type' => 'anime',
                'image'        => $imagePath,
            ]);
            $anime = Anime::create([
                'content_id' => $content->id,
                'episodes'   => $request->episodes,
                'aired_from' => $request->aired_from,
                'aired_to'   => $request->aired_to,
                'premiered'  => $request->premiered,
                'broadcast'  => $request->broadcast,
                'source'     => $request->source,
                'duration'   => $request->duration,
                'rating'     => $request->rating,
            ]);
            if ($request->has('genres')) {
                $content->genres()->attach($request->genres);
            }
            if ($request->has('studios')) {
                $anime->studios()->attach($request->studios);
            }
            if ($request->has('producers')) {
                $anime->producers()->attach($request->producers);
            }
            if ($request->has('licensors')) {
                $anime->licensors()->attach($request->licensors);
            }

            DB::commit();

            return redirect()->route('dashboard.posts')
                ->with('success', 'Anime created successfully!');
        } catch (\Exception $e) {
            DB::rollBack();

            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }

            return back()->withInput()
                ->with('error', 'Error creating anime: ' . $e->getMessage());
        }
    }
}
