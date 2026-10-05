<x-guest-layout>
    <div class="mb-4 text-sm text-gray-700">
        @auth
            <p>Welcome, {{ Auth::user()->name }}</p>
        @endauth

        @guest
            <p>Welcome, Guest</p>
        @endguest

        <p class="mt-2">Auth::id(): {{ $userId ?? 'null (belum login)' }}</p>

        @guest
            <a class="mt-4 inline-block underline" href="{{ route('login') }}">Login</a>
        @endguest
        @auth
            <a class="mt-4 inline-block underline" href="{{ route('dashboard') }}">Dashboard</a>
        @endauth
    </div>
</x-guest-layout>
