<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Book;
use App\Models\Career;
use App\Models\ContactMessage;
use App\Models\Gallery;
use App\Models\Service;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        return view('dashboard', [
            'stats' => [
                'articles_published' => Article::where('status', 'published')->count(),
                'articles_draft' => Article::where('status', 'draft')->count(),
                'books' => Book::count(),
                'services' => Service::where('is_active', true)->count(),
                'careers' => Career::where('is_active', true)->count(),
                'galleries' => Gallery::where('is_active', true)->count(),
                'messages_unread' => ContactMessage::where('is_read', false)->count(),
            ],
            'recentArticles' => Article::with('author')->latest()->take(5)->get(),
            'recentMessages' => ContactMessage::latest()->take(5)->get(),
        ]);
    }
}
