<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Book;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function ruangTulisan()
    {
        return view('pages.ruang-tulisan');
    }

    public function showArticle($slug)
    {
        $article = Article::where('slug', $slug)->where('status', 'published')->firstOrFail();
        return view('pages.article-detail', compact('article'));
    }

    public function layanan()
    {
        return view('pages.layanan');
    }

    public function toko(Request $request)
    {
        $query = Book::query();

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('author', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($request->has('category') && $request->get('category') != '') {
            $query->where('category', $request->get('category'));
        }

        $sort = $request->get('sort', 'latest');
        switch ($sort) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'title_asc':
                $query->orderBy('title', 'asc');
                break;
            case 'title_desc':
                $query->orderBy('title', 'desc');
                break;
            default:
                $query->latest();
                break;
        }

        $books = $query->paginate(12)->withQueryString();
        
        return view('pages.toko', compact('books'));
    }

    public function showBook($slug)
    {
        $book = Book::where('slug', $slug)->firstOrFail();
        return view('pages.book-detail', compact('book'));
    }

    public function kontak()
    {
        return view('pages.kontak');
    }

    public function profil()
    {
        return view('pages.profil');
    }

    public function galeri()
    {
        return view('pages.galeri');
    }

    public function karir()
    {
        return view('pages.karir');
    }

    public function faq()
    {
        return view('pages.faq');
    }
}
