<nav class="flex items-center justify-between px-4 py-2 bg-[#121212] shadow-md">
    <div class="flex ml-24">
        <h1 class="text-white font-bold font-serif text-2xl">MyAnimeList</h1>
    </div>
    <div class="flex gap-4 text-white justify-center items-center font-serif text-xl mr-24">
        @auth
        <p class="text-[18px] text-center">{{ auth()->user()->name }} | {{ auth()->user()->role }}</p>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <flux:button as="button" type="submit" size="sm" class="hover:cursor-pointer font-serif">Logout</flux:button>
        </form>
        @endauth
        @guest
        <button class="border rounded-md px-2 hover:cursor-pointer">Login</button>
        <button class="border rounded-md px-2 hover:cursor-pointer">Register</button>
        @endguest
    </div>
</nav>
