<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\HeroSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class HeroController extends Controller
{
    public function show(): View
    {
        $hero = HeroSetting::firstOrCreate([], [
            'headline' => 'Kami Siap Membantu Anda Dalam Menerbitkan Buku',
            'subheadline' => 'Dengan SDM profesional yang akan membantu mendampingi penulis dan mengawal draft buku lebih berkualitas dan layak terbit',
            'cta_text' => 'Hubungi Kami',
            'cta_url' => '#kontak',
            'background_type' => 'color',
            'background_color' => '#ffffff',
            'text_color' => '#111827',
            'cta_color' => '#002B8F',
            'cta_text_color' => '#ffffff',
            'layout' => 'left-text-right-image',
            'is_active' => true,
        ]);

        return view('admin.hero', compact('hero'));
    }

    public function update(Request $request): RedirectResponse
    {
        $hero = HeroSetting::firstOrFail();

        $validated = $request->validate([
            'headline' => ['nullable', 'string', 'max:255'],
            'subheadline' => ['nullable', 'string'],
            'cta_text' => ['nullable', 'string', 'max:50'],
            'cta_url' => ['nullable', 'string', 'max:255'],
            'text_color' => ['required', 'string', 'max:7'],
            'cta_color' => ['required', 'string', 'max:7'],
            'cta_text_color' => ['required', 'string', 'max:7'],
            'background_type' => ['required', 'in:image,color'],
            'background_color' => ['nullable', 'string', 'max:7'],
            'layout' => ['required', 'in:left-text-right-image,center-text,right-text-left-image'],
            'background_image' => ['nullable', 'image', 'max:5120'], // 5MB
            'hero_image' => ['nullable', 'image', 'max:5120'], // 5MB
            'is_active' => ['nullable', 'boolean'],
        ]);

        // Handle File Uploads
        if ($request->hasFile('background_image')) {
            if ($hero->background_image_path) {
                Storage::disk('public')->delete($hero->background_image_path);
            }
            $validated['background_image_path'] = $request->file('background_image')->store('hero', 'public');
        }

        if ($request->hasFile('hero_image')) {
            if ($hero->hero_image_path) {
                Storage::disk('public')->delete($hero->hero_image_path);
            }
            $validated['hero_image_path'] = $request->file('hero_image')->store('hero', 'public');
        }

        $validated['is_active'] = $request->boolean('is_active');
        $validated['updated_by'] = auth()->id();

        $hero->update($validated);

        return redirect()->route('admin.hero.show')->with('status', 'Hero section updated successfully.');
    }
}
