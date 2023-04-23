<div class="ml-3 relative" x-data=" { open: false }">
    <div class="flex items-center md:ml-auto md:pr-4">
    </div>
    <ul class="flex flex-row justify-end pl-0 mb-0 list-none md-max:w-full">
        <li class="flex items-center">
            <a href="#"
                class="block px-0 py-2 font-semibold transition-all ease-nav-brand text-size-sm text-slate-500"
                id="user-menu" aria-label="User menu" aria-haspopup="true" @click="open = !open">
                <i class="fa fa-user sm:mr-1" aria-hidden="true"></i>
                @if (isset(Auth::user()->name))
                    <span class="">{{ Auth::user()->name }}</span>
                @endif
            </a>
        </li>
    </ul>
    <div class="origin-top-right absolute right-0 mt-2 w-48 
              rounded-md shadow-lg" x-show="open" x-cloak
        x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95"
        x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95">
        <div class=" py-1 rounded-md bg-white shadow-xs" role="menu" aria-orientation="vertical"
            aria-labelledby="user-menu">
            <a href="#" class="block px-4 py-2 text-sm text-gray-700 
                   hover:bg-gray-100"
                role="menuitem">Your Profile</a>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                class="block px-4 py-2 text-sm text-gray-700 
                   hover:bg-gray-100" role="menuitem">Sign
                out</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>
</div>
