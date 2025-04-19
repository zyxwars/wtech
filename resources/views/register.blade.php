<x-layout>
    <x-header></x-header>

    <!-- Page layout -->
    <main class="mt-8 flex items-start justify-center p-4">
        <form class="grid max-w-64 gap-2" method="POST" action="{{ route('register') }}">
            @csrf

            <h1 class=" mb-2 text-2xl font-bold">Sign up</h1>

            <input class="input" placeholder="Email" type="email" name="email" value="{{ old('email') }}" required
                autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" />

            <input class="input" type="password" placeholder="Password" name="password" required
                autocomplete="new-password" / />
            <x-input-error :messages="$errors->get('password')" />

            <input class="input" type="password" placeholder="Password Confirmation" name="password_confirmation"
                required autocomplete="new-password" / />
            <x-input-error :messages="$errors->get('password_confirmation')" />


            <button class="btn btn-primary mt-2" type="submit">
                Sign up
            </button>

            <div class="mt-2 justify-self-center">
                Already have an account?
                <a class="font-bold underline" href="{{ route('login') }}">Sign in</a>
            </div>
        </form>
    </main>
</x-layout>
