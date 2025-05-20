<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('type'); // TV, Movie, OVA, Manga, Light Novel, etc.
            $table->text('synopsis')->nullable();
            $table->string('image')->nullable();
            $table->string('status');       // Airing, Finished Airing, Publishing, Finished, etc.
            $table->string('content_type'); // 'anime' or 'manga'
            $table->decimal('average_rating', 3, 2)->default(0);
            $table->integer('total_ratings')->default(0);
            $table->timestamps();
        });

        // Anime-specific data
        Schema::create('animes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('content_id')->constrained()->onDelete('cascade');
            $table->integer('episodes')->nullable();
            $table->date('aired_from')->nullable();
            $table->date('aired_to')->nullable();
            $table->string('premiered')->nullable(); // Fall 2020, etc.
            $table->string('broadcast')->nullable(); // Fridays at 21:00 (JST)
            $table->string('source')->nullable();    // Light novel, Original, etc.
            $table->string('duration')->nullable();  // 24 min. per ep.
            $table->string('rating')->nullable();    // R - 17+, PG-13, etc.
            $table->timestamps();
        });

        // Manga-specific data
        Schema::create('mangas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('content_id')->constrained()->onDelete('cascade');
            $table->integer('volumes')->nullable();
            $table->integer('chapters')->nullable();
            $table->date('published_from')->nullable();
            $table->date('published_to')->nullable();
            $table->string('serialization')->nullable(); // Manga UP!, etc.
            $table->timestamps();
        });

        // Genres table
        Schema::create('genres', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->string('description');
            $table->timestamps();
        });

        // Content-Genre pivot table
        Schema::create('content_genre', function (Blueprint $table) {
            $table->id();
            $table->foreignId('content_id')->constrained()->onDelete('cascade');
            $table->foreignId('genre_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        // Studios table (for anime)
        Schema::create('studios', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->string('description');
            $table->timestamps();
        });

        // Anime-Studio pivot table
        Schema::create('anime_studio', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anime_id')->constrained()->onDelete('cascade');
            $table->foreignId('studio_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        // Producers table (for anime)
        Schema::create('producers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->timestamps();
        });

        // Anime-Producer pivot table
        Schema::create('anime_producer', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anime_id')->constrained()->onDelete('cascade');
            $table->foreignId('producer_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        // Licensors table (for anime)
        Schema::create('licensors', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->timestamps();
        });

        // Anime-Licensor pivot table
        Schema::create('anime_licensor', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anime_id')->constrained()->onDelete('cascade');
            $table->foreignId('licensor_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        // Authors table (for manga)
        Schema::create('authors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('biography')->nullable();
            $table->timestamps();
        });

        // Manga-Author pivot table with role
        Schema::create('manga_author', function (Blueprint $table) {
            $table->id();
            $table->foreignId('manga_id')->constrained()->onDelete('cascade');
            $table->foreignId('author_id')->constrained()->onDelete('cascade');
            $table->string('role')->nullable(); // Story, Art, etc.
            $table->timestamps();
        });

        // Ratings table
        Schema::create('content_ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('content_id')->constrained()->onDelete('cascade');
            $table->integer('rating');
            $table->text('review')->nullable();
            $table->unique(['user_id', 'content_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('content_ratings');
        Schema::dropIfExists('manga_author');
        Schema::dropIfExists('authors');
        Schema::dropIfExists('anime_licensor');
        Schema::dropIfExists('licensors');
        Schema::dropIfExists('anime_producer');
        Schema::dropIfExists('producers');
        Schema::dropIfExists('anime_studio');
        Schema::dropIfExists('studios');
        Schema::dropIfExists('content_genre');
        Schema::dropIfExists('genres');
        Schema::dropIfExists('mangas');
        Schema::dropIfExists('animes');
        Schema::dropIfExists('contents');

        Storage::disk('public')->deleteDirectory('anime');
        Storage::disk('public')->makeDirectory('anime');

    }
};
