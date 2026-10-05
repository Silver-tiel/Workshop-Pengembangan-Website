<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Latihan Authorization: Posts</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <a class="mb-6 inline-block rounded bg-indigo-600 px-4 py-2 text-white" href="{{ route('posts.create') }}">Buat post</a>

            @forelse ($posts as $post)
                <article class="mb-5 rounded bg-white p-6 shadow">
                    <h3 class="text-lg font-semibold">{{ $post->title }}</h3>
                    <p class="mt-2 whitespace-pre-line">{{ $post->body }}</p>
                    <p class="mt-2 text-sm text-gray-600">Pemilik: {{ $post->user->name }}</p>

                    <div class="mt-4 flex flex-wrap gap-3 text-sm">
                        @can('edit-post', $post)
                            <a class="underline" href="{{ route('posts.gate-edit', $post) }}">Edit (Gate)</a>
                        @endcan
                        @can('update', $post)
                            <a class="underline" href="{{ route('posts.policy-edit', $post) }}">Edit (Policy)</a>
                            <a class="underline" href="{{ route('posts.middleware-edit', $post) }}">Edit (Middleware can)</a>
                        @endcan
                    </div>
                </article>
            @empty
                <p class="rounded bg-white p-6 shadow">Belum ada post. Buat post untuk menguji Gate dan Policy.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
