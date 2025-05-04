<!-- https://github.com/laravel/breeze/blob/2.x/stubs/default/resources/views/auth/login.blade.php -->

<x-layout>
    <x-header></x-header>

    <main class="mt-8 flex items-start justify-center p-4">
        <form class="grid gap-2 max-w-64" method="POST" action="{{ route('login') }}">
            @csrf

            <h1 class="mb-2 text-2xl font-bold">Sign in</h1>

            <input placeholder="Email" class="input" type="email" name="email" value="{{ old('email') }}" required
                autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" />

            <input class='input' type="password" name='password' placeholder="Password" required
                autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" />

            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                        name="remember">
                    <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">Remember me</span>
                </label>
            </div>

            <button class="btn btn-primary mt-2" type="submit">
                Sign in
            </button>

            <div class="mt-2 justify-self-center">
                Don't have an account?
                <a class="font-bold underline" href="{{ route('register') }}">Sign up</a>
            </div>

        </form>
    </main>
</x-layout>
