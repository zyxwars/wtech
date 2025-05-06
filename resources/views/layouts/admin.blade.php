<!doctype html>
<html lang="en" data-theme="mytheme">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <title>@yield('title','Admin – Record Store')</title>
  <link rel="icon" href="{{ asset('assets/vinyl.svg') }}" />

  <!-- fonts & CSS -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:…&display=swap" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" />
  <link href="{{ asset('css/global.css') }}" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body>
  <nav class="bg-base-100 sticky top-0 z-10 …">
    <div class="flex items-center justify-between">
      <a href="{{ url('/') }}" class="text-lg font-bold">Record Store</a>
      <div>
        <a href="{{ route('logout') }}" class="btn btn-ghost btn-circle">
          <span class="material-symbols-outlined">logout</span>
        </a>
      </div>
    </div>
  </nav>

  <main class="flex justify-center">
    <div class="w-full max-w-[1600px] px-4 lg:px-20">
      @yield('content')
    </div>
  </main>
</body>
</html>
