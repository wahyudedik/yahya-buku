<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\CompanyProfile;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class CompanyProfileController extends Controller
{
    public function show(): View
    {
        $profile = CompanyProfile::first();
        return view('admin.profile.edit', compact('profile'));
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'ceo_name' => 'nullable|string|max:255',
            'ceo_title' => 'nullable|string|max:255',
            'ceo_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'vision_mission_description' => 'nullable|string',
            'quote' => 'nullable|string',
            'books_count' => 'nullable|string|max:20',
            'authors_count' => 'nullable|string|max:20',
            'experience_years' => 'nullable|string|max:20',
        ]);

        $profile = CompanyProfile::first();
        
        if (!$profile) {
            $profile = new CompanyProfile();
        }

        if ($request->hasFile('ceo_image')) {
            if ($profile->ceo_image_path) {
                Storage::disk('public')->delete($profile->ceo_image_path);
            }
            $validated['ceo_image_path'] = $request->file('ceo_image')->store('company/ceo', 'public');
        }

        $profile->fill($validated);
        $profile->save();

        return redirect()->back()->with('status', 'Profil perusahaan berhasil diperbarui.');
    }
}
