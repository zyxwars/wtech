<!doctype html>
<html lang="en" data-theme="mytheme">
<head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Record Store</title>

    <!-- Fonts -->

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
  <nav
    class="bg-base-200 sticky left-0 right-0 top-0 z-10 flex flex-col flex-wrap px-3 pb-3 pt-2 sm:pt-3 gap-1 sm:gap-0 shadow-sm sm:pl-10 sm:pr-6">
      <div class="flex items-center justify-between">
          <div class="flex items-center">
              <!-- Logo -->
              <a href="{{ route('home') }}" class="flex-none text-lg font-bold hover:line-through">
                  Record Store
              </a>
          </div>

          <!-- Action buttons -->
          <div class="text-base-content flex-none flex items-center gap-2">
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
                      <a href="{{route('logout')}}"
                          onclick="event.preventDefault();
                                  this.closest('form').submit();">
                          Sign out
                      </a>
                  </li>
                </ul>
            </form>
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

  <main class="flex justify-center">
    <div class="w-full max-w-[1600px] px-4 lg:px-20">
      @yield('content')
    </div>
  </main>
</body>
</html>
