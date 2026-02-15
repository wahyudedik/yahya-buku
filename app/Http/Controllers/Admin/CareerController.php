<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Career;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CareerController extends Controller
{
    public function index(): View
    {
        $careers = Career::latest()->paginate(10);
        return view('admin.careers.index', compact('careers'));
    }

    public function create(): View
    {
        return view('admin.careers.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:255',
            'apply_url' => 'nullable|url|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        Career::create($validated);

        return redirect()->route('admin.careers.index')->with('status', 'Lowongan karir berhasil ditambahkan.');
    }

    public function edit(Career $career): View
    {
        return view('admin.careers.edit', compact('career'));
    }

    public function update(Request $request, Career $career): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:255',
            'apply_url' => 'nullable|url|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $career->update($validated);

        return redirect()->route('admin.careers.index')->with('status', 'Lowongan karir berhasil diperbarui.');
    }

    public function destroy(Career $career): RedirectResponse
    {
        $career->delete();

        return redirect()->route('admin.careers.index')->with('status', 'Lowongan karir berhasil dihapus.');
    }
}
