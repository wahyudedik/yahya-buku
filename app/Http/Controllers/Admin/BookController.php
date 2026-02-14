<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Book;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BookController extends Controller
{
    public function index(): View
    {
        $books = Book::latest()->paginate(10);
        return view('admin.books.index', compact('books'));
    }

    public function create(): View
    {
        return view('admin.books.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'author' => 'required|string|max:255',
            'category' => 'required|string',
            'description' => 'nullable|string|max:500',
            'price' => 'required|numeric|min:0',
            'wa_number' => 'nullable|string|max:20',
            'stock' => 'required|integer|min:0',
            'cover_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'pdf_file' => 'nullable|file|mimes:pdf|max:10240',
            'is_featured' => 'boolean',
        ]);

        if ($request->hasFile('cover_image')) {
            $validated['cover_image_path'] = $request->file('cover_image')->store('books/covers', 'public');
        }

        if ($request->hasFile('pdf_file')) {
            $validated['pdf_file_path'] = $request->file('pdf_file')->store('books/pdfs', 'public');
        }

        $validated['is_featured'] = $request->has('is_featured');

        Book::create($validated);

        return redirect()->route('admin.books.index')->with('status', 'Buku berhasil ditambahkan.');
    }

    public function edit(Book $book): View
    {
        return view('admin.books.edit', compact('book'));
    }

    public function update(Request $request, Book $book): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'author' => 'required|string|max:255',
            'category' => 'required|string',
            'description' => 'nullable|string|max:500',
            'price' => 'required|numeric|min:0',
            'wa_number' => 'nullable|string|max:20',
            'stock' => 'required|integer|min:0',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'pdf_file' => 'nullable|file|mimes:pdf|max:10240',
            'is_featured' => 'boolean',
        ]);

        if ($request->hasFile('cover_image')) {
            if ($book->cover_image_path) {
                Storage::disk('public')->delete($book->cover_image_path);
            }
            $validated['cover_image_path'] = $request->file('cover_image')->store('books/covers', 'public');
        }

        if ($request->hasFile('pdf_file')) {
            if ($book->pdf_file_path) {
                Storage::disk('public')->delete($book->pdf_file_path);
            }
            $validated['pdf_file_path'] = $request->file('pdf_file')->store('books/pdfs', 'public');
        }

        $validated['is_featured'] = $request->has('is_featured');

        $book->update($validated);

        return redirect()->route('admin.books.index')->with('status', 'Data buku berhasil diperbarui.');
    }

    public function destroy(Book $book): RedirectResponse
    {
        if ($book->cover_image_path) {
            Storage::disk('public')->delete($book->cover_image_path);
        }
        
        if ($book->pdf_file_path) {
            Storage::disk('public')->delete($book->pdf_file_path);
        }

        $book->delete();

        return redirect()->route('admin.books.index')->with('status', 'Buku berhasil dihapus.');
    }
}
