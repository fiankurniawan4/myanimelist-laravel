<x-layouts.app :title="__('Dashboard | Create')">
    <div class="py-12 bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-lg shadow-gray-900/50 rounded-lg">
                <div class="p-6 bg-gray-800 border-b border-gray-700">
                    @if (session('error'))
                    <div class="mb-4 bg-red-900 border border-red-700 text-red-100 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                    @endif

                    <form method="POST" action="{{ route('dashboard.posts.create') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Basic Information -->
                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-100 mb-2">Basic Information</h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Title -->
                                <div>
                                    <x-label for="title" :value="__('Title')" class="text-gray-300" />
                                    <x-input id="title" class="block mt-1 w-full bg-gray-700 border-gray-600 text-white focus:border-indigo-500 focus:ring-indigo-500" type="text" name="title" :value="old('title')" required />
                                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                                </div>

                                <!-- Type -->
                                <div>
                                    <x-label for="type" :value="__('Type')" class="text-gray-300" />
                                    <select id="type" name="type" class="block mt-1 w-full rounded-md bg-gray-700 border-gray-600 text-white focus:border-indigo-500 focus:ring-indigo-500">
                                        <option value="TV" {{ old('type') == 'TV' ? 'selected' : '' }}>TV</option>
                                        <option value="Movie" {{ old('type') == 'Movie' ? 'selected' : '' }}>Movie</option>
                                        <option value="OVA" {{ old('type') == 'OVA' ? 'selected' : '' }}>OVA</option>
                                        <option value="ONA" {{ old('type') == 'ONA' ? 'selected' : '' }}>ONA</option>
                                        <option value="Special" {{ old('type') == 'Special' ? 'selected' : '' }}>Special</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('type')" class="mt-2" />
                                </div>

                                <!-- Status -->
                                <div>
                                    <x-label for="status" :value="__('Status')" class="text-gray-300" />
                                    <select id="status" name="status" class="block mt-1 w-full rounded-md bg-gray-700 border-gray-600 text-white focus:border-indigo-500 focus:ring-indigo-500">
                                        <option value="Airing" {{ old('status') == 'Airing' ? 'selected' : '' }}>Airing</option>
                                        <option value="Finished Airing" {{ old('status') == 'Finished Airing' ? 'selected' : '' }}>Finished Airing</option>
                                        <option value="Not Yet Aired" {{ old('status') == 'Not Yet Aired' ? 'selected' : '' }}>Not Yet Aired</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('status')" class="mt-2" />
                                </div>

                                <!-- Episodes -->
                                <div>
                                    <x-label for="episodes" :value="__('Episodes')" class="text-gray-300" />
                                    <x-input id="episodes" class="block mt-1 w-full bg-gray-700 border-gray-600 text-white focus:border-indigo-500 focus:ring-indigo-500" type="number" name="episodes" :value="old('episodes')" min="0" />
                                    <x-input-error :messages="$errors->get('episodes')" class="mt-2" />
                                </div>

                                <!-- Image -->
                                <div class="md:col-span-2">
                                    <x-label for="image" :value="__('Cover Image')" class="text-gray-300" />
                                    <input id="image" type="file" name="image" class="block mt-1 w-full text-gray-300 bg-gray-700 border border-gray-600 rounded-md file:mr-4 file:py-2 file:px-4 file:border-0 file:text-white file:bg-indigo-600 file:rounded hover:file:bg-indigo-700" accept="image/*">
                                    <p class="mt-1 text-sm text-gray-400">JPEG, PNG, JPG or GIF (max. 2MB)</p>
                                    <x-input-error :messages="$errors->get('image')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <!-- Detailed Information -->
                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-100 mb-2">Detailed Information</h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Aired From -->
                                <div>
                                    <x-label for="aired_from" :value="__('Aired From')" class="text-gray-300" />
                                    <x-input id="aired_from" class="block mt-1 w-full bg-gray-700 border-gray-600 text-white focus:border-indigo-500 focus:ring-indigo-500" type="date" name="aired_from" :value="old('aired_from')" />
                                    <x-input-error :messages="$errors->get('aired_from')" class="mt-2" />
                                </div>

                                <!-- Aired To -->
                                <div>
                                    <x-label for="aired_to" :value="__('Aired To')" class="text-gray-300" />
                                    <x-input id="aired_to" class="block mt-1 w-full bg-gray-700 border-gray-600 text-white focus:border-indigo-500 focus:ring-indigo-500" type="date" name="aired_to" :value="old('aired_to')" />
                                    <x-input-error :messages="$errors->get('aired_to')" class="mt-2" />
                                </div>

                                <!-- Premiered -->
                                <div>
                                    <x-label for="premiered" :value="__('Premiered')" class="text-gray-300" />
                                    <x-input id="premiered" class="block mt-1 w-full bg-gray-700 border-gray-600 text-white focus:border-indigo-500 focus:ring-indigo-500" type="text" name="premiered" :value="old('premiered')" placeholder="e.g. Fall 2020" />
                                    <x-input-error :messages="$errors->get('premiered')" class="mt-2" />
                                </div>

                                <!-- Broadcast -->
                                <div>
                                    <x-label for="broadcast" :value="__('Broadcast')" class="text-gray-300" />
                                    <x-input id="broadcast" class="block mt-1 w-full bg-gray-700 border-gray-600 text-white focus:border-indigo-500 focus:ring-indigo-500" type="text" name="broadcast" :value="old('broadcast')" placeholder="e.g. Fridays at 21:00 (JST)" />
                                    <x-input-error :messages="$errors->get('broadcast')" class="mt-2" />
                                </div>

                                <!-- Source -->
                                <div>
                                    <x-label for="source" :value="__('Source')" class="text-gray-300" />
                                    <select id="source" name="source" class="block mt-1 w-full rounded-md bg-gray-700 border-gray-600 text-white focus:border-indigo-500 focus:ring-indigo-500">
                                        <option value=""></option>
                                        <option value="Manga" {{ old('source') == 'Manga' ? 'selected' : '' }}>Manga</option>
                                        <option value="Light Novel" {{ old('source') == 'Light Novel' ? 'selected' : '' }}>Light Novel</option>
                                        <option value="Visual Novel" {{ old('source') == 'Visual Novel' ? 'selected' : '' }}>Visual Novel</option>
                                        <option value="Original" {{ old('source') == 'Original' ? 'selected' : '' }}>Original</option>
                                        <option value="Game" {{ old('source') == 'Game' ? 'selected' : '' }}>Game</option>
                                        <option value="Web Manga" {{ old('source') == 'Web Manga' ? 'selected' : '' }}>Web Manga</option>
                                        <option value="Novel" {{ old('source') == 'Novel' ? 'selected' : '' }}>Novel</option>
                                        <option value="4-koma manga" {{ old('source') == '4-koma manga' ? 'selected' : '' }}>4-koma manga</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('source')" class="mt-2" />
                                </div>

                                <!-- Duration -->
                                <div>
                                    <x-label for="duration" :value="__('Duration')" class="text-gray-300" />
                                    <x-input id="duration" class="block mt-1 w-full bg-gray-700 border-gray-600 text-white focus:border-indigo-500 focus:ring-indigo-500" type="text" name="duration" :value="old('duration')" placeholder="e.g. 24 min. per ep." />
                                    <x-input-error :messages="$errors->get('duration')" class="mt-2" />
                                </div>

                                <!-- Rating -->
                                <div>
                                    <x-label for="rating" :value="__('Rating')" class="text-gray-300" />
                                    <select id="rating" name="rating" class="block mt-1 w-full rounded-md bg-gray-700 border-gray-600 text-white focus:border-indigo-500 focus:ring-indigo-500">
                                        <option value=""></option>
                                        <option value="G - All Ages" {{ old('rating') == 'G - All Ages' ? 'selected' : '' }}>G - All Ages</option>
                                        <option value="PG - Children" {{ old('rating') == 'PG - Children' ? 'selected' : '' }}>PG - Children</option>
                                        <option value="PG-13 - Teens 13 or older" {{ old('rating') == 'PG-13 - Teens 13 or older' ? 'selected' : '' }}>PG-13 - Teens 13 or older</option>
                                        <option value="R - 17+ (violence & profanity)" {{ old('rating') == 'R - 17+ (violence & profanity)' ? 'selected' : '' }}>R - 17+ (violence & profanity)</option>
                                        <option value="R+ - Mild Nudity" {{ old('rating') == 'R+ - Mild Nudity' ? 'selected' : '' }}>R+ - Mild Nudity</option>
                                        <option value="Rx - Hentai" {{ old('rating') == 'Rx - Hentai' ? 'selected' : '' }}>Rx - Hentai</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('rating')" class="mt-2" />
                                </div>

                                <!-- Synopsis -->
                                <div class="md:col-span-2">
                                    <x-label for="synopsis" :value="__('Synopsis')" class="text-gray-300" />
                                    <textarea id="synopsis" name="synopsis" rows="5" class="block mt-1 w-full rounded-md bg-gray-700 border-gray-600 text-white focus:border-indigo-500 focus:ring-indigo-500">{{ old('synopsis') }}</textarea>
                                    <x-input-error :messages="$errors->get('synopsis')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <!-- Relations -->
                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-100 mb-2">Relations</h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Genres -->
                                <div>
                                    <x-label for="genres" :value="__('Genres')" class="text-gray-300" />
                                    <select id="genres" name="genres[]" multiple class="block mt-1 w-full rounded-md bg-gray-700 border-gray-600 text-white focus:border-indigo-500 focus:ring-indigo-500">
                                        @foreach($genres as $genre)
                                        <option value="{{ $genre->id }}" {{ in_array($genre->id, old('genres', [])) ? 'selected' : '' }}>
                                            {{ $genre->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <p class="mt-1 text-sm text-gray-400">Hold down Ctrl (Windows) or Command (Mac) to select multiple options</p>
                                    <x-input-error :messages="$errors->get('genres')" class="mt-2" />
                                </div>

                                <!-- Studios -->
                                <div>
                                    <x-label for="studios" :value="__('Studios')" class="text-gray-300" />
                                    <select id="studios" name="studios[]" multiple class="block mt-1 w-full rounded-md bg-gray-700 border-gray-600 text-white focus:border-indigo-500 focus:ring-indigo-500">
                                        @foreach($studios as $studio)
                                        <option value="{{ $studio->id }}" {{ in_array($studio->id, old('studios', [])) ? 'selected' : '' }}>
                                            {{ $studio->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <p class="mt-1 text-sm text-gray-400">Hold down Ctrl (Windows) or Command (Mac) to select multiple options</p>
                                    <x-input-error :messages="$errors->get('studios')" class="mt-2" />
                                </div>

                                <!-- Producers -->
                                <div>
                                    <x-label for="producers" :value="__('Producers')" class="text-gray-300" />
                                    <select id="producers" name="producers[]" multiple class="block mt-1 w-full rounded-md bg-gray-700 border-gray-600 text-white focus:border-indigo-500 focus:ring-indigo-500">
                                        @foreach($producers as $producer)
                                        <option value="{{ $producer->id }}" {{ in_array($producer->id, old('producers', [])) ? 'selected' : '' }}>
                                            {{ $producer->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <p class="mt-1 text-sm text-gray-400">Hold down Ctrl (Windows) or Command (Mac) to select multiple options</p>
                                    <x-input-error :messages="$errors->get('producers')" class="mt-2" />
                                </div>

                                <!-- Licensors -->
                                <div>
                                    <x-label for="licensors" :value="__('Licensors')" class="text-gray-300" />
                                    <select id="licensors" name="licensors[]" multiple class="block mt-1 w-full rounded-md bg-gray-700 border-gray-600 text-white focus:border-indigo-500 focus:ring-indigo-500">
                                        @foreach($licensors as $licensor)
                                        <option value="{{ $licensor->id }}" {{ in_array($licensor->id, old('licensors', [])) ? 'selected' : '' }}>
                                            {{ $licensor->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <p class="mt-1 text-sm text-gray-400">Hold down Ctrl (Windows) or Command (Mac) to select multiple options</p>
                                    <x-input-error :messages="$errors->get('licensors')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('dashboard.posts') }}" class="inline-flex items-center px-4 py-2 bg-gray-700 border border-gray-600 rounded-md font-semibold text-xs text-gray-200 uppercase tracking-widest shadow-sm hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150">
                                Cancel
                            </a>

                            <button type="submit" class="ml-4 bg-indigo-600 hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-800 focus:ring-indigo-500">
                                {{ __('Create Anime') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
