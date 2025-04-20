<nav
    class="bg-base-200 sticky left-0 right-0 top-0 z-10 flex flex-col flex-wrap px-3 pb-3 pt-2 sm:pt-3 gap-1 sm:gap-0 shadow-sm sm:pl-10 sm:pr-6">
    <div class="flex items-center justify-between">
        <div class="flex items-center">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex-none text-lg font-bold hover:line-through">
                Record Store
            </a>

            <!-- Desktop searchbar -->
            <form action="{{ route('product.search') }}" method="GET" class="hidden md:block w-[32rem]">
                <!-- https://daisyui.com/components/input/ -->
                <label class="input ml-10 w-full">
                    <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <g stroke-linejoin="round" stroke-linecap="round" stroke-width="2.5" fill="none"
                            stroke="currentColor">
                            <circle cx="11" cy="11" r="8"></circle>
                            <path d="m21 21-4.3-4.3"></path>
                        </g>
                    </svg>

                    <input name='search' type="search" class="grow" placeholder="The Blues Ain't Never Gonna Die" />
                </label>
            </form>
        </div>

        <!-- Action buttons -->
        <div class="text-base-content flex-none flex items-center gap-2">
            @if ($user != null)
                <!-- https://daisyui.com/components/dropdown/ -->
                <button class="btn btn-ghost btn-circle" popovertarget="popover-user"
                    style="anchor-name: --anchor-user">
                    <span class="material-symbols-outlined">person</span>
                </button>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <ul class="dropdown menu rounded-box bg-base-100 dropdown-center w-52 shadow-sm" popover
                        id="popover-user" style="position-anchor: --anchor-user">
                        <li>
                            <a :href="route('logout')"
                                onclick="event.preventDefault();
                                        this.closest('form').submit();">
                                Sign out
                            </a>
                        </li>
                    </ul>
                </form>
            @else
                <a href={{ route('login') }}>
                    Sign In
                </a>
            @endif

            <a href="{{ route('cart.index') }}" class="btn btn-ghost btn-circle">
                <span class="material-symbols-outlined">shopping_cart</span>
            </a>
        </div>
    </div>

    <!-- Mobile search bar -->
    <form action="{{ route('product.search') }}" method="GET" class="md:hidden w-full">
        <!-- https://daisyui.com/components/input/ -->
        <label class="input w-full">
            <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <g stroke-linejoin="round" stroke-linecap="round" stroke-width="2.5" fill="none"
                    stroke="currentColor">
                    <circle cx="11" cy="11" r="8"></circle>
                    <path d="m21 21-4.3-4.3"></path>
                </g>
            </svg>
            <input name='search' type="search" class="grow" placeholder="The Blues Ain't Never Gonna Die" />
        </label>
    </form>
</nav>
