<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FooterSetting;
use App\Models\FooterLink;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class FooterController extends Controller
{
    public function index(): View
    {
        $footer = FooterSetting::first();
        $links = FooterLink::orderBy('category')->orderBy('order')->get();
        return view('admin.footer.index', compact('footer', 'links'));
    }

    public function updateSettings(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'description' => 'nullable|string',
            'copyright_text' => 'nullable|string|max:255',
            'created_by_text' => 'nullable|string|max:255',
            'created_by_url' => 'nullable|url|max:255',
        ]);

        $footer = FooterSetting::first();
        if ($footer) {
            $footer->update($validated);
        } else {
            FooterSetting::create($validated);
        }

        return redirect()->route('admin.footer.index')->with('status', 'Pengaturan Footer berhasil disimpan.');
    }

    public function storeLink(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|url|max:255',
            'category' => 'required|in:about_us,related',
            'order' => 'integer|min:0',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        FooterLink::create($validated);

        return redirect()->route('admin.footer.index')->with('status', 'Link Footer berhasil ditambahkan.');
    }

    public function editLink(FooterLink $link): View
    {
        return view('admin.footer.edit-link', compact('link'));
    }

    public function updateLink(Request $request, FooterLink $link): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|url|max:255',
            'category' => 'required|in:about_us,related',
            'order' => 'integer|min:0',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $link->update($validated);

        return redirect()->route('admin.footer.index')->with('status', 'Link Footer berhasil diperbarui.');
    }

    public function destroyLink(FooterLink $link): RedirectResponse
    {
        $link->delete();
        return redirect()->route('admin.footer.index')->with('status', 'Link Footer berhasil dihapus.');
    }
}
