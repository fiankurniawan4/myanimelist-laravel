<x-layouts.member :title="__('Home')">
    {{-- Navbar --}}
    <x-layouts.member.navbar />
    {{-- Content ads banner --}}
    <div class="w-[76%] mx-auto">
        <div class="container mx-auto flex flex-col md:flex-row items-center justify-between">
            {{-- ads --}}
            <img src="{{ Storage::url('ads/ads.jpeg') }}" alt="Advertisement" class="w-full h-auto">
        </div>
    </div>

    {{-- Main content --}}
    <div class="w-[83%] mx-auto">
        {{-- Nav content --}}
        <div class="bg-[#2E51A2] w-full flex px-[10px] py-2 justify-between">
            <div class="flex flex-row gap-6">
                <a href="#">
                    <p class="text-[13px] text-white font-semibold font-sans">Anime</p>
                </a>
            </div>
            {{-- search --}}
            <div class="flex items-center h-[18px] indent-0.5">
                <form method="GET" class="flex">
                    <input type="text" name="query" placeholder="Search Anime, Manga, and more..." class="px-3 text-[12px] border border-[#121212] rounded-l-sm focus:outline-none focus:border-none bg-[#121212] text-white w-[260px]">
                    <button type="submit" class="text-[#606060] bg-[#353535] rounded-r-sm px-1 hover:cursor-pointer">
                        <svg width="12px" height="12px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path fill="currentColor" d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z" /></svg>
                    </button>
                </form>
            </div>
        </div>
        {{-- Title --}}
        <div class="bg-[#222222] w-full flex px-[10px] py-1 border-b">
            <h1 class="font-bold text-white">Welcome to MyAnimeList</h1>
        </div>
        <div class="bg-[#222222] w-full flex-col">
            {{-- Anime List (New Anime) --}}
            <div class="flex justify-between border-b border-[#333333] p-2 mb-2 items-center">
                <p class="text-sm hover:underline hover:cursor-pointer font-semibold text-white">New Updated Anime!</p>
                <p class="text-[11px] hover:underline hover:cursor-pointer text-gray-300">View More</p>
            </div>
            <div class="relative group px-2">
                <div class="flex overflow-x-auto scrollbar-hide">
                    <div class="flex gap-4">
                        @foreach ($anime['update'] as $content)
                        <a href="home/anime/detail/{{$content->id}}" class="flex-shrink-0 relative">
                            <div class="relative w-[160px] h-[220px]">
                                <img src="{{ Storage::url($content->image) }}" alt="{{ $content->title }}" class="absolute inset-0 w-full h-full object-cover rounded" loading="lazy">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>
                                <div class="absolute bottom-0 w-full px-2 pb-1">
                                    <p class="text-white text-[11px] font-bold line-clamp-2">
                                        {{ $content->title }}
                                    </p>
                                    <div class="flex items-center mt-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-3 h-3 text-yellow-400 mr-1">
                                            <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd" />
                                        </svg>
                                        <span class="text-white text-[10px]">{{ number_format($content->average_rating ?? 0, 1) }}</span>
                                    </div>
                                    @if($content->anime && $content->anime->episodes)
                                    <p class="text-gray-300 text-[10px] mt-1">
                                        Episodes: {{ $content->anime->episodes }}
                                    </p>
                                    @endif
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                <button class="absolute hover:cursor-pointer left-0 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-2 rounded-full hidden group-hover:block" onclick="scrollContent(this, 'left')">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <button class="absolute hover:cursor-pointer right-0 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-2 rounded-full hidden group-hover:block" onclick="scrollContent(this, 'right')">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
            {{-- Anime List (Update Anime) --}}
            <div class="flex justify-between border-b border-[#333333] p-2 mb-2 items-center">
                <p class="text-sm hover:underline hover:cursor-pointer font-semibold text-white">New Uploaded Anime!</p>
                <p class="text-[11px] hover:underline hover:cursor-pointer text-gray-300">View More</p>
            </div>
            <div class="relative group px-2">
                <div class="flex overflow-x-auto scrollbar-hide">
                    <div class="flex gap-4">
                        @foreach ($anime['new'] as $content)
                        <a class="flex-shrink-0 relative hover:cursor-pointer">
                            <div class="relative w-[160px] h-[220px]">
                                <img src="{{ Storage::url($content->image) }}" alt="{{ $content->title }}" class="absolute inset-0 w-full h-full object-cover rounded" loading="lazy">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>
                                <div class="absolute bottom-0 w-full px-2 pb-1">
                                    <p class="text-white text-[11px] font-bold line-clamp-2">
                                        {{ $content->title }}
                                    </p>
                                    <div class="flex items-center mt-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-3 h-3 text-yellow-400 mr-1">
                                            <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd" />
                                        </svg>
                                        <span class="text-white text-[10px]">{{ number_format($content->average_rating ?? 0, 1) }}</span>
                                    </div>
                                    @if($content->anime && $content->anime->episodes)
                                    <p class="text-gray-300 text-[10px] mt-1">
                                        Episodes: {{ $content->anime->episodes }}
                                    </p>
                                    @endif
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                <button class="absolute hover:cursor-pointer left-0 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-2 rounded-full hidden group-hover:block" onclick="scrollContent(this, 'left')">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <button class="absolute hover:cursor-pointer right-0 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-2 rounded-full hidden group-hover:block" onclick="scrollContent(this, 'right')">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
            {{-- Anime List (Popular Anime) --}}
            <div class="flex justify-between border-b border-[#333333] p-2 mb-2 items-center">
                <p class="text-sm hover:underline hover:cursor-pointer font-semibold text-white">New Popular Anime!</p>
                <p class="text-[11px] hover:underline hover:cursor-pointer text-gray-300">View More</p>
            </div>
            <div class="relative group px-2">
                <div class="flex overflow-x-auto scrollbar-hide">
                    <div class="flex gap-4">
                        @foreach ($anime['popular'] as $content)
                        <a class="flex-shrink-0 relative hover:cursor-pointer">
                            <div class="relative w-[160px] h-[220px]">
                                <img src="{{ Storage::url($content->image) }}" alt="{{ $content->title }}" class="absolute inset-0 w-full h-full object-cover rounded" loading="lazy">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>
                                <div class="absolute bottom-0 w-full px-2 pb-1">
                                    <p class="text-white text-[11px] font-bold line-clamp-2">
                                        {{ $content->title }}
                                    </p>
                                    <div class="flex items-center mt-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-3 h-3 text-yellow-400 mr-1">
                                            <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd" />
                                        </svg>
                                        <span class="text-white text-[10px]">{{ number_format($content->average_rating ?? 0, 1) }}</span>
                                    </div>
                                    @if($content->anime && $content->anime->episodes)
                                    <p class="text-gray-300 text-[10px] mt-1">
                                        Episodes: {{ $content->anime->episodes }}
                                    </p>
                                    @endif
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                <button class="absolute hover:cursor-pointer left-0 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-2 rounded-full hidden group-hover:block" onclick="scrollContent(this, 'left')">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <button class="absolute hover:cursor-pointer right-0 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-2 rounded-full hidden group-hover:block" onclick="scrollContent(this, 'right')">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <style>
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .scrollbar-hide {
            -ms-overflow-style: none;
            /* IE and Edge */
            scrollbar-width: none;
            /* Firefox */
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

    </style>
    <script>
        function scrollContent(button, direction) {
            const container = button.closest('.group').querySelector('.scrollbar-hide');
            const scrollAmount = 400;

            if (direction === 'left') {
                container.scrollBy({
                    left: -scrollAmount
                    , behavior: 'smooth'
                });
            } else if (direction === 'right') {
                container.scrollBy({
                    left: scrollAmount
                    , behavior: 'smooth'
                });
            }
        }

    </script>
</x-layouts.member>
