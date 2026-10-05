<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class PostController extends Controller
{
    public function index(): View
    {
        return view('posts.index', [
            'posts' => Post::with('user')->latest()->get(),
        ]);
    }

    public function create(): View
    {
        return view('posts.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string'],
        ]);

        $request->user()->posts()->create($validated);

        return redirect()->route('posts.index');
    }

    public function editWithGate(Post $post): View
    {
        Gate::authorize('edit-post', $post);

        return $this->editView($post, 'Gate');
    }

    public function editWithPolicy(Post $post): View
    {
        $this->authorize('update', $post);

        return $this->editView($post, 'Policy');
    }

    public function edit(Post $post): View
    {
        return $this->editView($post, 'Middleware can:update,post');
    }

    public function update(Request $request, Post $post): RedirectResponse
    {
        $this->authorize('update', $post);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string'],
        ]);

        $post->update($validated);

        return redirect()->route('posts.index');
    }

    private function editView(Post $post, string $authorizationMethod): View
    {
        return view('posts.edit', [
            'post' => $post,
            'authorizationMethod' => $authorizationMethod,
        ]);
    }
}
