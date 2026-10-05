<x-guest-layout>
    <h1 class="mb-4 text-lg font-medium text-gray-900">Login manual</h1>

    <form method="POST" action="{{ route('manual.login.store') }}">
        @csrf

        <div>
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" class="mt-1 block w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" value="Password" />
            <x-text-input id="password" class="mt-1 block w-full" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <label class="mt-4 inline-flex items-center">
            <input type="checkbox" name="remember" value="1" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
            <span class="ms-2 text-sm text-gray-600">Ingat saya</span>
        </label>

        <div class="mt-4 flex items-center justify-between">
            <a class="text-sm underline" href="{{ route('manual.register') }}">Buat akun latihan</a>
            <x-primary-button>Login</x-primary-button>
        </div>
    </form>
</x-guest-layout>
