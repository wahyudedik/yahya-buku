<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ContactSetting;
use App\Models\ContactMessage;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ContactController extends Controller
{
    // --- Settings Methods ---
    
    public function showSettings(): View
    {
        $setting = ContactSetting::first();
        return view('admin.contact.settings', compact('setting'));
    }

    public function updateSettings(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:50',
            'address' => 'nullable|string',
            'instagram' => 'nullable|url|max:255',
            'facebook' => 'nullable|url|max:255',
            'twitter' => 'nullable|url|max:255',
            'youtube' => 'nullable|url|max:255',
            'tiktok' => 'nullable|url|max:255',
        ]);

        $setting = ContactSetting::first();
        
        if ($setting) {
            $setting->update($validated);
        } else {
            ContactSetting::create($validated);
        }

        return redirect()->back()->with('status', 'Pengaturan kontak berhasil diperbarui.');
    }

    // --- Messages Methods ---

    public function indexMessages(): View
    {
        $messages = ContactMessage::latest()->paginate(10);
        return view('admin.contact.messages', compact('messages'));
    }

    public function deleteMessage(ContactMessage $message): RedirectResponse
    {
        $message->delete();
        return redirect()->back()->with('status', 'Pesan berhasil dihapus.');
    }
    
    public function markAsRead(ContactMessage $message): RedirectResponse
    {
        $message->update(['is_read' => true]);
        return redirect()->back()->with('status', 'Pesan ditandai sudah dibaca.');
    }
}
