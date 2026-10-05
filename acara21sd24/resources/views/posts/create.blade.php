<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Buat post latihan</h2>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
            <form class="space-y-4 rounded bg-white p-6 shadow" method="POST" action="{{ route('posts.store') }}">
                @csrf
                <div>
                    <x-input-label for="title" value="Judul" />
                    <x-text-input id="title" name="title" class="mt-1 block w-full" :value="old('title')" required />
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="body" value="Isi" />
                    <textarea id="body" name="body" rows="5" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>{{ old('body') }}</textarea>
                    <x-input-error :messages="$errors->get('body')" class="mt-2" />
                </div>
                <x-primary-button>Simpan post</x-primary-button>
            </form>
        </div>
    </div>
</x-app-layout>
