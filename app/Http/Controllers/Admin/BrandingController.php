<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BrandingSetting;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BrandingController extends Controller
{
    public function show(): View
    {
        $settings = BrandingSetting::query()->first();
        return view('admin.branding', [
            'settings' => $settings,
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $settings = BrandingSetting::query()->firstOrNew([]);

        $request->validate([
            'logo' => ['nullable', 'file', 'max:2048', 'mimetypes:image/png,image/jpeg,image/svg+xml'],
            'favicon' => ['nullable', 'file', 'max:512', 'mimetypes:image/x-icon,image/vnd.microsoft.icon,image/png,image/svg+xml'],
            'logo_width' => ['nullable', 'integer', 'min:16', 'max:1024'],
            'logo_height' => ['nullable', 'integer', 'min:16', 'max:1024'],
            'logo_position' => ['required', 'in:left,center,right'],
            'favicon_enabled' => ['sometimes', 'boolean'],
        ]);

        $backupDir = 'branding/backups/' . now()->format('Ymd_His') . '/';
        $publicDisk = Storage::disk('public');
        $baseDir = 'branding/';

        if ($request->hasFile('logo')) {
            if ($settings->logo_path && $publicDisk->exists($settings->logo_path)) {
                $publicDisk->copy($settings->logo_path, $backupDir . basename($settings->logo_path));
            }
            $logoFile = $request->file('logo');
            $ext = $logoFile->getClientOriginalExtension();
            if ($ext === 'svg' || $logoFile->getMimeType() === 'image/svg+xml') {
                $clean = $this->sanitizeSvg($logoFile->getContent());
                $filename = 'logo_' . Str::random(8) . '.svg';
                $publicDisk->put($baseDir . $filename, $clean);
                $settings->logo_path = $baseDir . $filename;
            } else {
                $filename = 'logo_' . Str::random(8) . '.' . $ext;
                $path = $logoFile->storeAs($baseDir, $filename, 'public');
                $settings->logo_path = $path;
            }
        }

        if ($request->hasFile('favicon')) {
            if ($settings->favicon_path && $publicDisk->exists($settings->favicon_path)) {
                $publicDisk->copy($settings->favicon_path, $backupDir . basename($settings->favicon_path));
            }
            $favFile = $request->file('favicon');
            $mime = $favFile->getMimeType();
            $ext = $favFile->getClientOriginalExtension();

            if (in_array($mime, ['image/png'])) {
                [$w, $h] = getimagesize($favFile->getPathname());
                if (! in_array($w, [16, 32, 48]) || $w !== $h) {
                    return back()->withErrors(['favicon' => 'Favicon PNG harus persegi dan berukuran 16, 32, atau 48 px.'])->withInput();
                }
            }

            if ($ext === 'svg' || $mime === 'image/svg+xml') {
                $clean = $this->sanitizeSvg($favFile->getContent());
                $filename = 'favicon_' . Str::random(8) . '.svg';
                $publicDisk->put($baseDir . $filename, $clean);
                $settings->favicon_path = $baseDir . $filename;
            } else {
                $filename = 'favicon_' . Str::random(8) . '.' . $ext;
                $path = $favFile->storeAs($baseDir, $filename, 'public');
                $settings->favicon_path = $path;
            }
        }

        $settings->logo_width = $request->input('logo_width');
        $settings->logo_height = $request->input('logo_height');
        $settings->logo_position = $request->input('logo_position', $settings->logo_position ?? 'left');
        $settings->favicon_enabled = $request->boolean('favicon_enabled');
        $settings->updated_by = Auth::id();
        $settings->cache_bust_token = Str::random(12);
        $settings->save();

        return redirect()->route('admin.branding.show')->with('status', 'Perubahan disimpan.');
    }

    public function reset(): RedirectResponse
    {
        $settings = BrandingSetting::query()->first();
        if ($settings) {
            $settings->logo_path = null;
            $settings->logo_width = null;
            $settings->logo_height = null;
            $settings->logo_position = 'left';
            $settings->favicon_path = null;
            $settings->favicon_enabled = true;
            $settings->cache_bust_token = Str::random(12);
            $settings->updated_by = Auth::id();
            $settings->save();
        }
        return redirect()->route('admin.branding.show')->with('status', 'Dikembalikan ke default.');
    }

    protected function sanitizeSvg(string $svg): string
    {
        $svg = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', '', $svg);
        $svg = preg_replace('/on\w+="[^"]*"/i', '', $svg);
        $svg = preg_replace("/on\w+='[^']*'/i", '', $svg);
        return $svg;
    }
}
