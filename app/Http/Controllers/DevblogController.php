<?php

namespace App\Http\Controllers;

use App\Models\DevblogPost;
use Illuminate\Contracts\View\View;

class DevblogController extends Controller
{
    public function index(): View
    {
        $posts = DevblogPost::query()->orderByDesc('published_at')->paginate(20);

        return view('services.devblog.index', ['posts' => $posts]);
    }

    public function show(string $slug): View
    {
        $post = DevblogPost::query()->where('slug', $slug)->firstOrFail();

        return view('services.devblog.item', ['post' => $post]);
    }
}
