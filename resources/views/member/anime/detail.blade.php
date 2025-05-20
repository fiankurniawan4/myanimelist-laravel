<x-layouts.member :title="__('Detail')">
    {{-- Navbar --}}
    <x-layouts.member.navbar />

    {{-- Content --}}
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
    </div>
</x-layouts.member>
