<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ContactMessage;
use App\Models\ContactSetting;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;
use Illuminate\Http\RedirectResponse;

class PublicContactController extends Controller
{
    public function submit(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        // Simpan pesan ke database
        ContactMessage::create($validated);

        // Ambil email admin dari settings atau gunakan default
        $contactSetting = ContactSetting::first();
        $adminEmail = $contactSetting->email ?? 'admin@penalangit.id';

        // Kirim notifikasi email ke admin
        try {
            Mail::to($adminEmail)->send(new ContactFormMail($validated));
        } catch (\Exception $e) {
            // Log error jika email gagal terkirim, tapi jangan gagalkan request user
            \Illuminate\Support\Facades\Log::error('Failed to send contact form email: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Pesan Anda telah berhasil dikirim. Kami akan segera menghubungi Anda.');
    }
}
