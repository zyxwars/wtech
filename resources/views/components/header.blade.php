<nav
    class="bg-base-100 sticky left-0 right-0 top-0 z-10 flex flex-col flex-wrap px-2 pb-4 pt-3 shadow-sm sm:pl-10 sm:pr-6">
    <div class="flex items-center justify-between">
        <div class="flex items-center">
            <!-- Logo -->
            <a
                href="/"
                class="flex-none text-lg font-bold hover:line-through">
                Record Store
            </a>

            <!-- Desktop searchbar -->
            <!-- https://daisyui.com/components/input/ -->
            <label class="input ml-10 hidden w-[32rem] md:flex">
                <svg
                    class="h-[1em] opacity-50"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24">
                    <g
                        stroke-linejoin="round"
                        stroke-linecap="round"
                        stroke-width="2.5"
                        fill="none"
                        stroke="currentColor">
                        <circle cx="11" cy="11" r="8"></circle>
                        <path d="m21 21-4.3-4.3"></path>
                    </g>
                </svg>
                <input
                    type="search"
                    class="grow"
                    placeholder="The Blues Ain't Never Gonna Die" />
            </label>
        </div>

        <!-- Action buttons -->
        <div class="text-base-content flex-none">
            <!-- https://daisyui.com/components/dropdown/ -->
            <button
                class="btn btn-ghost btn-circle"
                popovertarget="popover-user"
                style="anchor-name: --anchor-user">
                <span class="material-symbols-outlined">person</span>
            </button>
            <ul
                class="dropdown menu rounded-box bg-base-100 dropdown-center w-52 shadow-sm"
                popover
                id="popover-user"
                style="position-anchor: --anchor-user">
                <li>
                    <a href="./login.html">Logout</a>
                </li>
            </ul>

            <a href="./cart.html" class="btn btn-ghost btn-circle">
                <span class="material-symbols-outlined">shopping_cart</span>
            </a>
        </div>
    </div>

    <!-- Mobile search bar -->
    <!-- https://daisyui.com/components/input/ -->
    <label class="input w-full md:hidden">
        <svg
            class="h-[1em] opacity-50"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 24 24">
            <g
                stroke-linejoin="round"
                stroke-linecap="round"
                stroke-width="2.5"
                fill="none"
                stroke="currentColor">
                <circle cx="11" cy="11" r="8"></circle>
                <path d="m21 21-4.3-4.3"></path>
            </g>
        </svg>
        <input
            type="search"
            class="grow"
            placeholder="The Blues Ain't Never Gonna Die" />
    </label>
</nav>